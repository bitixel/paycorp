<?php

namespace bitixel\paycorp\utils;

interface IJsonHelper {

    public function fromJson($json);

    public function toJson($instance);
    
}
