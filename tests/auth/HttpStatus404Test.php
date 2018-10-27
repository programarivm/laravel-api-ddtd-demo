<?php

namespace Tests\Auth;

use Tests\TestCase;

class HttpStatus404Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_404($username, $password)
    {
        $user = [
            'username' => $username,
            'password' => $password
        ];

        $response = $this->json('POST', '/api/auth', $user);

        $response->assertStatus(404);
    }

    public function data()
    {
        $data = [];
        $users = json_decode(file_get_contents(__DIR__ . '/data/http_status_404.json'))->httpBody;
        foreach ($users as $user) {
            $data[] = [
                $user->username,
                $user->password
            ];
        }

        return $data;
    }
}
