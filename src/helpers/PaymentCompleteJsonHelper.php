<?php

namespace bitixel\paycorp\helpers;

use bitixel\paycorp\utils\IJsonHelper;
use bitixel\paycorp\payment\PaymentCompleteResponse;
use bitixel\paycorp\component\CreditCard;
use bitixel\paycorp\component\TransactionAmount;

class PaymentCompleteJsonHelper implements IJsonHelper {

    public function __construct() {
        
    }

    public function fromJson($responseData) {

        $paymentCompleteResponse = new PaymentCompleteResponse();
        $paymentCompleteResponse->setClientId($responseData['responseData']['clientId']);
        $paymentCompleteResponse->setClientIdHash($responseData['responseData']['clientIdHash']);
        $paymentCompleteResponse->setTransactionType($responseData['responseData']['transactionType']);

        $creditCard = new CreditCard();
        $creditCard->setType($responseData['responseData']['creditCard']['type']);
        $creditCard->setHolderName($responseData['responseData']['creditCard']['holderName']);
        $creditCard->setNumber($responseData['responseData']['creditCard']['number']);
        $creditCard->setExpiry($responseData['responseData']['creditCard']['expiry']);
        $paymentCompleteResponse->setCreditCard($creditCard);

        $transactionAmount = new TransactionAmount($responseData['responseData']['transactionAmount']['paymentAmount']);
        $transactionAmount->setTotalAmount($responseData['responseData']['transactionAmount']['totalAmount']);
        $transactionAmount->setPaymentAmount($responseData['responseData']['transactionAmount']['paymentAmount']);
        $transactionAmount->setServiceFeeAmount($responseData['responseData']['transactionAmount']['serviceFeeAmount']);
        if(isset($responseData['responseData']['transactionAmount']['withholdingAmount']))
        $transactionAmount->setWithholdingAmount($responseData['responseData']['transactionAmount']['withholdingAmount']);
        $transactionAmount->setCurrency($responseData['responseData']['transactionAmount']['currency']);
        $paymentCompleteResponse->setTransactionAmount($transactionAmount);

        if(isset($responseData['responseData']['clientRef']))
        $paymentCompleteResponse->setClientRef($responseData['responseData']['clientRef']);
        if(isset($responseData['responseData']['comment']))
        $paymentCompleteResponse->setComment($responseData['responseData']['comment']);
        if(isset($responseData['responseData']['txnReference']))
        $paymentCompleteResponse->setTxnReference($responseData['responseData']['txnReference']);
        if(isset($responseData['responseData']['feeReference']))
        $paymentCompleteResponse->setFeeReference($responseData['responseData']['feeReference']);
        $paymentCompleteResponse->setResponseCode($responseData['responseData']['responseCode']);
        $paymentCompleteResponse->setResponseText($responseData['responseData']['responseText']);
        if(isset($responseData['responseData']['settlementDate']))
        $paymentCompleteResponse->setSettlementDate($responseData['responseData']['settlementDate']);
        if(isset($responseData['responseData']['token']))
        $paymentCompleteResponse->setToken($responseData['responseData']['token']);
        $paymentCompleteResponse->setTokenized($responseData['responseData']['tokenized']);
        if(isset($responseData['responseData']['tokenResponseText']))
        $paymentCompleteResponse->setTokenResponseText($responseData['responseData']['tokenResponseText']);
        $paymentCompleteResponse->setAuthCode($responseData['responseData']['authCode']);
        $paymentCompleteResponse->setCvcResponse($responseData['responseData']['cvcResponse']);

        return $paymentCompleteResponse;
    }

    public function toJson($paycorpRequest) {
        $version = $paycorpRequest->getVersion();
        $msgId = $paycorpRequest->getMsgId();
        $operation = $paycorpRequest->getOperation();
        $requestDate = $paycorpRequest->getRequestDate();
        $validateOnly = $paycorpRequest->getValidateOnly();
        $requestData = $paycorpRequest->getRequestData();

        $clientId = $requestData->getClientId();
        $reqid = $requestData->getReqid();

        return array(
            "version" => "$version",
            "msgId" => "$msgId",
            "operation" => "$operation",
            "requestDate" => "$requestDate",
            "validateOnly" => $validateOnly,
            "requestData" => array(
                "clientId" => $clientId,
                "reqid" => $reqid
            )
        );
    }

}
