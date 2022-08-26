<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Merchant;
use App\Models\Payment;

class GatewayOneService implements PaymentGatewayInterface
{
    // public function checkSign(GatewayDto $dto,  Merchant $merchant) : bool
    // {
    //     $attributes = $dto->getParametersForSign();
    //     ksort($attributes);
    //     $newSign = implode(':', $attributes) . $merchant->merchant_key;
    //     return hash('sha256', $newSign) === $dto->sign;
    // }

    public function savePayment(GatewayDto $dto) : void
    {

        $payment = Payment::find($dto->paymentId);
        if ($payment === null) {
            $payment = new Payment();
            $payment->payment_id = $dto->paymentId;
            $payment->merchant()->associate($dto->merchantId);
            $payment->amount = $dto->amount;
            $payment->amount_paid = $dto->amountPaid;
            $payment->updated_at = $dto->timestamp;
        }
        $payment->status = $dto->status;
        $payment->save();
    }
    
}