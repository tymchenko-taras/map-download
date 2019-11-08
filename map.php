<?php
	ini_set('user_agent', 'Mozilla/5.0 (Windows; I; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20100101 Firefox/4.0');

	$headers = array(
		'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Encoding' => 'gzip, deflate',
		'Accept-Language' => 'en-US,en;q=0.5',
		'Cache-Control' => 'no-cache',
		'Connection' => 'keep-alive',
		'Cookie' => '__utma=233535106.1419915839.1417158987.1417163131.1417173688.3; __utmz=233535106.1417158987.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmc=233535106',
		'Host' => 'tiles.mapire.eu',
		'Pragma' => 'no-cache',
		'User-Agent' => 'Mozilla/5.0 (Windows; I; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20100101 Firefox/4.0 /api-debug',
	);
	
	function download($url, $headers){
		$head = array();
		foreach( $headers as $key => $val){
			$head[] = $key . ': '.$val;
		}
		$session  = curl_init();
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HTTPHEADER, $head);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($session);
		
		return $response;
	}



	for($x = 490; $x < 530; $x++){
		for($y = 165; $y < 220; $y++){
			usleep(rand(560720, 2002050));
			$t = microtime(1);
			
			$result = download(
				'http://mapsite/secondsurvey/galicia_g.jp2/13/'. $x .'/'.$y,
				$headers
			);
			
			echo 'time '. (microtime(1) - $t). PHP_EOL;
			if( $result ){

				file_put_contents('D:\documents\historical_ostriv2/'.$x.'x'.$y.'.jpg', $result);
				

			} else {
				
			}
		}
	}
	
// 	merge downloaded images using graphicsmagick
//	for /l %%x in (450, 1, 550) do (
//   echo %%x
//   gm convert -append %%x*.jpg d:\documents\history\%%x.jpg
//)