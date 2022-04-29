<?php 
ob_start();
session_start();
require 'baglan.php';

$kullSor=$db->prepare('SELECT * FROM yoneticiler where  yonetici_ad=:ad');
$kullSor->execute(array(
    'ad' => $_SESSION['username']
));
$kullCek=$kullSor->fetch(PDO::FETCH_ASSOC);

$dataPoints = array();
try{
$link = new \PDO( "mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','',
array(
\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
\PDO::ATTR_PERSISTENT => false
)
);
$handle = $link->prepare('SELECT malzeme_hareketleri.toplam as y, firmalar.firmalar as x
FROM malzeme_hareketleri,tanim,firmalar
WHERE malzeme_hareketleri.tanim_id=tanim.tanim_id AND tanim.tanim_id=1 AND malzeme_hareketleri.firma_id=firmalar.firma_id
GROUP BY firmalar.firma_id');
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

?>


<!DOCTYPE html>
<html>
<head><title>Eczane Depo Sistemi</title>
 <meta charset="utf-8">
 <meta name="description" content="İzmir Eczane Bilgi Sistemi">
 <meta name="keyword" content="İzmir,Eczane,Bilgi,Sistemi">
 <link href="style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 <script>
            window.onload = function () {
            
            var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
            text: "Alınan İlaçların Fiyat Toplamı Analizi"
            },
            data: [{
            type: "bar", //change type to bar, line, area, pie, etc
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
            });
            chart.render(); 
        }
</script>
</head>
<body style="background:#ACB78E">

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
 <span> Personel </span>
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
 <a href="index2.php">
                        <div class="butonx" style="border:2px solid transparent;
                                background-color:black;
                                color: white;
                                font-size: 15px;
                                line-height: 10px;
                                padding: 10px ;
                                text-decoration: none;
                                text-shadow: none;
                                border-radius: 3px;
                                width: 150px;
                                text-align: center;
                                margin-top:15px;
                                margin-left:60px;
                                position: relative;
                                right: 20px;">
                                <div class="inner">
                                <p><b>Yönetici Panele Dön</b></p>
                            </div>
                        </div>
                    </a>
 
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
    </a>
<div >
</div>
</div>

<div id="chartContainer" style="height: 250px; width: 50%; margin-left:200px;"></div>
 <form action="firmaAnaliz.php" method="POST">
                            <button  style="
                                background-color:black;
                                color: white; width:130px; margin-left:700px; " type="submit" >Analiz Sonucu Gör</buton>
                    </form>



</body>
</html>