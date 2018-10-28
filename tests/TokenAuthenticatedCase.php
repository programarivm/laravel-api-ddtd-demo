<?php

namespace Tests;

abstract class TokenAuthenticatedCase extends TestCase
{
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
