<?php require_once 'baglan.php'; ?>
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
    <div class="info"><span>Büşra Nur Tokgöz</span> 
   <span><strong>Online</strong></span></div>
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
                    <?php
                            $bilgiSor=$db->prepare("SELECT * FROM personel_karti WHERE personel_id=:ID");
                            $bilgiSor->execute(array(
                                'ID' => $_GET['personel_id']
                                
                            ));

                            $say=0;
                            $bilgiCek=$bilgiSor->fetch(PDO::FETCH_ASSOC);
                        
                            ?>
                    <form action="islem1.php" method="POST">
                        
                        <table border="1" id="tablo">
                        <tr><td>Personel Adı:<td><input style="width:250px; text-align:center;" type="text" required="" name="ad" value="<?php echo $bilgiCek['ad'] ?>"></td></tr>
                        <tr><td>Personel Soyadı:<td><input style="width:250px; text-align:center;" type="text" required="" name="soyad" value="<?php echo $bilgiCek['soyad'] ?>" ></td></tr>
                        <tr><td>Görev ID:<td><input style="width:250px; text-align:center;" type="number" required="" name="gorev_id" value="<?php echo $bilgiCek['gorev_id'] ?>"></td></tr>
                        <tr>
                        <td></td>
                        <input type="hidden" value="<?php echo $bilgiCek['personel_id'] ?>" name="personel_id">
                        <td><button type="submit" name="updateislemi" style=" width: 70px;
                                                                                    height: 23px;
                                                                                    background-color:white;
                                                                                    border-style: solid;
                                                                                    border-color: black;
                                                                                    border-radius: 2px;">Güncelle</td>
                        </tr>
                        </table>

                        </form>
    
    <table>
        <tr id="tablo-baslik">
            <td>Sıra</td>
            <td>Personel ID</td>
            <td>Personel Ad</td>
            <td>Personel Soyad</td>
            <td>Personel Görev</td>
            <td>işlemler</td>
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
                                <td align="center"><a href="islem1.php?personel_id=<?php echo $bilgiCek['personel_id'] ?>&bilgiSil=ok"><button>Kaydı Sil</button></td></a>
                            </tr>
            <?php } 
            
            ?>
      
    </table>




    <a href="#">
    
    
    </a>
    <a href="#">
   
    </a>
    <a href="#">
    
    </div>
    
    
    </head>
</html>