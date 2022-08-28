<?php

namespace App\Services\Factory;

use App\Dto\GatewayDto;
use App\Services\CheckSignTwoService;
use App\Services\CheckSignInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Merchant;
use App\Services\CheckSignOneService;

class GatewayTwoFactory implements GatewayFactoryInterface
{
    public function __construct(private CheckSignTwoService $twoService)
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

    public function getService() : CheckSignInterface
    {
        return $this->twoService;
    }
}
