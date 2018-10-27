<?php

namespace Tests\Team\Delete\Id;

use Tests\TestCase;

class HttpStatus401Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($id)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer foo',
            'Content-Type' => 'application/json',
        ])->delete("/api/team/delete/$id");

        $response->assertStatus(401);
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
