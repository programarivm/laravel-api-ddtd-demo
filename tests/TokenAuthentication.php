<?php

namespace Tests;

trait TokenAuthentication
{
    public function accessToken()
    {
        $user = [
            'username' => 'bob',
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/auth', $user);

        return $response->decodeResponseJson()['access_token'];
    }
}
