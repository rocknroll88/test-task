<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Merchant;
use Illuminate\Http\Request;

class CheckSignOneService implements CheckSignInterface
{
    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto) : bool
    {
        $attributes = $request->all();
        ksort($attributes);
        unset($attributes['sign']);
        $newSign = implode(':', $attributes) . $merchant->merchant_key;
        return hash('sha256', $newSign) === $dto->sign;
        
    }
    
}