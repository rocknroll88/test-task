<?php

namespace App\Services\Factory;

use App\Services\Factory\GatewayOneFactory;
use App\Services\Factory\GatewayTwoFactory;
use App\Exceptions\AppException;

class AbstractFactory
{
    public function __construct(private GatewayOneFactory $gatewayOneFactory, private GatewayTwoFactory $gatewayTwoFactory)
    {
    }

    public function create(string $contentType): GatewayFactoryInterface
    {
        if ($contentType == 'application/json')
            return $this->gatewayOneFactory;

        if (str_starts_with($contentType, 'multipart/form-data'))
            return $this->gatewayTwoFactory;

        throw new AppException('Undefined content-type');
    }
}
