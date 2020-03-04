<?php

    function insert_response_to_db($jsonMpesaResponse){

    try{
        $conn = new PDO("mysql:dbhost=localhost;dbname=ectcoke_test", "ectcoke_testuser", "5T4aDgTl0B-K");
        echo "Connected successfully!";
    }
    catch(PDOException $e){
        die("ERROR connecting ".$e->getMessage());
    }

    try{
        $insertData = $conn->prepare("INSERT INTO `mobile_payment`(`TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`) 
        VALUES (:TransactionType, :TransID, :TransTime, :TransAmount, :BusinessShortCode, :BillRefNumber, :InvoiceNumber, :OrgAccountBalance, :ThirdPartyTransID, :MSISDN, :FirstName, :MiddleName, :LastName)");

        $insertData->execute((array)($jsonMpesaResponse));
    }catch(PDOException $e){
        $errLog = fopen('db_error.txt', 'a');
        fwrite($errLog, $e->getMessage());
        fclose($errLog);

        $logFailedTransaction = fopen('transaction_error.txt', 'a');
        fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
        fclose($logFailedTransaction);
    }

}
