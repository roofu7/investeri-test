<?php

namespace Tests\Feature\company\invest\projects;

use App\Models\User;
use Tests\TestCase;

class CompanyInvestProjectIndexTest extends TestCase
{
    public function test_the_company_index_page_returns_a_successful_response_if_user_is_auth()
    {
        $this->withoutExceptionHandling();

        $authUser = User::first();

        $response = $this->ActingAs($authUser)->get('/personal-account/{user}/company/invest-projects');

        $response->assertStatus(200);
    }
}
