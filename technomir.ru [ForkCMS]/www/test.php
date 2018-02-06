<?php
header('Content-type: text/html; charset=utf-8');
//namespace Symfony\Component\Security\Core\Encoder;

//use Symfony\Component\Security\Core\Exception\BadCredentialsException;
//echo"12344";
//exit;
function hashPbkdf2($algorithm, $password, $salt, $iterations, $length = 0)
    {
        // Number of blocks needed to create the derived key
        $blocks = ceil($length / strlen(hash($algorithm, null, true)));
        $digest = '';

        for ($i = 1; $i <= $blocks; $i++) {
            $ib = $block = hash_hmac($algorithm, $salt.pack('N', $i), $password, true);

            // Iterations
            for ($j = 1; $j < $iterations; $j++) {
                $ib ^= ($block = hash_hmac($algorithm, $block, $password, true));
            }

            $digest .= $ib;
        }

        return substr($digest, 0, $length);
    }



$digest=hashPbkdf2('sha512','123456', '548272481fd69', 1000, 20);

$algo=hash_algos();
//echo $algo[0]."<br>";
for($i=1;$i<99999999;$i++){
	foreach ($algo as $id =>$value) { 
	//echo $value."<br>"; 
	$digest=hashPbkdf2($value,'123456', '548272481fd69', $i, 20);
	echo bin2hex($digest)." - ".$value." - ".$i."<br>";
	if("4b4be6b45c597a708023ad990ee2b56f1c149551" == bin2hex($digest)){ exit; echo"OK"; }
	}
}

//echo base64_encode($digest);
echo"<br>";
echo bin2hex($digest);
//$digest=encodePassword('123456', '548272481fd69');


// $digest = $Pbkdf2PasswordEncoder->hashPbkdf2('sha512', '123456', '548272481fd69', 1000, 40);
//$digest = hash_pbkdf2('sha512', '123456', '548272481fd69', 1000, 40, true);

//echo $digest;


?>