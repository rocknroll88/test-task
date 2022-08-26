<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Merchant;

interface PaymentGatewayInterface 
{
    // public function checkSign(GatewayDto $dto,  Merchant $merchant) : bool;

    public function savePayment(GatewayDto $dto) : void;
}