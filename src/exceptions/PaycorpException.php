<?php
namespace bitixel\paycorp\exceptions;

class PaycorpException extends \Exception
{

    protected $shortCode;

    public function setShortCode($shortCode)
    {
        $this->shortCode = $shortCode;
    }

    public function getShortCode()
    {
        return $this->shortCode;
    }

}    