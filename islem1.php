<?php
//müşteri crud işlemleri
require_once 'baglan.php';

if (isset($_POST['insertislemi'])) {
	
	

	$kaydet=$db->prepare("INSERT into personel_karti SET
		ad=:ad,
		soyad=:soyad,
        gorev_id=:gorev_id"
        );

	$insert=$kaydet->execute(array(
		'ad' => $_POST['ad'],
		'soyad' => $_POST['soyad'],
        'gorev_id' => $_POST['gorev_id']
        
	));


    if ($insert) {
		
		//echo "kayıt başarılı";

		Header("Location:personel.php?durum=ok");
		exit;

	} else {

		//echo "kayıt başarısız";
		Header("Location:personel.php?durum=no");
		exit;
	}

}

	//kayıt düzenleme/müşteri
	if (isset($_POST['updateislemi'])) {
		
			$personel_id=$_POST['personel_id'];

	

			$kaydet=$db->prepare("UPDATE personel_karti SET
			ad=:ad,
            soyad=:soyad,
            gorev_id=:gorev_id,
			WHERE personel_id={$_POST['personel_id']}"
			
			);
	
			$insert=$kaydet->execute(array(
			'ad' => $_POST['ad'],
			'soyad' => $_POST['soyad'],
			'gorev_id' => $_POST['gorev_id']
		));
	
	
		if ($insert) {
			
			//echo "kayıt başarılı";
	
			Header("Location:duzenle.php?durum=ok&personel_id=$personel_id");
			exit;
	
		} else {
	
			//echo "kayıt başarısız";
			Header("Location:duzenle.php?durumno&personel_id=$personel_id");
			exit;
		}

}	
 		//veri silme
	if ($_GET['bilgiSil']=="ok") {

			$sil=$db->prepare("DELETE from personel_karti where personel_id=:ID");
			$kontrol=$sil->execute(array(
				'ID' => $_GET['personel_id']
			));
		
			if ($kontrol) {
				
				//echo "kayıt başarılı";
		
				Header("Location:personel.php?durum=ok");
				exit;
		
			} else {
		
				//echo "kayıt başarısız";
				Header("Location:personel.php?durum=no");
				exit;
			}
		
		
	}

	
	if (isset($_POST['satisEkle'])) {
	
	

	$kaydet=$db->prepare("INSERT into malzeme_hareketleri SET
		hareket_id=:hareket_id,
		tanim_id=:tanim_id,
		onceki_id=:onceki_id,
		fatura_no=:fatura_no,
        malzeme_id=:malzeme_id,
		barkod=:barkod,
		firma_id=:firma_id,
		miktar=:miktar,
		birim_fiyat=:birim_fiyat,
		toplam=:toplam"
        );

	$insert=$kaydet->execute(array(
		'hareket_id' => $_POST['hareket_id'],
		'tanim_id' => $_POST['tanim_id'],
		'onceki_id' => $_POST['onceki_id'],
		'fatura_no' => $_POST['fatura_no'],
        'malzeme_id' => $_POST['malzeme_id'],
		'barkod' => $_POST['barkod'],
		'firma_id' => $_POST['firma_id'],
		'miktar' => $_POST['miktar'],
		'birim_fiyat' => $_POST['birim_fiyat'],
		'toplam' => $_POST['toplam']
        
	));


    if ($insert) {
		
		//echo "kayıt başarılı";

		Header("Location:index2.php?durum=ok");
		exit;

	} else {

		//echo "kayıt başarısız";
		Header("Location:index2.php?durum=no");
		exit;
	}

}


	if (isset($_POST['insertislemi2'])) {
	
	

		$kaydet=$db->prepare("INSERT into malzeme_karti SET
			malzeme_id=:malzeme_id,
			barkod=:barkod,
			malzeme_ismi=:malzeme_ismi,
			atc_kodu=:atc_kodu,
			atc_adi=:atc_adi"
			);
	
		$insert=$kaydet->execute(array(
			'malzeme_id' => $_POST['malzeme_id'],
			'barkod' => $_POST['barkod'],
			'malzeme_ismi' => $_POST['malzeme_ismi'],
			'atc_kodu' => $_POST['atc_kodu'],
			'atc_adi' => $_POST['atc_adi']
			
		));
	
	
		if ($insert) {
			
			//echo "kayıt başarılı";
	
			Header("Location:giris.php?durum=ok");
			exit;
	
		} else {
	
			//echo "kayıt başarısız";
			Header("Location:giris.php?durum=no");
			exit;
		}
	}
	
	

	//personel ekleme/insert2islemi
	//if (isset($_POST['insertİslemi'])) {
	
	

