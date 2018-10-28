<?php

namespace Tests\Team\Season;

use Tests\TokenAuthenticatedCase;

class HttpStatus200Test extends TokenAuthenticatedCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($season)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken,
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
