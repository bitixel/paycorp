<?php

namespace bitixel\paycorp\component;

class Redirect {

    private $returnUrl;
    private $cancelUrl;
    private $returnMethod;

    public function __construct($retrnUrl){
        $this->returnUrl = $retrnUrl;
        $this->returnMethod = 'GET';
    }

    public function getReturnUrl() {
        return $this->returnUrl;
    }

    public function setReturnUrl($returnUrl) {
        $this->returnUrl = $returnUrl;
    }

    public function getCancelUrl() {
        return $this->cancelUrl;
    }

    public function setCancelUrl($cancelUrl) {
        $this->cancelUrl = $cancelUrl;
    }

    public function getReturnMethod() {
        return $this->returnMethod;
    }

    public function setReturnMethod($returnMethod) {
        $this->returnMethod = $returnMethod;
    }

}