// 		$kaydet=$db->prepare("INSERT into personel SET
// 			subeID=:subeID,
// 			personelTc=:personelTc,
// 			personelAdSoyAd=:personelAdSoyAd,
// 			personelTel=:personelTel,
// 			personelMail=:personelMail,
// 			personelGorev=:personelGorev,
// 			dagitimHiz=:dagitimHiz,
// 			anlasmaSayisi=:anlasmaSayisi"
// 			);
	
// 		$insert=$kaydet->execute(array(
// 			'subeID' => $_POST['subeID'],
// 			'personelTc' => $_POST['personelTc'],
// 			'personelAdSoyAd' => $_POST['personelAdSoyAd'],
// 			'personelTel' => $_POST['personelTel'],
// 			'personelMail' => $_POST['personelMail'],
// 			'personelGorev' => $_POST['personelGorev'],
// 			'dagitimHiz' => $_POST['dagitimHiz'],
// 			'anlasmaSayisi' => $_POST['anlasmaSayisi']
// 		));
	
	
// 		if ($insert) {
			
// 			//echo "kayıt başarılı";
	
// 			Header("Location:personel.php?durum=ok");
// 			exit;
	
// 		} else {
	
// 			//echo "kayıt başarısız";
// 			Header("Location:personel.php?durum=no");
// 			exit;
// 		}
	
// 	}

// 	//kayıt düzenleme/personel
// 	if (isset($_POST['updateİslemi'])) {
		
// 		$personelID=$_POST['personelID'];



// 		$kaydet=$db->prepare("UPDATE personel SET
// 		subeID=:subeID,
// 		personelTc=:personelTc,
// 		personelAdSoyAd=:personelAdSoyAd,
// 		personelTel=:personelTel,
// 		personelMail=:personelMail,
// 		personelGorev=:personelGorev,
// 		dagitimHiz=:dagitimHiz,
// 		anlasmaSayisi=:anlasmaSayisi
// 		WHERE personelID={$_POST['personelID']}"
		
// 		);

// 		$insert=$kaydet->execute(array(
// 		'subeID' => $_POST['subeID'],
// 		'personelTc' => $_POST['personelTc'],
// 		'personelAdSoyAd' => $_POST['personelAdSoyad'],
// 		'personelTel' => $_POST['personelTel'],
// 		'personelMail' => $_POST['personelMail'],
// 		'personelGorev' => $_POST['personelGorev'],
// 		'dagitimHiz' => $_POST['dagitimHiz'],
// 		'anlasmaSayisi' => $_POST['anlasmaSayisi']
// 		));


// 	if ($insert) {
		
// 		//echo "kayıt başarılı";

// 		Header("Location:duzenle.php?durum=ok&personelID=$personelID");
// 		exit;

// 	} else {

// 		//echo "kayıt başarısız";
// 		Header("Location:duzenle.php?durumno&personelID=$personelID");
// 		exit;
// 	}

// }	

// 		//veri silme/personel
// 		if ($_GET['bilgiSiL']=="ok") {

// 			$sil=$db->prepare("DELETE from personel where personelID=:ID");
// 			$kontrol=$sil->execute(array(
// 				'ID' => $_GET['personelID']
// 			));
		
// 			if ($kontrol) {
				
// 				//echo "kayıt başarılı";
		
// 				Header("Location:personel.php?durum=ok");
// 				exit;
		
// 			} else {
		
// 				//echo "kayıt başarısız";
// 				Header("Location:personel.php?durum=no");
// 				exit;
// 			}
		
		
// 	}
?>