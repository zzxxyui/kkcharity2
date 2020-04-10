<?php

if (session_id() !== "") {
       session_unset();
       session_destroy();
    }
    session_start();
    $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
/*
    * Data for REST API calls.
    * $_SESSION['expressCheckoutPaymentData'] is used in the Express Checkout flow
    * $_SESSION['markFlowPaymentData'] is used for the Proceed to Checkout/Mark flow
    */
	 
$hostName = $_SERVER['HTTP_HOST'];
//$appName = explode("/", $_SERVER['REQUEST_URI'])[1];
$appName = ROOT_PATH;
//$cancelUrl= "http://".$hostName."/".$appName."/cancel.php";
/*
$cancelUrl= "http://".$hostName."/".$appName."/cancel.php";
$payUrl = "http://".$hostName."/".$appName."/pay.php";
$placeOrderUrl = "http://".$hostName."/".$appName."/placeOrder.php";
 */
$cancelUrl= DOMAIN.$this->lang_name."cancel";
$payUrl =  DOMAIN.$this->lang_name."pay";
$placeOrderUrl = DOMAIN.$this->lang_name."placeOrder";
 
 
 

?>