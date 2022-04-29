
<?php //require_once 'baglan.php'; 
ob_start();
session_start();
require 'baglan.php';

$kullSor=$db->prepare('SELECT * FROM yoneticiler where  yonetici_ad=:ad');
$kullSor->execute(array(
    'ad' => $_SESSION['username']
));
$kullCek=$kullSor->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head><title>Eczane Depo Sistemi</title>
 <meta charset="utf-8">
 <meta name="description" content="İzmir Eczane Bilgi Sistemi">
 <meta name="keyword" content="İzmir,Eczane,Bilgi,Sistemi">
 <link href="style.css" rel="stylesheet">
 

 <body>
     
 </body>
 






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
    <a href="index2.php" style="text-decoration: none;" >
                        <div class="butonx" style="border:2px solid transparent;
                                background-color:Peru;
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
   <div class="content" style="background:PeachPuff">
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
    <div class="ilkveriseti" style="background:PeachPuff">
    <a href="#">
    
    <div class="hl"></div>
    <div class="ucuncuVeriSeti" style="background:PeachPuff">
    <a href="#">

    <div class="eczanemaske"></div>
    <div class="ilkveriseti" style="background:PeachPuff">
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
            background-color: IndianRed;
            color:#fff;
        }
 
        table td{
            border: 3px solid brown;
        }
 
        #tablo-baslik{
            font-weight: 700;
          
        }


    </style>
 
                    <form action="islem1.php" method="POST">
                        
                        <table border="1" id="tablo">
                        <tr><td>Malzeme ID:<td><input style="width:250px; text-align:center;" type="number" required="" name="malzeme_id" placeholder="Adını Giriniz..."></td></tr>
                        <tr><td>Barkod:<td><input style="width:250px; text-align:center;" type="number" required="" name="barkod" placeholder="Barkod No Giriniz..." ></td></tr>
                        <tr><td>Malzeme İsmi:<td><input style="width:250px; text-align:center;" type="text" required="" name="malzeme_ismi" placeholder="Malzeme İsmi Giriniz..." ></td></tr>
                        <tr><td>ATC Kodu:<td><input style="width:250px; text-align:center;" type="text" required="" name="atc_kodu" placeholder="ATC Kodunu Giriniz..." ></td></tr>
                        <tr><td>ATC Adı:<td><input style="width:250px; text-align:center;" type="text" required="" name="atc_adi" placeholder="ATC Adını Giriniz..." ></td></tr>
                        <tr>
                        <td></td>
                        <td><button type="submit" name="insertislemi2" style=" width: 70px;
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

    
<div>
    <?php 
    $conn = mysqli_connect('localhost', 'root', '', 'ecza_deposu1');
    if(isset($_POST['search'])){
        $searchKey = $_POST['search']; 
        $sql = "SELECT * FROM malzeme_karti WHERE atc_kodu LIKE '%$searchKey%' OR barkod LIKE '%$searchKey%'";
    
    }else
    $sql = "SELECT * FROM malzeme_karti";
    $result = mysqli_query($conn,$sql);
    ?>
    <form action="" method="POST"> 
     <div style="margin-top:30px; margin-right:100px;" class="col-md-6">
        <input type="text" name="search" class='form-control' placeholder="Search" style=" margin-right:100px; text-align:center;" value="" > 
     </div>
     <div class="col-md-6 text-left">
        <button style=" margin-right:200px; margin-top:10px;"  class="btn">Search</button>
     </div>
   </form>
   </div>  
    <table>
        <tr id="tablo-baslik">
            <td>Malzeme ID</td>
            <td>Barkod</td>
            <td>Malzeme İsmi</td>
            <td>ATC Kodu</td>
            <td>ATC Adı</td> 
            
        </tr>
       


                            

                            
                            <?php while( $row = mysqli_fetch_object($result)) { ?>
                            <tr>
                                <td><?php echo $row->malzeme_id ?></td>
                                <td><?php echo $row->barkod ?></td>
                                <td><?php echo $row->malzeme_ismi?></td>
                                <td><?php echo $row->atc_kodu?></td>
                                <td><?php echo $row->atc_adi?></td>
                            </tr>
                            <?php } ?>
           
      
    </table>
  

   
  
    
    

</html>