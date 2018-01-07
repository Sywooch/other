<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", ((CSalePaySystemAction::GetParamValue("TEST") == "Y")?1:0));
define("LOG_FILE", "./ipn.log");

error_log(date('[Y-m-d H:i e] '). "==============: ".print_r($_POST,true)."" . PHP_EOL, 3, LOG_FILE);

?>
<div>


<div class="b-order" style = "margin-top:-20px">

<div id = "order_form_div" class="order-checkout">


<div class="b-order__section _lined">


	<div class="grid-container b-layout__info-box">



		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12">



<?


if(strlen($_REQUEST['tx']) > 0) // PDT
{
	$req = 'cmd=_notify-synch';
	$tx_token = $_REQUEST['tx'];
	$auth_token = CSalePaySystemAction::GetParamValue("IDENTITY_TOKEN");
	$req .= "&tx=".$tx_token."&at=".$auth_token;
}
elseif(strlen($_POST['txn_id']) > 0 && $_SERVER["REQUEST_METHOD"] == "POST") // IPN
{	
	$tx = trim($_POST["txn_id"]);
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
		$keyval = explode ('=', $keyval);
		if (count($keyval) == 2)
			$myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
		$get_magic_quotes_exists = true;
	}
	foreach ($myPost as $key => $value) {
		if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
			$value = urlencode(stripslashes($value));
		} else {
			$value = urlencode($value);
		}
		$req .= "&$key=$value";
	}

	error_log(date('[Y-m-d H:i e] '). "--------------: $req" . PHP_EOL, 3, LOG_FILE);
}

if(USE_SANDBOX == true) {
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
curl_setopt($ch, CURLOPT_USERAGENT, $agent);

if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;
} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
		}
		curl_close($ch);
}

// Split response headers and payload, a better way for strcmp
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));

		$lines = explode("\n", $res);
		$keyarray = array();
		if(strcmp ($lines[0], "SUCCESS") == 0)
		{
			for ($i=1; $i<count($lines);$i++)
			{
				list($key,$val) = explode("=", $lines[$i]);
				$keyarray[urldecode($key)] = urldecode($val);
			}
			
			$strPS_STATUS_MESSAGE = "";
			$strPS_STATUS_MESSAGE .= "Name: ".$keyarray["first_name"]." ".$keyarray["last_name"]."; ";
			$strPS_STATUS_MESSAGE .= "Email: ".$keyarray["payer_email"]."; ";
			$strPS_STATUS_MESSAGE .= "Item: ".$keyarray["item_name"]."; ";
			$strPS_STATUS_MESSAGE .= "Amount: ".$keyarray["mc_gross"]."; ";
			
			$strPS_STATUS_DESCRIPTION = "";
			$strPS_STATUS_DESCRIPTION .= "Payment status - ".$keyarray["payment_status"]."; ";
			$strPS_STATUS_DESCRIPTION .= "Payment sate - ".$keyarray["payment_date"]."; ";
			$arOrder = CSaleOrder::GetByID($keyarray["custom"]);
			$arFields = array(
					"PS_STATUS" => "Y",
					"PS_STATUS_CODE" => "-",
					"PS_STATUS_DESCRIPTION" => $strPS_STATUS_DESCRIPTION,
					"PS_STATUS_MESSAGE" => $strPS_STATUS_MESSAGE,
					"PS_SUM" => $keyarray["mc_gross"],
					"PS_CURRENCY" => $keyarray["mc_currency"],
					"PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
					"USER_ID" => $arOrder["USER_ID"],
				);
			$arFields["PAY_VOUCHER_NUM"] = $tx_token;
			$arFields["PAY_VOUCHER_DATE"] = Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));

			$arFields["PAYED"] = "Y";
			$arFields["DATE_PAYED"] = Date(CDatabase:: DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));
			$arFields["EMP_PAYED_ID"] = false;

			if (IntVal($arOrder["PRICE"]) == IntVal($keyarray["mc_gross"])
				 && $keyarray["receiver_email"] == CSalePaySystemAction::GetParamValue("BUSINESS")
				 && $keyarray["payment_status"] == "Completed"
				)
				CSaleOrder::PayOrder($arOrder["ID"], "Y");

			CSaleOrder::Update($arOrder["ID"], $arFields);

			$firstname = $keyarray['first_name'];
			$lastname = $keyarray['last_name'];
			$itemname = $keyarray['item_name'];
			$amount = $keyarray['mc_gross'];
			
			echo "<p><h3>".GetMessage("PPL_T1")."</h3></p>";
			
			echo "<b>".GetMessage("PPL_T2")."</b><br>\n";
			echo "".GetMessage("PPL_T3").": $firstname $lastname<br>\n";
			echo "".GetMessage("PPL_T4").": $itemname<br>\n";
			echo "".GetMessage("PPL_T5").": $amount<br><br>\n";
		}
		elseif(strcmp ($res, "VERIFIED") == 0)
		{
			$strPS_STATUS_MESSAGE = "";
			$strPS_STATUS_MESSAGE .= GetMessage("PPL_T3").": ".$_POST["first_name"]." ".$_POST["last_name"]."; ";
			$strPS_STATUS_MESSAGE .= "Email: ".$_POST["payer_email"]."; ";
			$strPS_STATUS_MESSAGE .= GetMessage("PPL_T4").": ".$_POST["item_name"]."; ";
			$strPS_STATUS_MESSAGE .= GetMessage("PPL_T5").": ".$_POST["mc_gross"]."; ";
			
			$strPS_STATUS_DESCRIPTION = "";
			$strPS_STATUS_DESCRIPTION .= "Payment status - ".$_POST["payment_status"]."; ";
			$strPS_STATUS_DESCRIPTION .= "Payment sate - ".$_POST["payment_date"]."; ";
			$arOrder = CSaleOrder::GetByID($_POST["custom"]);

			$arFields = array(
					"PS_STATUS" => "Y",
					"PS_STATUS_CODE" => "-",
					"PS_STATUS_DESCRIPTION" => $strPS_STATUS_DESCRIPTION,
					"PS_STATUS_MESSAGE" => $strPS_STATUS_MESSAGE,
					"PS_SUM" => $_POST["mc_gross"],
					"PS_CURRENCY" => $_POST["mc_currency"],
					"PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
					"USER_ID" => $arOrder["USER_ID"],
				);
			$arFields["PAY_VOUCHER_NUM"] = $tx;
			$arFields["PAY_VOUCHER_DATE"] = Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));

			$arFields["PAYED"] = "Y";
			$arFields["DATE_PAYED"] = Date(CDatabase:: DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));
			$arFields["EMP_PAYED_ID"] = false; 

			if (IntVal($arOrder["PRICE"]) == IntVal($_POST["mc_gross"])
				 && $_POST["receiver_email"] == CSalePaySystemAction::GetParamValue("BUSINESS")
				 && $_POST["payment_status"] == "Completed"
				 && strlen($arOrder["PAY_VOUCHER_NUM"]) <= 0 
				 && $arOrder["PAY_VOUCHER_NUM"] != $tx
				)
			{
				CSaleOrder::PayOrder($arOrder["ID"], "Y");
			}
				
			if(strlen($arOrder["PAY_VOUCHER_NUM"]) <= 0 || $arOrder["PAY_VOUCHER_NUM"] != $tx)
			{
				CSaleOrder::Update($arOrder["ID"], $arFields);
			}
		}
		else
			echo "<p>".GetMessage("PPL_I1")."</p>";

?>

<?=GetMessage("PPL_I3")?><br /><br /><?=GetMessage("PPL_I4")?>




</div>


</div>

</div>
</div>

</div>

</div>

