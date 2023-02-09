<?php

class Export{
    
    function to_excel($array, $filename) {
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
	
		//Filter all keys, they'll be table headers
		$h = array();
		foreach($array as $row){
			foreach($row as $key=>$val){
				if(!in_array($key, $h)){
				 $h[] = $key;   
				}
			}
		}
		//echo the entire table headers
		echo '<table><tr>';
		foreach($h as $key) {
			$key = ucwords($key);
			echo '<th>'.$key.'</th>';
		}
		echo '</tr>';
		
		foreach($array as $row){
			echo '<tr>';
			foreach($row as $val){
				$this->writeRow($val);
			}
		}
		echo '</tr>';
		echo '</table>';	
	}
	
	function to_excel_noheaders($array, $filename) {
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
	
		//Filter all keys, they'll be table headers
		$h = array();
		foreach($array as $row){
			foreach($row as $key=>$val){
				if(!in_array($key, $h)){
				 $h[] = $key;   
				}
			}
		}
		//echo the entire table headers
		echo '<table>';
		
		foreach($array as $row){
			echo '<tr>';
			foreach($row as $val){
				$this->writeRow($val);
			}
		}
		echo '</tr>';
		echo '</table>';	
	}
	
    function writeRow($val) {
       	echo '<td>'.utf8_decode($val).'</td>';              
    }
	
	function to_csv_report_bookappointment_new($array,$filename)
	{
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");	
		header("Content-Transfer-Encoding: UTF-8");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$no = 1;
		$res = "No., ID Pasien, Nama, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Pekerjaan, Alamat, Kodepos, Negara, Propinsi, Kota, No. Telepon, No. Handphone, Name Orang Terdekat, No. Telepon Orang Terdekat, Hubungan, Email, Keluhan, Saya butuh operasi, Apakah Ada Surat Rujukan?, Nama Dokter Yang Merujuk, Tanggal Surat Rujukan, Apakah Anda merencanakan LASIK?, Apakah Anda menggunakan Lensa Kontak?, Dari mana Anda mengetahui Klinik Mata Nusantara (KMN)?, Hipertensi, Diabetes Mellitus, Operasi Yang Pernah Dilakukan Pada Mata, Obat 1, Obat 2, Obat 3, Obat 4, Obat 5, Alergi 1, Alergi 2, Alergi 3, Alergi 4, Alergi 5, Pernah mengalami reaksi alergi yang hebat akibat penggunaan obat tertentu?, Nama Obat, Tanggal Appointment, Dokter, Lokasi, Jadwal Praktek, Tanggal Form, URL PDF \n";
		for($i=0;$i<count($array);$i++)
		{
		 $res .= $no.",".$array[$i]['id_pasien'].",".$array[$i]['full_name'].",".$array[$i]['gender'].",".$array[$i]['place_of_birth'].",".$array[$i]['date_of_birth'].",".$array[$i]['job'].",".$array[$i]['address'].",".$array[$i]['postalcode'].",".$array[$i]['country_name'].",".$array[$i]['province_name'].",".$array[$i]['city_name'].",'".$array[$i]['phone'].",'".$array[$i]['mobilephone'].",".$array[$i]['name_family'].",'".$array[$i]['phone_family'].",".$array[$i]['relationship'].",".$array[$i]['email'].",".$array[$i]['complaint'].",".$array[$i]['is_surgery'].",".$array[$i]['is_rujukan'].",".$array[$i]['doctor_rujukan'].",".$array[$i]['date_of_rujukan'].",".$array[$i]['is_lasik'].",".$array[$i]['is_lensakontak'].",".$array[$i]['info_from'].",".$array[$i]['is_hypertension'].",".$array[$i]['is_diabetesmelitus'].",".$array[$i]['is_eye_surgery'].",".$array[$i]['medicine1'].",".$array[$i]['medicine2'].",".$array[$i]['medicine3'].",".$array[$i]['medicine4'].",".$array[$i]['medicine5'].",".$array[$i]['allergy1'].",".$array[$i]['allergy2'].",".$array[$i]['allergy3'].",".$array[$i]['allergy4'].",".$array[$i]['allergy5'].",".$array[$i]['is_medicine'].",".$array[$i]['medicine_name'].",".$array[$i]['date_appointment'].",".str_replace(","," ",$array[$i]['doctor_name']).",".$array[$i]['location_title'].",".$array[$i]['doctor_2_schedule_shift'].",".$array[$i]['book_appointment_create_date'].",".$array[$i]['pdf_pasien']." \n";
		 $no++;
		}
		echo $res;
	}
	
