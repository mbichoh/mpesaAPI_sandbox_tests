<?php

    //token
    $consumer_key = 'xu5va2L8rufsCxhUWmFat0NSZsAucLTE';
    $consumer_secret = 'D6kfeHbuzITXWrfu';

    $headers = ['Content-Type:application/json; charset=utf8'];

    //urls
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

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

    //variables
    $Initiator = 'testapi';
    $SecurityCredential = 'aOOVKXHkAFdsZqSEyWg9j7gE8knLPLOdYkZkBhJCR3LWrHKjnHt1b2XZRQUZfa/5groXyzdqa5aL2RwhMzgSkzzzAEKiKFuPDA45tywGQxN9RxBGKcrOwzTwL3wbEjpd9CMseDoDZ5m+WwCnXr/2lJ6M8KTVaW3Zza8uWu8KNoeC1vq4JFw99xViqfs1L/Gm7E6zNGKZ6799o1CeeCzmIrztpiwSGnXOteJvmURG34yO+EcgwhDuum8jPRiDhMjVdYWZwvF/MkzY0jxTRM08+BZhRdyI8CosQaetFWZ7YVH72w2uk7D+HaGqJZrXIMrRA25mVjLnjqfPmRQuQ+La0w==';
    $CommandID = 'BusinessPayBill';
    $SenderIdentifierType = '4';
    $Amount = '25000';
    $PartyA = '600468';
    $PartyB = '600000';
    $AccountReference = 'BILL PAYMENT';
    $Remarks = 'Pay for chama yetu fine';
    $ResultURL = 'https://ect.co.ke/dist/safaricom_api/b2b/callback_url.php';

    $b2bHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
    
    $b2b_url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $b2b_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $b2bHeader); //setting custom header
    
    
    $curl_post_data = array(
        //Fill in the request parameters with valid values
        'Initiator' => $Initiator,
        'SecurityCredential' => $SecurityCredential,
        'CommandID' => $CommandID,
        'SenderIdentifierType' => $SenderIdentifierType,
        'RecieverIdentifierType' => $SenderIdentifierType,
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $PartyB,
        'AccountReference' => $AccountReference,
        'Remarks' => $Remarks,
        'QueueTimeOutURL' => $ResultURL,
        'ResultURL' => $ResultURL
    );
    
    $data_string = json_encode($curl_post_data);
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
    print_r($curl_response);
    
    echo $curl_response;