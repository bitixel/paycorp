<?php

namespace bitixel\paycorp\helpers;

use bitixel\paycorp\utils\IJsonHelper;
use bitixel\paycorp\payment\PaymentInitResponse;

class PaymentInitJsonHelper implements IJsonHelper {

    public function __construct() {
        
    }

    public function fromJson($responseData) {
        $paymentInitResponse = new PaymentInitResponse();
        $paymentInitResponse->setReqid($responseData['responseData']['reqid']);
        $paymentInitResponse->setExpireAt($responseData['responseData']['expireAt']);
        $paymentInitResponse->setPaymentPageUrl($responseData['responseData']['paymentPageUrl']);

        return $paymentInitResponse;
    }

    public function toJson($paycorpRequest) {
        $version = $paycorpRequest->getVersion();
        $msgId = $paycorpRequest->getMsgId();
        $operation = $paycorpRequest->getOperation();
        $requestDate = $paycorpRequest->getRequestDate();
        $validateOnly = $paycorpRequest->getValidateOnly();
        $requestData = $paycorpRequest->getRequestData();
        
        $clientId = $requestData->getClientId();
        $clientIdHash = $requestData->getClientIdHash();
        $transactionType = $requestData->getTransactionType();
        $clientRef = $requestData->getClientRef();
        $comment = $requestData->getComment();
        $tokenize = $requestData->getTokenize();
        $tokenReference = $requestData->getTokenReference();
        $cssLocation1 = $requestData->getCssLocation1();
        $cssLocation2 = $requestData->getCssLocation2();
        $useReliability = $requestData->isUseReliability();
        $extraData = $requestData->getExtraData();
        
        $transactionAmount = $requestData->getTransactionAmount();
        $totalAmount = $transactionAmount->getTotalAmount();
        $paymentAmount = $transactionAmount->getPaymentAmount();
        $serviceFeeAmount = $transactionAmount->getServiceFeeAmount();
        $currency = $transactionAmount->getCurrency();
        
        $redirect = $requestData->getRedirect();
        $returnUrl = $redirect->getReturnUrl();
        $cancelUrl = $redirect->getCancelUrl();
        $returnMethod = $redirect->getReturnMethod();


        $return_array = array(
            "version" => "$version",
            "msgId" => "$msgId",
            "operation" => "$operation",
            "requestDate" => "$requestDate",
            "validateOnly" => $validateOnly,
            "requestData" => array(
                "clientId" => $clientId,
                "clientIdHash" => "$clientIdHash",
                "transactionType" => "$transactionType",
                "transactionAmount" => array(
                    "paymentAmount" => $paymentAmount
                ),
                "redirect" => array(
                    "returnUrl" => "$returnUrl",
                    "returnMethod" => "$returnMethod"
                ),
                "useReliability" => $useReliability,
                )
            );

        // optional params //
        if(!is_null($totalAmount))
            $return_array["requestData"]["transactionAmount"]["totalAmount"] = $totalAmount;
        if(!is_null($serviceFeeAmount))
            $return_array["requestData"]["transactionAmount"]["serviceFeeAmount"] = $serviceFeeAmount;
        if(!is_null($currency))
            $return_array["requestData"]["transactionAmount"]["currency"] = $currency;
        if(!is_null($cancelUrl))
            $return_array["requestData"]["redirect"]["cancelUrl"] = $cancelUrl;
        if(!is_null($clientRef))
            $return_array["requestData"]["clientRef"] = $clientRef;
        if(!is_null($comment))
            $return_array["requestData"]["comment"] = $comment;
        if(!is_null($tokenize))
            $return_array["requestData"]["tokenize"] = $tokenize;
        if(!is_null($tokenReference))
            $return_array["requestData"]["tokenReference"] = $tokenReference;
        if(!is_null($cssLocation1))
            $return_array["requestData"]["cssLocation1"] = $cssLocation1;
        if(!is_null($cssLocation2))
            $return_array["requestData"]["cssLocation2"] = $cssLocation2;
        if(!is_null($extraData))
            $return_array["requestData"]["extraData"] = $extraData;

        return $return_array;
    }

}
