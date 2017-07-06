<?php

namespace bitixel\paycorp\facade;

use bitixel\paycorp\helpers\StoreCardJsonHelper;
use bitixel\paycorp\helpers\RetrieveCardJsonHelper;
use bitixel\paycorp\helpers\UpdateCardJsonHelper;
use bitixel\paycorp\helpers\VerifyTokenJsonHelper;
use bitixel\paycorp\helpers\DeleteTokenJsonHelper;

final class Vault extends BaseFacade {

    public function __construct($config) {
        parent::__construct($config);
    }

    public function storeCard($request) {
        $storeCardJsonHelper = new StoreCardJsonHelper();
        return parent::process($request, Operation::$VAULT_STORE_CARD, $storeCardJsonHelper);
    }

    public function retrieveCard($request) {
        $retrieveCardJsonHelper = new RetrieveCardJsonHelper();
        return parent::process($request, Operation::$VAULT_RETRIEVE_CARD, $retrieveCardJsonHelper);
    }

    public function updateCard($request) {
        $updateCardJsonHelper = new UpdateCardJsonHelper();
        return parent::process($request, Operation::$VAULT_UPDATE_CARD, $updateCardJsonHelper);
    }

    public function verifyToken($request) {
        $verifyTokenJsonHelper = new VerifyTokenJsonHelper();
        return parent::process($request, Operation::$VAULT_VERIFY_TOKEN, $verifyTokenJsonHelper);
    }

    public function deleteToken($request) {
        $deleteTokenJsonHelper = new DeleteTokenJsonHelper();
        return parent::process($request, Operation::$VAULT_DELETE_TOKEN, $deleteTokenJsonHelper);
    }

}
