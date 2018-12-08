<?php 
require_once("class/class.md.crypt.php");

$key = '123456';
$cript = new mdCrypt($key);
//print_r($cript);

$var_org_encripted  = $cript->encrypt('test--');

echo $var_org_encripted."<br>";

$var_org_decripted  = $cript->decrypt('4IO1jF3ir13H0gkJABKrW+4tJxLt2Z3Gi5AhJGQwk01BBJmcsNCE2wIt2F3fqUg8sXnxGro+YFA5rUhO2ZqvbA==');

echo $var_org_decripted."<br>";

?>