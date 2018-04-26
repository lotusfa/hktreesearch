<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function search($treeID){
    	$jsonString = '{"codeType":"TreeCode","code":"'.$treeID.'","ts":"0","distID":"0","departID":"0","tc":"0","lang":"zh-HK","brr":"false"}';
    	

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
    	$rArr = json_decode($result, true);
    	$count = count($rArr['d']);
    	$treeObj = $rArr['d'];
    	
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

		return view('search',[ 'trees' => $treeObj , 'count' => $count , 'ranString' => generateRandomString(1) ]);
    }

    public function info($treeID){
    	
    	$jsonString = "{id:".$treeID.",lang:'zh-HK'}";
    	
    	$url = 'http://www.greening.gov.hk/treeregister/map/iTreeService.asmx/GetTreeMapInfo';

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
    	$rArr = json_decode($result, true);
    	$count = count($rArr['d']);
    	$tree = $rArr['d'];
    	$imgLink = "https://www.greening.gov.hk/treeregister/map/".$rArr['d']['photos'][0];
    	$treeInfo = array(
    		"Name" => $tree['species'],
    		"地區" => $tree['district'],
    		"Address" => $tree['address'],
    		"Status" => $tree['status'],
    		"Condition" => $tree['condition'],
    		"Memo" => $tree['mm'],
    		"other" => $tree['other'],
    		"Department" => $tree['depart'],
    		"Code" => $tree['treecode'],
    		"RefNo" => $tree['refno']
    		);

		return view('info',[ 'tree' => $treeInfo , 'imgLink' => $imgLink ]);
    }



    
}

