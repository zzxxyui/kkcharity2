<?php
    /*
        * Config for PayPal specific values
    */

    //Whether Sandbox environment is being used, Keep it true for testing
    define("SANDBOX_FLAG", true);

    //PayPal REST API endpoints
    define("SANDBOX_ENDPOINT", "https://api.sandbox.paypal.com");
    define("LIVE_ENDPOINT", "https://api.paypal.com");

    //Merchant ID
    define("MERCHANT_ID","VZAEB9ERB57K4");

    //PayPal REST App SANDBOX Client Id and Client Secret
    define("SANDBOX_CLIENT_ID" , "AS950xC1dw641XLFkc7qGVBO0JmW6XomvM79QyuXA12CJZ-SnX5-MUDxv4Rd");
    define("SANDBOX_CLIENT_SECRET", "EBWgBxA-LID1JoJgYQbVnFt2Jpoh0mt1VJOizQKTSehfHPwSyH475tQRZV9m");

    //Environments -Sandbox and Production/Live
    define("SANDBOX_ENV", "sandbox");
    define("LIVE_ENV", "production");

    //PayPal REST App SANDBOX Client Id and Client Secret
    define("LIVE_CLIENT_ID" , "live_Client_Id");
    define("LIVE_CLIENT_SECRET" , "live_Client_Secret");

    //ButtonSource Tracker Code
    define("SBN_CODE","PP-DemoPortal-EC-IC-php-REST");

?>