<?php

namespace Tests\Feature;

use App\Http\Controllers\YooKassaController;
use Mockery;
use Tests\TestCase;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Payment\PaymentInterface;
use YooKassa\Model\Payment\PaymentStatus;

class YookassaTest extends TestCase
{

    public function testCreatePayment()
    {
        $this->withoutExceptionHandling();

        /*$data = [
            'amount' => [
                'value' => '1000.00',
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('yookassa.success'),
            ],
            'description' => 'Оплата заказа #123',
        ];*/

        /*$test = $this->post('/yookassa/create-payment', $data);
//$this->assertIsArray($data);
        $test->assertStatus(302);*/

        $this->withoutExceptionHandling();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('setAuth')
            ->with(
                config('services.yookassa.shop_id'),
                config('services.yookassa.secret_key')
            )
            ->once();

        $payment = Mockery::mock(PaymentInterface::class);

        $payment->shouldReceive('getId')
            ->andReturn('123456');

        $payment->shouldReceive('getStatus')
            ->andReturn('pending');

        $payment->shouldReceive('getConfirmation->getConfirmationUrl')
            ->andReturn('https://example.com/confirm');

        $client->shouldReceive('createPayment')
            ->with([
                'amount' => [
                    'value' => '1000.00',
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => route('yookassa.success'),
                ],
                'description' => 'Оплата заказа #123',
            ])
            ->andReturn($payment);

        $response = $this->post(route('yookassa.create-payment'), [
            'amount' => '1000.00',
            'currency' => 'RUB',
            'description' => 'Оплата заказа #123',
        ]);

        $this->app->instance(Client::class, $client);
//        $this->app->instance(PaymentInterface::class, $payment);

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com/confirm');
    }

    public function testHandleNotification()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('setAuth')
            ->with(
                config('services.yookassa.shop_id'),
                config('services.yookassa.secret_key')
            )
            ->once();

        $notification = Mockery::mock(NotificationSucceeded::class);
        $notification->shouldReceive('getEvent')->andReturn('payment');
        $notification->shouldReceive('getObject->getStatus')->andReturn(PaymentStatus::SUCCEEDED);

        $client->shouldReceive('handleNotification')
            ->with([
                'type' => 'notification',
                'event' => 'payment.succeeded',
                'object' => [
                    'id' => '123456',
                    'status' => 'succeeded',
                ],
            ])
            ->andReturn($notification);

        $this->app->instance(Client::class, $client);

        $response = $this->post(route('yookassa.handle-notification'), [
            'type' => 'notification',
            'event' => 'payment.succeeded',
            'object' => [
                'id' => '123456',
                'status' => 'succeeded',
            ],
        ]);

        $this->assertTrue($response->json('success'));
    }
}
