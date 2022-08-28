<?php

namespace App\Services;

use App\Services\CheckSignOneService;
use App\Services\CheckSignTwoService;
use App\Exceptions\AppException;

class GatewayServiceFactory
{
    public function __construct(private CheckSignOneService $serviceOne,  private CheckSignTwoService $serviceTwo)
    {
    }

    public function create(string $contentType): CheckSignInterface
    {
        if ($contentType == 'application/json')
            return $this->serviceOne;

        if ($contentType == 'multipart/form-data')
            return $this->serviceTwo;

        throw new AppException('Undefined content-type');
    }
}
