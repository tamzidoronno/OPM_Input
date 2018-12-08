<?php 

/****
****
*** @ PHP AES-128-CBC class
*** @ Developed by Takis Maletsas 
****
****/

class AES
{
	private $data, $key, $cipher, $mode, $IV;

	public function __construct()
	{
		$this->key    = md5(substr(sha1(rand()), 2, 10));
		$this->cipher = MCRYPT_RIJNDAEL_128;
		$this->mode   = MCRYPT_MODE_CBC;
		$this->IV     = mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
	}

	public function encrypt()
	{
		return trim(
			base64_encode(
			str_rot13(
			mcrypt_encrypt($this->cipher, $this->key, $this->data, $this->mode, $this->IV))));
	}

	public function decrypt()
	{
		return trim(
			mcrypt_decrypt($this->cipher, $this->key, 
				str_rot13(
				base64_decode($this->data)), $this->mode, $this->IV));
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setKey($key)
	{
		$this->key = $key;
	}

	public function setIV($IV)
	{
		$this->IV = $IV;
	}

	public function getKey()
	{
		return $this->key;
	}

	public function getIV()
	{
		return $this->IV;
	}
}

?>