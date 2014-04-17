<?php 

class Crypter {

	/**
	 * The encryption cipher.
	 *
	 * @var string
	 */
	public static $cipher = MCRYPT_RIJNDAEL_256;

	/**
	 * The encryption mode.
	 *
	 * @var string
	 */
	public static $mode = MCRYPT_MODE_CBC;

	/**
	 * The block size of the cipher.
	 *
	 * @var int
	 */
	public static $block = 32;

	/**
	 * Encrypt a string using Mcrypt.
	 *
	 * The string will be encrypted using the AES-256 scheme and will be base64 encoded.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function encrypt($value)
	{
		$iv = mcrypt_create_iv(static::iv_size(), static::randomizer());

		$value = static::pad($value);

		$value = mcrypt_encrypt(static::$cipher, static::key(), $value, static::$mode, $iv);

		return base64_encode($iv.$value);
	}

	/**
	 * Decrypt a string using Mcrypt.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function decrypt($value)
	{
		$value = base64_decode($value);

		// To decrypt the value, we first need to extract the input vector and
		// the encrypted value. The input vector size varies across different
		// encryption ciphers and modes, so we'll get the correct size.
		$iv = substr($value, 0, static::iv_size());

		$value = substr($value, static::iv_size());

		// Once we have the input vector and the value, we can give them both
		// to Mcrypt for decryption. The value is sometimes padded with \0,
		// so we will trim all of the padding characters.
		$key = static::key();

		$value = mcrypt_decrypt(static::$cipher, $key, $value, static::$mode, $iv);

		return static::unpad($value);
	}

	/**
	 * Get the most secure random number generator for the system.
	 *
	 * @return int
	 */
	public static function randomizer()
	{
		// There are various sources from which we can get random numbers
		// but some are more random than others. We'll choose the most
		// random source we can for this server environment.
		if (defined('MCRYPT_DEV_URANDOM'))
		{
			return MCRYPT_DEV_URANDOM;
		}
		elseif (defined('MCRYPT_DEV_RANDOM'))
		{
			return MCRYPT_DEV_RANDOM;
		}
		// When using the default random number generator, we'll seed
		// the generator on each call to ensure the results are as
		// random as we can possibly get them.
		else
		{
			mt_srand();

			return MCRYPT_RAND;
		}
	}

	/**
	 * Get the input vector size for the cipher and mode.
	 *
	 * @return int
	 */
	protected static function iv_size()
	{
		return mcrypt_get_iv_size(static::$cipher, static::$mode);
	}

	/**
	 * Add PKCS7 compatible padding on the given value.
	 *
	 * @param  string  $value
	 * @return string
	 */
	protected static function pad($value)
	{
		$pad = static::$block - (Str::length($value) % static::$block);

		return $value .= str_repeat(chr($pad), $pad);
	}

	/**
	 * Remove the PKCS7 compatible padding from the given value.
	 *
	 * @param  string  $value
	 * @return string
	 */
	protected static function unpad($value)
	{
		$pad = ord($value[($length = Str::length($value)) - 1]);

		if ($pad and $pad < static::$block)
		{
			// If the correct padding is present on the string, we will remove
			// it and return the value. Otherwise, we'll throw an exception
			// as the padding appears to have been changed.
			if (preg_match('/'.chr($pad).'{'.$pad.'}$/', $value))
			{
				return substr($value, 0, $length - $pad);
			}

			// If the padding characters do not match the expected padding
			// for the value we'll bomb out with an exception since the
			// encrypted value seems to have been changed.
			else
			{
				throw new \Exception("Decryption error. Padding is invalid.");
			}
		}

		return $value;
	}

	public static function decryptFileAndReturn($file ,$filename,  $passphrase){
		 
				$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		 
		// Open the file
		$fp = fopen($file, 'rb');
		 
		// Add the Mcrypt stream filter
		// We use Triple DES here, but you
		// can use other encryption algorithm here
		$stat = fstat($fp);
$size = $stat['size'];
		stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
		    header("Cache-Control: public"); // needed for i.e.
         //   header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".$size);
            header("Content-Disposition: attachment; filename=".$filename);
		//header("Content-Type: image/png");
		//header("Content-Length: " . 12);
		// Read the file contents
		fpassthru($fp);
	}


	public static function encryptFile($from , $to, $passphrase){
		
		 
		$iv = substr(md5("\x1B\x3C\x58".$passphrase, true), 0, 8);
		$key = substr(md5("\x2D\xFC\xD8".$passphrase, true) .
		md5("\x2D\xFC\xD9".$passphrase, true), 0, 24);
		$opts = array('iv'=>$iv, 'key'=>$key);
		 
		// Open the file
		$fp = fopen($to, 'w');
		//throw new Exception($to);  
		// Add the Mcrypt stream filter
		// We use Triple DES here, but you
		// can use other encryption algorithm here
		stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
		// fwrite($fp, "as");
		// fclose($fp);/*

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
		fclose($fp);
	}

	/**
	 * Get the encryption key from the application configuration.
	 *
	 * @return string
	 */
	protected static function key()
	{
		return Config::get('application.key');
	}

}