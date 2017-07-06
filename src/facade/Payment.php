<?php

namespace bitixel\paycorp\facade;


use bitixel\paycorp\helpers\PaymentRealTimeJsonHelper;
use bitixel\paycorp\helpers\PaymentInitJsonHelper;
use bitixel\paycorp\helpers\PaymentCompleteJsonHelper;
use bitixel\paycorp\helpers\PaymentBatchJsonHelper;
use bitixel\paycorp\enums\Operation;

final class Payment extends BaseFacade {

    public function __construct($config) {
        parent::__construct($config);
    }

    public function realTime($request) {
        $paymentRealTimeJsonHelper = new PaymentRealTimeJsonHelper();
        return parent::process($request, Operation::$PAYMENT_REAL_TIME, $paymentRealTimeJsonHelper);
    }

    public function init($request) {
        $paymentInitJsonHelper = new PaymentInitJsonHelper();
        return parent::process($request, Operation::$PAYMENT_INIT, $paymentInitJsonHelper);
    }

    public function complete($request) {
        $paymentCompleteJsonHelper = new PaymentCompleteJsonHelper();
        return parent::process($request, Operation::$PAYMENT_COMPLETE, $paymentCompleteJsonHelper);
    }
    
    public function batch($request){
           $paymentBatchJsonHelper = new PaymentBatchJsonHelper();
           return parent::process($request, Operation::$PAYMENT_BATCH, $paymentBatchJsonHelper);        
    }

}