	function to_csv_report_bookappointment_existing($array,$filename)
	{
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");	
		header("Content-Transfer-Encoding: UTF-8");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$no = 1;
		$res = "No., No. Kartu Pasien, Nama, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Usia, Pekerjaan, Alamat, Kodepos, Propinsi, Kota, No. Telepon, No. Handphone, Email, Keluhan, Tanggal Appointment, Dokter, Lokasi, Jadwal Praktek, Tanggal Form \n";
		for($i=0;$i<count($array);$i++)
		{
		 $res .= $no.",'".$array[$i]['no_patient_card'].",".$array[$i]['patient_name'].",".$array[$i]['gender'].",".$array[$i]['place_of_birth'].",".$array[$i]['date_of_birth'].",".$array[$i]['age'].",".$array[$i]['job'].",".$array[$i]['address'].",".$array[$i]['postalcode'].",".$array[$i]['province_name'].",".$array[$i]['city_name'].",'".$array[$i]['phone'].",'".$array[$i]['mobilephone'].",".$array[$i]['email'].",".$array[$i]['complaint'].",".$array[$i]['date_appointment'].",".str_replace(","," ",$array[$i]['doctor_name']).",".$array[$i]['location_title'].",".$array[$i]['doctor_2_schedule_day']." ".$array[$i]['doctor_2_schedule_notes']." ".$array[$i]['doctor_2_schedule_time'].",".$array[$i]['book_appointment_existing_create_date']." \n";
		 $no++;
		}
		echo $res;
	}
	
	function to_csv_report_bookappointment_surgery($array,$filename)
	{
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");	
		header("Content-Transfer-Encoding: UTF-8");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$no = 1;
		$res = "No., Nama, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Pekerjaan, Alamat, Propinsi, Kota, No. Telepon, No. Handphone, Email, Tanggal Form \n";
		for($i=0;$i<count($array);$i++)
		{
		 $res .= $no.",".$array[$i]['fullname'].",".$array[$i]['gender'].",".$array[$i]['place_of_birth'].",".$array[$i]['date_of_birth'].",".$array[$i]['job'].",".$array[$i]['address'].",".$array[$i]['province_name'].",".$array[$i]['city_name'].",'".$array[$i]['phone'].",'".$array[$i]['mobilephone'].",".$array[$i]['email'].",".$array[$i]['book_appointment_surgery_create_date']." \n";
		 $no++;
		}
		echo $res;
	}
	
	function to_csv_report_seminar($array,$filename)
	{
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");	
		header("Content-Transfer-Encoding: UTF-8");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$no = 1;
		$res = "No., Seminar, Nama, Email, No. Telepon, Alamat, Tempat Lahir, Tanggal Lahir, Kodepos, Propinsi, Tanggal Form \n";
		for($i=0;$i<count($array);$i++)
		{
		 $res .= $no.",".$array[$i]['seminar_name'].",".$array[$i]['full_name'].",".$array[$i]['email'].",'".$array[$i]['phone'].",".$array[$i]['address'].",".$array[$i]['place_of_birth'].",".$array[$i]['date_of_birth'].",".$array[$i]['postalcode'].",".$array[$i]['province_name'].",".$array[$i]['seminar_user_create_date']." \n";
		 $no++;
		}
		echo $res;
	}
	
	function to_csv_report_doku($array,$filename)
	{
		header('Content-Type: application/csv');
		header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");	
		header("Content-Transfer-Encoding: UTF-8");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$no = 1;
		$res = "No., Promo, Nama, Email, Invoice, Tipe Pembayaran, Status, Bank, Kode Pembayaran / Persetujuan, Kode Pembayaran / No. Kartu Kredit, Tempat Lahir, Tanggal Lahir, Alamat, Kodepos, No. Telepon, Propinsi, Kota, Dokter, Tanggal Form \n";
		for($i=0;$i<count($array);$i++)
		{
		 $res .= $no.",".$array[$i]['promo_title'].",".$array[$i]['name'].",".$array[$i]['email'].",".$array[$i]['transidmerchant'].",".$array[$i]['payment_channel'].",".$array[$i]['response_code'].",".$array[$i]['bank_issuer'].",'".$array[$i]['code_issuer'].",'".$array[$i]['creditcard'].",".$array[$i]['place_of_birth'].",".$array[$i]['date_of_birth'].",".$array[$i]['address'].",".$array[$i]['postalcode'].",'".$array[$i]['phone'].",".$array[$i]['province_name'].",".$array[$i]['city_name'].",".$array[$i]['doctor_name'].",".$array[$i]['create_date']." \n";
		 $no++;
		}
		echo $res;
	}
}
?>