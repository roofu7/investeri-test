<?php

namespace Tests\Unit;


use Mockery;
use PHPUnit\Framework\TestCase;
use YooKassa\Client;

class YooKassaTest extends TestCase
{
    public function testBasic()
    {
        $client = Mockery::mock(new Client());
        $response = $client->shouldReceive('setAuth')
            ->with(
                config('app.config.services.yookassa.shop_id'),
                config('app.config.services.yookassa.secret_key')
            )
        ->once();

        $this->assertIsArray($response);
    }
}
