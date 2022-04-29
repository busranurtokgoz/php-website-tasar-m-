<?php 

try {
	
	$db=new PDO("mysql:host=localhost;dbname=ecza_deposu1;charset=utf8",'root','');

	//echo "Veritabanı bağlantısı başarılı";

} catch (PDOExpception $e) {

	echo $e->getMessage();
}


?>