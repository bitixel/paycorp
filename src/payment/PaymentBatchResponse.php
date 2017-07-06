<?php

namespace bitixel\paycorp\payment;

class PaymentBatchResponse {
    
    private $groupId;

    public function getGroupId() {
        return $this->groupId;
    }

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }
}
