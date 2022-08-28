<?php
namespace App\Services\Factory;
use App\Dto\GatewayDto;
use App\Services\PaymentGatewayInterface;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Services\CheckSignInterface;

interface GatewayFactoryInterface 
{
    public function getDto(Request $request): GatewayDto;
    public function getService() : CheckSignInterface;
}