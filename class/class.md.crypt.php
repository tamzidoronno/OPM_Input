<?php 

class mdCrypt{
    private $key;
    private $ivlen;
    private $iv;
    private $options;
    private $cipher="AES-128-CBC";
    
    public function __construct($key=''){
        if($key)
            $this->key      = $key;
        else
            $this->key      = md5(substr(sha1(rand()), 2, 8));    
    }
    
    public function encrypt($string=''){
        $key = sha1($this->key);
		$strLen = strlen($string);
		$keyLen = strlen($key);
		$j = 0;
		$hash = '';
		for ($i = 0; $i < $strLen; $i++) {
			$ordStr = ord(substr($string,$i,1));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
		}
		return $hash;
    }
    
    public function decrypt($string=''){
        $key = sha1($this->key);
		$strLen = strlen($string);
		$keyLen = strlen($key);
		$j = 0;
		$hash = '';
		for ($i = 0; $i < $strLen; $i+=2) {
			$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= chr($ordStr - $ordKey);
		}
		return $hash; 
    }
	
    public function setKey($key=''){
        if($key)
            $this->key = $key;
    }
	
	public function getKey($key=''){
        return $this->key;
    }
}
?>