<?php

class Crypt  {

	public static function encrypt($from , $to){
		$passphrase = 'My secret';
 		echo ($to);  
		// Turn a human readable passphrase
		// into a reproducible iv/key pair
		 
		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		 
		// Open the file
		$fp = fopen($to, 'w');
		throw new Exception($to);  
		// Add the Mcrypt stream filter
		// We use Triple DES here, but you
		// can use other encryption algorithm here
	//	stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
		 fwrite($fp, "as");
		 fclose($fp);/*

		 $handle = @fopen($from, "r");
		if ($handle) {
		    while (($buffer = fgets($handle, 4096)) !== false) {
		    	fwrite($fp, $buffer);
		        //echo $buffer;
		    }
		    if (!feof($handle)) {
		        //echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);
		}
		// Wrote some contents to the file
		
		 
		// Close the file
		fclose($fp);*/
	}

}