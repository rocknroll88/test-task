<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Services\Factory\AbstractFactory;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CallbackController extends Controller
{
    public function index(Request $request, AbstractFactory $abstractFactory)
    {
        $factory = $abstractFactory->create($request->headers->get('content-type'));
        $dto = $factory->getDto($request);
        $gateway = $factory->getService();
        $merchant = Merchant::findOrFail($dto->merchantId); 

        if(!$factory->checkSign($request, $merchant, $dto))
        {
            return response()->json([
                'Unautorized' => 'Autorization error'
            ], 401);
        }

        $gateway->savePayment($dto);

        return response()->json([
            'success' => 'Payment row writed success'
        ], 200);
        

    }
}
