<?php 
	
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Methods: POST');  
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	header("Content-Type: application/json; charset=UTF-8");
	
	$jsonString = file_get_contents('php://input');
	

	$url = 'http://www.greening.gov.hk/treeregister/map/iTreeService.asmx/GetTreeBySearch';

	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/json\r\n",
	        'method'  => 'POST',
	        'content' => $jsonString
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }
	echo $result;
?>