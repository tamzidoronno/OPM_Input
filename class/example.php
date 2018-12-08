<?php 

/****
****
*** @ PHP AES-128-CBC class
*** @ Developed by Takis Maletsas 
****
****/

/*require "aes.class.php";

$aes = new AES;
$aes->setData("Hello world !");

$encrypted = $aes->encrypt();

//You can use setKey() and setIV() in the encryption process.
//If you don't, the class will produce random key and IV.
//You can get them with getKey() and getIV().

$aes->setKey($aes->getKey());
$aes->setIV($aes->getIV());
$aes->setData($encrypted);

$decrypted = $aes->decrypt();

echo $encrypted . "<br/>" . $decrypted;

$key="123456";
$iv="5";
//Encrypted: hibcqPrxD0rv2E5b5/LzYQ==
//Decrypted: Hello world !
echo "<br/>";
$plaintext = "message to be encrypted";
$cipher = "aes-128-gcm";
if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
    //echo $ciphertext;
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
    echo $ciphertext . "<br/>" . $original_plaintext;
}*/
echo "<br><br>";
$key="123456";
//$cipher = "aes-128-gcm";
$cipher="AES-128-CBC";
//$key previously generated safely, ie: openssl_random_pseudo_bytes
$plaintext = "message to be encrypted";
$ivlen = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);
$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
echo "orgtext:".$plaintext."<br>";
echo "key:".$key."<br>";
echo "ivlen:".$ivlen."<br>";
echo "iv:".$iv."<br>";
echo "encripted:".$ciphertext."<br>";

//echo "<br>".$ciphertext;

//decrypt later....
$c = base64_decode($ciphertext);
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len=32);
$ciphertext_raw = substr($c, $ivlen+$sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);

echo "orgtext:".$plaintext."<br>";
echo "key:".$key."<br>";
echo "ivlen:".$ivlen."<br>";
echo "iv:".$iv."<br>";
echo "encripted:".$ciphertext."<br>";
//echo "<br>".$original_plaintext;
$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
{
    echo "<br>".$original_plaintext."\n";
}


?>