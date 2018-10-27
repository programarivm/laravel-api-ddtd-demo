<?php

namespace Tests\Team\Create;

use Tests\TestCase;

class HttpStatus401Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_401($season)
    {
        $accessToken = 'foo';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$accessToken,
            'Content-Type' => 'application/json',
        ])->get("/api/team/$season");

        $response->assertStatus(401);
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_200.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->season
            ];
        }

        return $data;
    }
}
