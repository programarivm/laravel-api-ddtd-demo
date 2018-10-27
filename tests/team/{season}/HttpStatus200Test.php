<?php

namespace Tests\Team\Create;

use Tests\TestCase;
use Tests\TokenAuthentication;

class HttpStatus200Test extends TestCase
{
    use TokenAuthentication;

    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($season)
    {
        $accessToken = $this->accessToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$accessToken,
            'Content-Type' => 'application/json',
        ])->get("/api/team/$season");

        $response->assertStatus(200);
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
