<?php
  $stkCallbackResponse = file_get_contents('php://input');
  $logFile = "stkPushB2BCallbackResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $stkCallbackResponse);
  fclose($log);
