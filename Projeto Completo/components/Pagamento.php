<?php

  include_once("./PagSeguroLibrary/PagSeguroLibrary.php");

  $paymentRequest = new PagSeguroPaymentRequest();  
  
  $paymentRequest->setCurrency("BRL");  

?>