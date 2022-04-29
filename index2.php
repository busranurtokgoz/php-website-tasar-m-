<?php 
ob_start();
session_start();
require 'baglan.php';

$kullSor=$db->prepare('SELECT * FROM yoneticiler where  yonetici_ad=:ad');
$kullSor->execute(array(
    'ad' => $_SESSION['username']
));
$kullCek=$kullSor->fetch(PDO::FETCH_ASSOC);

$db = new mysqli("localhost","root","","ecza_deposu1");
$firma_sorgu = $db->prepare("SELECT COUNT(firmalar.firma_id) firma_sayisi FROM firmalar");
$firma_sorgu->execute();
$firma_sonuc = $firma_sorgu->get_result();
$firma_sayisi = $firma_sonuc->fetch_assoc();
$firma_sorgu->close();

$db = new mysqli("localhost","root","","ecza_deposu1");
$personel_sorgu = $db->prepare("SELECT COUNT(personel_karti.personel_id) personel_sayisi FROM personel_karti ");
$personel_sorgu->execute();
$personel_sonuc = $personel_sorgu->get_result();
$personel_sayisi = $personel_sonuc->fetch_assoc();
$personel_sorgu->close();

$db = new mysqli("localhost","root","","ecza_deposu1");
$toplam_alis_sayisi = $db->prepare("SELECT SUM(malzeme_hareketleri.miktar) alis FROM malzeme_hareketleri,tanim WHERE malzeme_hareketleri.tanim_id=tanim.tanim_id AND tanim.tanim_id=1");
$toplam_alis_sayisi->execute();
$toplam_alis_sonuc = $toplam_alis_sayisi->get_result();
$alis_sayisi = $toplam_alis_sonuc->fetch_assoc();
$toplam_alis_sayisi->close();


$db = new mysqli("localhost","root","","ecza_deposu1");
$toplam_satis_sayisi = $db->prepare("SELECT SUM(malzeme_hareketleri.miktar) satis FROM malzeme_hareketleri,tanim WHERE malzeme_hareketleri.tanim_id=tanim.tanim_id AND tanim.tanim_id=2");
$toplam_satis_sayisi->execute();
$toplam_satis_sonuc = $toplam_satis_sayisi->get_result();
$satis_sayisi = $toplam_satis_sonuc->fetch_assoc();
$toplam_satis_sayisi->close();


$dataPoints = array();
try{
$link = new \PDO( "mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','',
array(
\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
\PDO::ATTR_PERSISTENT => false
)
);
$handle = $link->prepare('SELECT SUM(malzeme_hareketleri.miktar) as y, malzeme_karti.malzeme_ismi as x FROM malzeme_hareketleri,tanim,malzeme_karti WHERE malzeme_hareketleri.tanim_id=tanim.tanim_id AND tanim.tanim_id=2 and malzeme_hareketleri.malzeme_id=malzeme_karti.malzeme_id
GROUP BY malzeme_karti.malzeme_id');
$handle->execute();
$result = $handle->fetchAll(\PDO::FETCH_OBJ);
foreach($result as $row){
array_push($dataPoints, array("y"=> $row->y, "label"=> $row->x));
}
$link = null;
}
catch(\PDOException $ex){
print($ex->getMessage());
}

$dataPoints1 = array();
try{
$link = new \PDO( "mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','',
array(
\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
\PDO::ATTR_PERSISTENT => false
)
);
$handle = $link->prepare('SELECT SUM(malzeme_hareketleri.miktar) as y, malzeme_karti.malzeme_ismi as x 
FROM malzeme_hareketleri,tanim,malzeme_karti 
WHERE malzeme_hareketleri.tanim_id=tanim.tanim_id AND tanim.tanim_id=1 and malzeme_hareketleri.malzeme_id=malzeme_karti.malzeme_id
GROUP BY malzeme_karti.malzeme_id');
$handle->execute();
$result = $handle->fetchAll(\PDO::FETCH_OBJ);
foreach($result as $row){
array_push($dataPoints1, array("y"=> $row->y, "label"=> $row->x));
}
$link = null;
}
catch(\PDOException $ex){
print($ex->getMessage());
}

$dataPoints3 = array();
try{
$link = new \PDO( "mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','',
array(
\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
\PDO::ATTR_PERSISTENT => false
)
);
$handle = $link->prepare('SELECT ilceler.ilce_ad as x, COUNT(firmalar.firma_id) as y 
FROM ilceler, firmalar
WHERE ilceler.ilce_id=firmalar.ilce_id 
GROUP BY ilceler.ilce_id');
$handle->execute();
$result = $handle->fetchAll(\PDO::FETCH_OBJ);
foreach($result as $row){
array_push($dataPoints3, array("y"=> $row->y, "label"=> $row->x));
}
$link = null;
}
catch(\PDOException $ex){
print($ex->getMessage());
}

?>


<!DOCTYPE html>
<html>
<head><title>Eczane Depo Sistemi</title>
 <meta charset="utf-8">
 <meta name="description" content="İzmir Eczane Bilgi Sistemi">
 <meta name="keyword" content="İzmir,Eczane,Bilgi,Sistemi">
 <link href="style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script>
            window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
            text: "Satılan İlaç Sayıları"
            },
            data: [{
            type: "column", //change type to bar, line, area, pie, etc
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
            });
            chart.render(); 

            var chart = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
            text: "Alınan İlaç Sayıları"
            },
            data: [{
            type: "bar", //change type to bar, line, area, pie, etc
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
            });
            chart.render(); 

            
            var chart = new CanvasJS.Chart("chartContainer6", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "dark1", // "light1", "light2", "dark1", "dark2"
            title:{
            text: "İlçelere Göre Firma Dağılımı"
            },
            data: [{
            type: "pie", //change type to bar, line, area, pie, etc
            dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
            }]
            });
            chart.render(); 
        
    }
    </script>
