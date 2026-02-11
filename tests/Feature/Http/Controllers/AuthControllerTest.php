<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AuthController
 */
final class AuthControllerTest extends TestCase
{
    use AdditionalAssertions, WithFaker;

    #[Test]
    public function login_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AuthController::class,
            'login',
            \App\Http\Requests\AuthLoginRequest::class
        );
    }

    #[Test]
    public function login_responds_with(): void
    {
        $response = $this->get(route('auths.login'));

        $response->assertOk();
        $response->assertJson($token);
    }
}
