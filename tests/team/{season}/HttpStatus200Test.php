<?php

namespace Tests\Team\Create;

use Tests\TestCase;

class HttpStatus200Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($season)
    {
        $response = $this->get("/api/team/$season");

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