</head>
<body>

<div class="sidebar">
 <div class="status"><img src="images/logo2.jpg">
 <div class="info"><span>Hoş Geldiniz</span> 
<span style="font-size:15px;"><?php echo $kullCek['yonetici_ad'];?></span></div>
 </div>
 <div class="searchDiv"><input class="search" type="text" placeHolder="Search..."> <i class="fas fa-search"></i>
 </div>
 <br>
 <hr>
 <div class="mainNav">
 <i class="fas fa-bars"></i>
 <span>Menü</span>
 </div>
 <hr>
 
 <a href="giris.php">
 <div class="dash">
 <i class="fas fa-home"></i>
 <span>Malzemeler</span>
 <i class="fas fa-chevron-left"></i>
 </div>
 </a>
 <a href="analiz3.php">
 <div class="uygulamalar">
 <i class="fas fa-th-large"></i>
 <span>Analiz Sorgulama</span>
 <i class="fas fa-chevron-left"></i>
 </div>
 </a>
 <a href="personel.php">
 <div class="guncelleme">
 <i class="far fa-edit"></i>
 <span>Personel</span>
 <i class="fas fa-chevron-left"></i>
 </div>
 </a>
 <a href="analiz.php">
 <div class="calismaAlani">
 <i class="far fa-user-circle"></i>
 <span>Fiyat Analizi</span>
 <i class="fas fa-chevron-left"></i>
 </div>
 </a>
 <hr>
 <a href="personelDagilim.php">
 <div class="ayarlar">
 <i class="fas fa-cog"></i>
 
 <span>Personel Dağılımı</span>
 <i class="fas fa-chevron-left"></i>
 
 </div>
 </a>

 <hr>
 
 <div class="cikis">
 <button class="cikis_buton" type="submit" name="logout">Çıkış</button>
 </div>
</div>
<div class="vl"></div>
<div class="content">
 <div class="islemler">
 <div class="yazdir">
 <i class="fas fa-print"></i>
 <span>Yazdır</span>
 </div>
 <div class="vl2"></div>
 <div class="paylas">
 <i class="far fa-share-square"></i>
 <span>Paylaş</span>
 </div>
 <div class="vl3"></div>
 <div class="sikkullanilan">
 <i class="far fa-star"></i>
 <span>Sık Kullanılanlar</span>
 </div>
 <div class="vl5"></div>
 <div class="more">
 <i class="fas fa-ellipsis-h"></i>
 </div>
 <div class="hl"></div>
 <div class="ilkveriseti">
 <a href="#">

 <div style ="background: orange;"class="toplamsiparis">
 <h1><?php echo $firma_sayisi["firma_sayisi"]; ?></h1>
 <i class="fas fa-shopping-basket"></i>
 <h1>Firma Sayısı</h1>
 </div>
 </a>
 
 <a href="#">
 <div class="depostok">
 <h1><?php echo $personel_sayisi["personel_sayisi"]; ?></h1>
 <i class="fas fa-layer-group"></i>
 <h1>Personel Sayısı</h1>
 </div>
 </a>
 <a href="#">
 <div class="ziyaretcisayisi">
 <h1><?php echo $alis_sayisi["alis"]; ?></h1>
 <i class="far fa-bell"></i>
 <h1>Alınan İlaç Sayısı</h1>
 </div>
 </a>
 <a href="#">
 <div  style="width: 15%;
 height: 100px;
 margin-left: 830px;
 box-sizing: border-box;
 background: brown;
 position: absolute;
 margin-top: 60px;"class="mesajlar2">
 <h1 style=" float: left;
 position: absolute;
 padding:15px;
 color:#fff; "><?php echo $satis_sayisi["satis"]; ?></h1>
 <i class="far fa-bell"></i>
 <h1 style="margin-top:40px; margin-right:50px; color:white;">Satış İlaç Sayısı</h1>
 </div>
 </a>
 </div>

 

 <div id="chartContainer1" style="height: 200px; width: 40%; margin-top: 10px; float:right; margin-right:30px;"></div>
 <div id="chartContainer2" style="height: 200px; width: 40%; margin-top: 10px; float:left; margin-left:30px;"></div>
 <div id="chartContainer6" style="height: 250px; width: 60%; margin-top: 30px; float:left; margin-left:250px;"></div>
        
              
 <button style="width:100px; margin-right:150px; margin-top:5px;" onclick="myFunction()">Mesaj</button>

<script>
function myFunction() {
  alert("XANAX 1 MG 50 STOK MİKTARI ARTTIRILMALI");
}
</script>

<button style="width:100px; float:left; margin-top:50px;" onclick="myFunction()">Mesaj</button>

<script>
function myFunction() {
  alert("!");
                        





 
 <div class="hl"></div>
 <div class="ikinciveriseti">
 <div class="eczanemaske">
 
 </script>
 </div>
 <div class="piechartın">
 <div id="piechart"></div>
 </div>
 </div>
 <div class="ucuncuVeriSeti1" style="background: #ACB78E;">
 
 
 
 </script>
 </canvas>
 </div>
 </div>
</div>

</body>
</html>