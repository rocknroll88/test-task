<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Merchant;
use Illuminate\Http\Request;

class CheckSignTwoService implements CheckSignInterface
{
    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto) : bool
    {
        $attributes  = $request->all();
        ksort($attributes);
        $newSign = implode('.', $attributes) . $merchant->merchant_key;
        return hash('md5', $newSign) === $dto->sign;
    }
    
}