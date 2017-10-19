<?php
ini_set("display_errors", On);
error_reporting(E_ALL);

if(isset($_GET['value'])){
	$input_value = $_GET['value'];
	$currency = $_GET['currency'];
	$currency2 = $currency.'_jpy';
	$base_url = 'https://api.zaif.jp/api/1/last_price/';
	$curl = curl_init();
	
	curl_setopt($curl, CURLOPT_URL, $base_url.$currency2);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
	
	$response = curl_exec($curl);
	$result = json_decode($response, true);
	
	$last_price = $result['last_price'];
	$amount = sprintf("%.05f", $input_value / $last_price);
	$last_price2 = sprintf("%f", $last_price);
	
	echo $input_value,'円で',$amount,$currency,'買えます（現在の',$currency2,':',$last_price2,'）';
}

?>
