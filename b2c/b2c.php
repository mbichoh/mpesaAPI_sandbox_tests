<?php

    //token
    $consumer_key = 'xu5va2L8rufsCxhUWmFat0NSZsAucLTE';
    $consumer_secret = 'D6kfeHbuzITXWrfu';

    $headers = ['Content-Type:application/json; charset=utf8'];

    //variables
    $InitiatorName = 'testapi';
    $SecurityCredential = 'Ma+fypJ/JxLeYeBY5ApxkbOakhGiYmuueb1FFTrGW7SZxYBZBjC9x6LenZQQ8kReP9IvmKTDVqwZUifxXEg2CGyKnfSxCFOVmoFQO5FFGWlPAnBUuZ+9VMuGuq6z2alzVS6gNQojnzacv6B9tDCxlxONvsLPfqWXL5k+Ogg8lNEccKFfUVQI0ktIEeaf6vtEkR3zEhi67fqdZg9aVv9f3/zXgKV+/LKRDJ4fKILbu9QapO1KJqNEOXs80rWGvvpstqoywlH5xPOxcJ6esfxjt4qxa4CMmSRXs3QS39vY22Gguo8AP2416BMW4ks0qPW8OcqGgzcuqSZs+Jzus52oNg==';
    $CommandID = 'SalaryPayment';
    $Amount = '1000';
    $PartyA = '600468';
    $PartyB = '254708374149';
    $Remarks = 'Salary';
    $QueueTimeOutURL = 'https://ect.co.ke/dist/safaricom_api/b2c/callback_url.php';
    $ResultURL = 'https://ect.co.ke/dist/safaricom_api/b2c/callback_url.php';
    $Occasion = 'February Salary';

    //urls
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

    curl_setopt($curl, CURLOPT_HEADER, FALSE);

    curl_setopt($curl, CURLOPT_USERPWD, $consumer_key.':'.$consumer_secret);

    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);

    $b2cheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $b2c_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cheader); //setting custom header
    
    $curl_post_data = array(
        //Fill in the request parameters with valid values
        'InitiatorName' => $InitiatorName,
        'SecurityCredential' => $SecurityCredential,
        'CommandID' => $CommandID,
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $PartyB,
        'Remarks' => $Remarks,
        'QueueTimeOutURL' => $QueueTimeOutURL,
        'ResultURL' => $ResultURL,
        'Occasion' => $Occasion
    );
    
    $data_string = json_encode($curl_post_data);
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
    print_r($curl_response);
    
    echo $curl_response;
