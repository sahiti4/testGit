<?php 
$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');



//Function for encrypting with RSA
function rsa_encrypt($string, $public_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($public_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the encrypted version
    return $cipher->encrypt($string);
}

//Function for decrypting with RSA 
function rsa_decrypt($string, $private_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($private_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the decrypted version
    return $cipher->decrypt($string);
}

	$rsa = new Crypt_RSA();
	$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
	$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
	extract($rsa->createKey(1024)); /// makes $publickey and $privatekey available
	//echo $privatekey;
	//echo $publickey;
//Private key
$private_key = $privatekey;
$public_key = $publickey;

//Test out the rsa encryption functions
$plaintext = "This is some Plain Text to encrypt";
$ciphertext = rsa_encrypt($plaintext, $public_key);
//$decipheredtext = rsa_decrypt($ciphertext, $private_key);

//Echo out results
//echo sprintf("<h4>Plaintext for RSA encryption:</h4><p>%s</p><h4>After encryption:</h4><p>%s</p><h4>After decryption:</h4><p>%s</p>", $plaintext, $ciphertext, $decipheredtext);
$cyphertext = base64_encode($ciphertext);
$array = array("sender"=>'x',"receiver"=>'y',"encryptedMessage" => $cyphertext);
$jsonArray=json_encode($array);
file_put_contents("textCrypt.txt",$jsonArray);



$responseFile=file_get_contents("textCrypt.txt");
$responseArray=json_decode($responseFile,true);
$encodedMsg=$responseArray["encryptedMessage"];
$jsonDecodedmsg=base64_decode($encodedMsg);
$decipheredText = rsa_decrypt($jsonDecodedmsg, $private_key);
echo $decipheredText


//$responseFile=file_get_contents("testCrypt.txt");
//$responseArray=json_decode($responseFile,true);
//foreach($responseArray as $element){
//  $encodedMsg=$element["encryptedMessage"];
//$jsonDecodedmsg=base64_decode($encodedMsg);
//$deciphetext = rsa_decrypt($jsonDecodedmsg, $private_key);
//echo $deciphetext;  
//}
//$encodedMsg=$responseArray["encryptedMessage"];
//$jsonDecodedmsg=base64_decode($encodedMsg);
//$deciphetext = rsa_decrypt($jsonDecodedmsg, $private_key);
//echo $deciphetext;
//foreach($responseArray as $element){
//    //echo $value;
//    echo $element;
//  
////$deciphetext = rsa_decrypt($element['encryptedMessage'], $private_key);
//    //echo $deciphetext;
//}


//echo $deciphetext;
//$decypheredtext = rsa_decrypt($cypher, $private_key);


?>
