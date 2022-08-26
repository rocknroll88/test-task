<?php

namespace App\Services\Factory;

use App\Dto\GatewayDto;
use App\Models\Merchant;
use App\Services\GatewayOneService;
use App\Services\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GatewayOneFactory implements GatewayFactoryInterface
{
    public function __construct(private GatewayOneService $gatewayOneService){
    }

    public function getDto(Request $request): GatewayDto
    {

        $attributes = Validator::make($request->all(), [
            'merchant_id' => 'integer',
            'payment_id' => 'integer',
            'status' => 'string',
            'amount' => 'integer',
            'amount_paid' => 'integer',
            'timestamp' => 'string',
        ]);
        

        $attributes = $request->all();
        return new GatewayDto(
            [
                'merchant_id' => $attributes['merchant_id'],
                'payment_id' => $attributes['payment_id'],
                'status' => $attributes['status'],
                'amount' => $attributes['amount'],
                'amount_paid' => $attributes['amount_paid'],
                'timestamp' => $attributes['timestamp'],

            ],
            $attributes['sign']
        );
    }

    public function getService(): PaymentGatewayInterface
    {
        return $this->gatewayOneService;
    }

    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto)
    {
        $attributes = $request->all();
        ksort($attributes);
        unset($attributes['sign']);
        $newSign = implode(':', $attributes) . $merchant->merchant_key;
        return hash('sha256', $newSign) === $dto->sign;
        
    }
}
