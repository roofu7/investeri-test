<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;
use YooKassa\Common\Exceptions\ApiConnectionException;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\AuthorizeException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;

class YooKassaController extends Controller
{
    /**
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws ApiException
     * @throws BadApiRequestException
     * @throws ExtensionNotFoundException
     * @throws AuthorizeException
     * @throws InternalServerError
     * @throws ForbiddenException
     * @throws TooManyRequestsException
     * @throws ApiConnectionException
     * @throws UnauthorizedException
     */
    public function createPayment(Request $request)
    {
        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        $response = $client->createPayment([
            'amount' => [
                'value' => $request->input('amount'),
                'currency' => $request->input('currency'),
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('yookassa.success'),
            ],
            'description' => $request->input('description'),
        ]);
        return redirect($response->getConfirmation()->getConfirmationUrl());
    }

    public function handleSuccess(Request $request)
    {
        // Обработка успешной оплаты
        $paymentId = $request->input('payment_id');
        $status = $request->input('status');

        $order = Order::where('payment_id', $paymentId)->first();
        if ($order) {
            $order->status = $status;
            $order->save();
        }

        return view('yookassa.success');
    }

    public function handleNotification(Request $request)
    {
        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        try {
            $notification = $client->handleNotification($request->all());
            $this->updateOrderStatus($notification);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    protected function updateOrderStatus($notification)
    {
        $paymentId = $notification->getObject()->getId();
        $status = $notification->getObject()->getStatus();

        $order = Order::where('payment_id', $paymentId)->first();
        if ($order) {
            $order->status = $status;
            $order->save();
        }
    }
}
