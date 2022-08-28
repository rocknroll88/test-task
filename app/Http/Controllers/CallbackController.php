<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Services\Factory\AbstractFactory;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;

class CallbackController extends Controller
{
    public function index(Request $request, AbstractFactory $abstractFactory, PaymentService $paymentService)
    {
        $factory = $abstractFactory->create($request->headers->get('content-type'));

        DB::beginTransaction();
        $dto = $factory->getDto($request);
        $service = $factory->getService();
        $merchant = Merchant::lockForUpdate()->findOrFail($dto->merchantId);
        if ($merchant->request_count >= $merchant->request_limit) {
            DB::rollBack();
            return response()->json([
                'Forbidden' => 'Too many requests'
            ], 429);
        }

        if (!$service->checkSign($request, $merchant, $dto)) {
            DB::rollBack();
            return response()->json([
                'Unautorized' => 'Autorization error'
            ], 401);
        }

        $paymentService->savePayment($dto);
        $merchant->request_count++;
        $merchant->save();
        DB::commit();

        return response()->json([
            'success' => 'Payment row writed success'
        ], 200);
    }
}
