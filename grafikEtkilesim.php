<?php
$baglan=mysqli_connect("localhost","root","","ecza_deposu1");
if ($_POST){
    $tanimAdi=$_POST['tanimAdi'];
    $alis_fiyati=$_POST["alis_fiyati"];
    $satis_fiyati=$_POST["satis_fiyati"];
    $miktar=$_POST["miktar"];
    $ilacSec=$_POST['ilacSec'];
    

}

$maliyet=$ilacSec*$alis_fiyati*$miktar;
echo $maliyet;
$kazanc=$satis_fiyati*$miktar;
echo $kazanc;
$kar=$kazanc-$maliyet;
echo $kar;



if(isset($_POST["gonder"])){

    $sql="INSERT INTO etkilesim(etmaliyet,etkazanc,etkar,tanimAdi) values('".$maliyet."','".$kazanc."','".$kar."','".$tanimAdi."')";
    $sonuc=mysqli_query($baglan,$sql);
    if($sonuc){

        header("Location:analiz3.php");
    }
}



?>