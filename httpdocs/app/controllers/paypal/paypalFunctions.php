<?php
/********************************************
	Module contains calls to PayPal APIs
	********************************************/

	include('paypalConfig.php');

/*
	* Purpose: 	Gets the access token from PayPal
	* Inputs:
	* Returns:  access token
	*
	*/
	
function getMyProfileID($access_token){
	
	
	
	
	$curlServiceUrl2 = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl2 = $curlServiceUrl2. "/v1/payment-experience/web-profiles";
	
 
	$curlHeader2 = array("Content-Type:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".SBN_CODE);
	$postData2 ='
	{
 
                                  "name":"KKC Payment'.time().'",
                                  "presentation":{
                                     "brand_name":"Test Brand Name",
                                     "logo_image":"https://www.fb-games.net/blank.gif",
                                     "locale_code":"HK"
                                  },
								   "input_fields": {
									"allow_note": false,
									"no_shipping": 1,
									"address_override":1
								  },
								  "flow_config": {
									"landing_page_type": "billing",
									"bank_txn_pending_url": "http://www.inconcept.com"
								  }
  
		}
							   
							   ';
	
 
	$curlPostData2 = ($postData2);
	$curlResponse2 = curlCall($curlServiceUrl2, $curlHeader2, $curlPostData2);
 
 
	$experience_profile_id = $curlResponse2['id'];
	
 
    return $experience_profile_id;
}
	
function getAccessToken(){
	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/oauth2/token";
	$clientId = (SANDBOX_FLAG ? SANDBOX_CLIENT_ID : LIVE_CLIENT_ID);
	$clientSecret = (SANDBOX_FLAG ? SANDBOX_CLIENT_SECRET : LIVE_CLIENT_SECRET);
	$curlHeader = array(
		 "Content-type" => "application/json",
		 "Authorization: Basic ". base64_encode( $clientId .":". $clientSecret),
		 "PayPal-Partner-Attribution-Id" => SBN_CODE
		 );
	$postData = array(
		 "grant_type" => "client_credentials"
		 );

	$curlPostData = http_build_query($postData);
	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $curlPostData);
	$access_token = $curlResponse['access_token'];
	
	
	
	
	
    return $access_token;
}


/*
	* Purpose: 	Gets the PayPal approval URL to redirect the user to.
	* Inputs:
	*		access_token    : The access token received from PayPal
	* Returns:              approval URL
	*/
function getApprovalURL($access_token, $postData){
	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/payments/payment";
	$curlHeader = array("Content-Type:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".SBN_CODE);

	$curlResponse = curlCall($curlServiceUrl, $curlHeader, $postData);
 
if(isset($curlResponse['links'])){
 
	foreach ($curlResponse['links'] as $link) {
		if($link['rel'] == 'approval_url'){
			$approval_url = $link['href'];
			echo($approval_url);
			return $approval_url;
		}
	 }
}
}

/*
	* Purpose: 	Look up a payment resource, to get details about payments that have not yet been completed
	* Inputs:
	*		paymentID    : The id of the created payment
	* Returns:              the payment object
	*/
function lookUpPaymentDetails($paymentID, $access_token){
	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
	$curlServiceUrl = $curlServiceUrl. "/v1/payments/payment/". $paymentID;
	$curlHeader = array("Content-Type:application/json", "Authorization:Bearer ".$access_token, "PayPal-Partner-Attribution-Id:".SBN_CODE);

	$curlResponse = curlCall($curlServiceUrl, $curlHeader, NULL);
	return $curlResponse;

}


/*
	* Purpose: 	Executes the previously created payment for a given paymentID for a specific user's payer id.
	* Inputs:
	*		paymentID    : The id of the previously created PayPal payment
	*       payerID      : The id of the user received from PayPal
	*       transactionAmountArray   : amount array if updating the payment amount
	* Returns:             response of the executed payment
	*/
function doPayment($ac, $paymentID, $payerID, $transactionAmountArray){
	$curlServiceUrl = (SANDBOX_FLAG ? SANDBOX_ENDPOINT : LIVE_ENDPOINT);
    $curlServiceUrl = $curlServiceUrl. "/v1/payments/payment/". $paymentID ."/execute";
    $curlHeader = array("Content-Type:application/json", "Authorization:Bearer ".$ac, "PayPal-Partner-Attribution-Id:".SBN_CODE);

	$postData = array(
                    "payer_id" => $payerID
                    );

    if(!is_null($transactionAmountArray)){
    	$postData ["transactions"][0] = $transactionAmountArray;
    }

    $curlPostData = json_encode($postData);
	
	//print_r(    $curlPostData ). print_r(    $curlHeader ) ;
	//echo     $curlServiceUrl ;
    $curlResponse = curlCall($curlServiceUrl, $curlHeader, $curlPostData);
    return $curlResponse;
}

?>