<?php 
ob_start();
session_start();
require 'baglan.php';

$kullSor=$db->prepare('SELECT * FROM yoneticiler where  yonetici_ad=:ad');
$kullSor->execute(array(
    'ad' => $_SESSION['username']
));
$kullCek=$kullSor->fetch(PDO::FETCH_ASSOC);

$dataPoints77= array();
try{
$link = new \PDO( "mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','',
array(
\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
\PDO::ATTR_PERSISTENT => false
)
);
$handle = $link->prepare('SELECT gorev.gorev_ad as y,COUNT(personel_karti.gorev_id) as x
FROM personel_karti,gorev
WHERE personel_karti.gorev_id=gorev.gorev_id
GROUP BY personel_karti.gorev_id');
$handle->execute();
$result = $handle->fetchAll(\PDO::FETCH_OBJ);
foreach($result as $row){
array_push($dataPoints77, array("y"=> $row->y, "label"=> $row->x));
}
$link = null;
}
catch(\PDOException $ex){
print($ex->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Eczane Depo Sistemi</title>
 <meta charset="utf-8">
 <meta name="description" content="İzmir Eczane Bilgi Sistemi">
 <meta name="keyword" content="İzmir,Eczane,Bilgi,Sistemi">
 <link href="style.css" rel="stylesheet">
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script>
            window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer10", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
            text: "Satılan İlaç Sayıları"
            },
            data: [{
            type: "pie", //change type to bar, line, area, pie, etc
            dataPoints: <?php echo json_encode($dataPoints77, JSON_NUMERIC_CHECK); ?>
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
    <div class="searchDiv"><input class="search" type="text" placeHolder="Search..."> <i class="fas fasearch"></i>
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
    <span>Giriş</span>
    <i class="fas fa-chevron-left"></i>
    </div>
    </a>
    <a href="analiz3.php">
    <div class="uygulamalar">
    <i class="fas fa-th-large"></i>
    <span>Uygulamalar</span>
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
    <span>Çalışma Alanım</span>
    <i class="fas fa-chevron-left"></i>
    </div>
    </a>
    <hr>
    <a href="personelDagilim.php">
    <div class="ayarlar">
    <i class="fas fa-cog"></i>
    
    <span>Ayarlar</span>
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
    <div class="vl4"></div>
    <div class="more">
    <i class="fas fa-ellipsis-h"></i>
    </div>
    </div>
    <div class="hl"></div>
    <div class="ilkveriseti">
    <a href="#">
    </a>
    <style>
        table{
            border: 3px solid #CF000F;
            width: 80%;
            height: 150px;
            margin-left:100px;
            margin-top:50px;
           
            text-align: center;
            font-family: "Comic Sans MS", "Comic Sans", cursive;
            background-color: #F1654C;
            color:#fff;
        }
 
        table td{
            border: 3px solid #964b00;
        }
 
        #tablo-baslik{
            font-weight: 700;
          
        }


    </style>
 
                    <form action="islem1.php" method="POST">
                        
                        <table border="1" id="tablo">
                        <tr><td>Personel Adı:<td><input style="width:250px; text-align:center;" type="text" required="" name="ad" placeholder="Adını Giriniz..."></td></tr>
                        <tr><td>Personel Soyadı:<td><input style="width:250px; text-align:center;" type="text" required="" name="soyad" placeholder="Soyadını Giriniz..." ></td></tr>
                        <tr><td>Görev ID:<td><input style="width:250px; text-align:center;" type="number" required="" name="gorev_id" placeholder="Görevini Giriniz..." ></td></tr>
                        <tr>
                        <td></td>
                        <td><button type="submit" name="insertislemi" style=" width: 70px;
                                                                                height: 23px;
                                                                                margin-left:7px;
                                                                                background-color:white;
                                                                                border-style: solid;
                                                                                border-color: black;
                                                                                border-radius: 2px;" >Kaydet</button> 
                                                                                <button style=" width: 70px;
                                                                                                height: 23px;
                                                                                                
                                                                                                background-color:white;
                                                                                                border-style: solid;
                                                                                                border-color: black;
                                                                                                border-radius: 2px;" type="reset">Temizle</button></td>
                        </tr>
                        </table>

                        </form>
    
    <table>
        <tr id="tablo-baslik">
            <td>Sıra</td>
            <td>Personel ID</td>
            <td>Personel Ad</td>
            <td>Personel Soyad</td>
            <td>Görev ID</td>
            <td>işlemler</td>
        </tr>
        <?php
                            $bilgiSor=$db->prepare("SELECT * from personel_karti");
                            $bilgiSor->execute();

                            $say=0;
                            while($bilgiCek=$bilgiSor->fetch(PDO::FETCH_ASSOC)) { $say++ ?>

                            <tr>
                                <td align="center"><?php echo $say; ?></td>
                                <td align="center"><?php echo $bilgiCek['personel_id'] ?></td>
                                <td align="center"><?php echo $bilgiCek['ad'] ?></td>
                                <td align="center"><?php echo $bilgiCek['soyad'] ?></td>
                                <td align="center"><?php echo $bilgiCek['gorev_id'] ?></td>
                                <td align="center"><a href="duzenle.php?personel_id=<?php echo $bilgiCek['personel_id'] ?>"><button>Düzenle</button></td></a>
                            </tr>
            <?php } 
            
            ?>
      
    </table>
    <div id="chartContainer10" style="height: 200px; width: 40%; margin-top: 30px; float:right; "></div>
    
    <div class="ikinciveriseti">

    <div class="ucuncuVeriSeti">

  
    
    </div>
    
    
    </body>
 
</html>