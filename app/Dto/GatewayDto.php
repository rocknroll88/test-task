<?php

namespace App\Dto;
use Illuminate\Support\Carbon;

class GatewayDto 
{
    public readonly int $merchantId;
    public readonly int $paymentId;
    public readonly string $status;
    public readonly int $amount;
    public readonly int $amountPaid;
    public readonly int $timestamp;
    public readonly string $rand;

    public function __construct(private readonly array $array, 
        public readonly string $sign)
    {
        $this->merchantId = $array['merchant_id'];
        $this->paymentId = $array['payment_id'];
        $this->status = $array['status'];
        $this->amount = $array['amount'];
        $this->amountPaid = $array['amount_paid'];
        $this->rand =  (isset($array['rand']) ? $array['rand'] : '');
        $this->timestamp = (isset($array['timestamp'])) ? $array['timestamp'] : Carbon::now()->timestamp;
    }

    public function getParametersForSign(){
        return $this->array;
    }

    
}