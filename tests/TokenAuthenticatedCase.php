<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;

abstract class TokenAuthenticatedCase extends TestCase
{
    use WithoutMiddleware; // disables rate limiting

    protected $user = [
        'username' => 'bob',
        'password' => 'password',
    ];

    protected $accessToken;

    public function setUp()
    {
        parent::setUp();

        $response = $this->json('POST', '/api/auth', $this->user);

        $this->accessToken = $response->decodeResponseJson()['access_token'];
    }
}
