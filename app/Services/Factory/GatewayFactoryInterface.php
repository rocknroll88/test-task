<?php
namespace App\Services\Factory;
use App\Dto\GatewayDto;
use App\Services\PaymentGatewayInterface;
use Illuminate\Http\Request;
use App\Models\Merchant;

interface GatewayFactoryInterface 
{
    public function getDto(Request $request): GatewayDto;
    public function getService(): PaymentGatewayInterface;
    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto);
}