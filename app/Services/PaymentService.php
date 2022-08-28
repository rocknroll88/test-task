<?php

namespace App\Services;

use App\Dto\GatewayDto;
use App\Models\Payment;

class PaymentService
{
    public function savePayment(GatewayDto $dto): void
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
