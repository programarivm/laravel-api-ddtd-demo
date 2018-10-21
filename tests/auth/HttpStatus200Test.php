<?php

namespace Tests\Auth;

use Tests\TestCase;

class HttpStatus200Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($username, $password)
    {
        $user = [
            'username' => $username,
            'password' => $password
        ];

        $response = $this->json('POST', '/api/auth', $user);

        $response->assertStatus(200);
    }

    public function data()
    {
        $data = [];
        $users = json_decode(file_get_contents(__DIR__ . '/data/http_status_200.json'))->httpBody;
        foreach ($users as $user) {
            $data[] = [
                $user->username,
                $user->password
            ];
        }

        return $data;
    }
}
