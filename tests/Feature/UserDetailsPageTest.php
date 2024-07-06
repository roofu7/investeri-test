<?php

use MoonShine\Models\MoonshineUser;
use Tests\TestCase;

class UserDetailsPageTest extends TestCase
{
    public function testUserDetailsPageIsAvailable()
    {
        $this->withoutExceptionHandling();
        $admin = MoonshineUser::first();
        $response = $this->actingAs($admin, 'moonshine')->get('/admin/page/user-details');

        $response->assertStatus(200);
    }
}
