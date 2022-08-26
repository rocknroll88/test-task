<?php

namespace App\Services;

use App\Services\GatewayOneService;
use App\Services\GatewayTwoService;
use App\Exceptions\AppException;

class GatewayServiceFactory
{
    public function __construct(private GatewayOneService $gatewayOne,  private GatewayTwoService $gatewayTwo)
    {
    }

    public function create(string $contentType): PaymentServiceInterface
    {
        if ($contentType == 'application/json')
            return $this->gatewayOne;

        if ($contentType == 'multipart/form-data')
            return $this->gatewayTwo;

        throw new AppException('Undefined content-type');
    }
}
