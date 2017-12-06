# Paycorp PHP Library (Unofficial)
Paycorp's PHP SDK and samples for REST API 

## Please Note
> **This is a modified version of the Official PHP SDK, in order to support PSR-4 autoloading. Please contact the electronic banking unit of your bank for official SDK**

Installation
-----------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require bitixel/paycorp "*"
```

or add this line to the require section of your `composer.json` file.

```
"bitixel/paycorp": "*"
```

## Examples

### Redirect

```php
<?php
use bitixel\paycorp\GatewayClient;
use bitixel\paycorp\config\ClientConfig;
use bitixel\paycorp\payment\PaymentInitRequest;
use bitixel\paycorp\enums\TransactionType;
use bitixel\paycorp\component\TransactionAmount;
use bitixel\paycorp\component\Redirect;
use bitixel\paycorp\exceptions\PaycorpException;

$paycorp_credentials = [
	'serviceEndpoint' => 'https://xxxx.paycorp.com.au/rest/service/proxy',
	'authToken' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
	'hmacSecret' => 'xXxxXxxxxxXXXxXx',
	'validateOnly' => FALSE,
	'ClientId' => '1234'
];

/** serviceEndpoints **
* sampath bank : https://sampath.paycorp.com.au/rest/service/proxy
* commercial bank : https://test-combank.paycorp.com.au/rest/service/proxy
*/

$payment = [
	'amount' => 100.00,
	'currency' => 'USD',
	//'clientRef' => '1234',
	//'comment' => 'test comment',
	//'extraData' => ["orderId" => 456, "sessionId" => 789]
];

$returnUrl = 'http://localhost/payment/return';

$clientConfig = new ClientConfig();
$clientConfig->setServiceEndpoint($paycorp_credentials['serviceEndpoint']);
$clientConfig->setAuthToken($paycorp_credentials['authToken']);
$clientConfig->setHmacSecret($paycorp_credentials['hmacSecret']);
$clientConfig->setValidateOnly($paycorp_credentials['validateOnly']);

$client = new GatewayClient($clientConfig);

$initRequest = new PaymentInitRequest();

$initRequest->setClientId($paycorp_credentials['ClientId']);
$initRequest->setTransactionType(TransactionType::$PURCHASE);
//$initRequest->setClientRef($payment['clientRef']);
//$initRequest->setComment($payment['comment']);
//$initRequest->setExtraData($payment['extraData']);

$transactionAmount = new TransactionAmount($payment['amount'] * 100);
$transactionAmount->setCurrency($payment['currency']);
$initRequest->setTransactionAmount($transactionAmount);

$redirect = new Redirect($returnUrl);
$initRequest->setRedirect($redirect);

try {
	$initResponse = $client->getPayment()->init($initRequest);
	header('Location: ' . $initResponse->getPaymentPageUrl());
	//echo $initResponse->getReqid() . '<br>';
	//echo $initResponse->getPaymentPageUrl() . '<br>';
	//echo $initResponse->getExpireAt() . '<br>';

} catch (Exception $e) {
	echo 'Caught exception: ' .  $e->getMessage() . '<br>';
	echo 'Code: ' .  $e->getShortCode();
}

```



### Return

```php
<?php

use bitixel\paycorp\GatewayClient;
use bitixel\paycorp\config\ClientConfig;
use bitixel\paycorp\component\TransactionAmount;
use bitixel\paycorp\exceptions\PaycorpException;
use bitixel\paycorp\payment\PaymentCompleteRequest;

$paycorp_credentials = [
	'serviceEndpoint' => 'https://xxxx.paycorp.com.au/rest/service/proxy',
	'authToken' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
	'hmacSecret' => 'xXxxXxxxxxXXXxXx',
	'validateOnly' => FALSE,
	'ClientId' => '1234'
];

$clientConfig = new ClientConfig();
$clientConfig->setServiceEndpoint($paycorp_credentials['serviceEndpoint']);
$clientConfig->setAuthToken($paycorp_credentials['authToken']);
$clientConfig->setHmacSecret($paycorp_credentials['hmacSecret']);
$clientConfig->setValidateOnly($paycorp_credentials['validateOnly']);

$client = new GatewayClient($clientConfig);
$completeRequest = new PaymentCompleteRequest();
//$completeRequest->setClientId($paycorp_credentials['ClientId']);
$completeRequest->setReqid($_GET['reqid']);

try {
  $completeResponse = $client->getPayment()->complete($completeRequest);
  $creditCard = $completeResponse->getCreditCard();
  $transactionAmount = $completeResponse->getTransactionAmount();
  if($completeResponse->getResponseCode() == '00'){
      echo $transactionAmount->getPaymentAmount() . '<br>';
      echo $transactionAmount->getCurrency() . '<br>';
      echo $completeResponse->getTxnReference() . '<br>';
  }else{
      echo 'ErrorResponseCode: ' . $completeResponse->getResponseCode();
  } 
} catch (PaycorpException $e) {
  echo 'Caught exception: ' .  $e->getMessage() . '<br>';
  echo 'Code: ' . $e->getShortCode() . '<br>';
} catch (\Exception $e) {
  echo 'Caught exception: ' .  $e->getMessage() . '<br>';
}

```
