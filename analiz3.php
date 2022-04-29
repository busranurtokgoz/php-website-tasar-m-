<?php 
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 
</head>
<body style="background:#ACB78E">
<?php 

$baglan=mysqli_connect("localhost","root","","ecza_deposu1");
    //echo "veritabanı bağlantısı başarılı";


?>

            <style>
        table{
            border: 3px solid #CF000F;
            width: 70%;
            height: 200px;
            margin-top:200px;
            margin-left:300px;
           
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

            <div class="grafik1">
                <div class="try">
                    <form class="ekle" action="grafikEtkilesim.php" method="POST">
                    <table border="1" id="tablo">
                    <tr><td>
                    <select name="ilacSec">
                        <option value="">ilaç Seçiniz</option>

                    <?php
                    $ilacAdd=$baglan->query("SELECT * From ilac");
                    while ($row = mysqli_fetch_array($ilacAdd)){
                        echo "<option value=".$row['fiyat'].">".$row['ilac_ad']."</option>";
                        
                    }

                    ?>

                    </select>
                    </td></tr>
                    
                    <tr><td><input type="varchar" name=alis_fiyati value="" placeholder="Alış Fiyatı Giriniz"></td></tr>
                    <tr><td> <input type="varchar" name=satis_fiyati value="" placeholder="Satış Fiyatı Giriniz"></td></tr>
                    <tr><td> <input type="number" name=miktar value="" placeholder="ilaç Miktarı Giriniz"></td></tr>
                    <tr><td><input type="string" name=tanimAdi value="" placeholder="Analiz Adı"></td></tr>
                    <tr><td> <input type="submit" name=gonder value="Sonucu Gör"></td></tr>
                   
                </table>
                </form>
               
                </div>
            
            </div>


            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {

              var button = document.getElementById('change-chart');
              var chartDiv = document.getElementById('chart_div');

              var data = google.visualization.arrayToDataTable([
                ['Analiz adı', 'Kazanç', 'Kar','Maliyet'],
                <?php
                  $query="SELECT * FROM etkilesim";
                  $exec=mysqli_query($baglan,$query);
                  while($row=mysqli_fetch_array($exec)){
                    echo "['".$row['tanimAdi']."','".$row['etmaliyet']."','".$row['etkazanc']."','".$row['etkar']."'],";
            }



          ?>
        ]);

        var materialOptions = {
          width: 800,
          height:400,
          chart: {
            title: 'ECZAAA',
            subtitle: 'İLAÇ DEPO'
          },
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
             
            }
          }
        };

        var classicOptions = {
          width: 900,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          title: 'Nearby galaxies - distance on the left, brightness on the right',
          vAxes: {
            // Adds titles to each axis.
            0: {title: 'parsecs'},
            1: {title: 'apparent magnitude'}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }

        drawMaterialChart();
    };
    </script>

    <div id="chart_div" style="width: 60%; height: 450px; margin-left:200px; margin-top:100px;"></div>
    




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

</body>
</html>