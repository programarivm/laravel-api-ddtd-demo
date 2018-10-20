<?php

namespace Tests\Team\Update\Id;

use Tests\TestCase;

class HttpStatus200Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($id)
    {
        $response = $this->json('DELETE', "/api/team/delete/$id");

        $response->assertStatus(200);
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_200.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id
            ];
        }

        return $data;
    }
}
