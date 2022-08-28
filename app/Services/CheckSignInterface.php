<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Merchant;
use Illuminate\Http\Request;

interface CheckSignInterface
{
    public function checkSign(Request $request, Merchant $merchant, GatewayDto $dto) : bool;
}