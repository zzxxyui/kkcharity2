<?php
/*
	* Contains common useful functions

	* Purpose: 	To make a cURL call to REST API
	* Inputs:
	*		curlServiceUrl    : the service URL for the REST api
	*       curlHeader        : the header parameters specific to the REST api call
	*       curlPostData      : the post parameters encoded in the form required by the api (json_encode or http_build_query)
	* Returns:                the json decoded result from the REST api call
	*/
function curlCall($curlServiceUrl, $curlHeader, $curlPostData) {

		//set the cURL parameters
		$ch = curl_init($curlServiceUrl);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_SSLVERSION , 'CURL_SSLVERSION_TLSv1_2');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeader);

		if(!is_null($curlPostData)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPostData);
		}
		//getting response from server
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

		if (empty($response)) {
			// some kind of an error happened
			die(curl_error($ch));
			curl_close($ch); // close cURL handler
		}
		else {
			curl_close($ch);
			if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
				/*
				echo "Received error: " . $info['http_code'];
				echo "<br/>";
				echo "Raw response:".$response;
				die();   //instead of die, you can put error handling code here*/
							
	return array('error'=>1,'msg'=>"
	 Received error: " . $info['http_code']."
	 <br/> Raw response:".$response." 
				");
				
			}

			$header = substr($response,0, $header_size);
			$body = substr($response,$header_size);
			$json = json_decode($body, true);
			return $json;
		}
}


/**
 * Prevents Cross-Site Scripting Forgery
 * @return boolean
 */
function verify_nonce() {
	if( isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	if( isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	return false;
}

?>