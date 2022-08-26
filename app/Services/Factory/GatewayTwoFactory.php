<?php

namespace App\Services\Factory;

use App\Dto\GatewayDto;
use App\Services\GatewayTwoService;
use App\Services\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Merchant;

class GatewayTwoFactory implements GatewayFactoryInterface
{
    public function __construct(private GatewayTwoService $gatewayTwoService)
    {
    }

    public function getDto(Request $request): GatewayDto
    {
        $attributes = Validator::make($request->all(), [
            'project' => 'integer',
            'invoice' => 'integer',
            'status' => 'string',
            'amount' => 'integer',
            'amount_paid' => 'integer',
            'rand' => 'string',
        ]);

        $attributes = $request->all();
        return new GatewayDto(
            [
                'merchant_id' => $attributes['project'],
                'payment_id' => $attributes['invoice'],
                'status' => $attributes['status'],
                'amount' => $attributes['amount'],
                'amount_paid' => $attributes['amount_paid'],
                'rand' => $attributes['rand'],


            ],
            $request->bearerToken()
        );
    }

    public function getService(): PaymentGatewayInterface
    {
        return $this->gatewayTwoService;
    }

    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto)
    {
        $attributes  = $request->all();
        ksort($attributes);
        $newSign = implode('.', $attributes) . $merchant->merchant_key;
        return hash('md5', $newSign) === $dto->sign;
    }
}
