<?php

namespace Tests\Team\Delete\Id;

use Tests\TestCase;
use Tests\TokenAuthentication;

class HttpStatus400Test extends TestCase
{
    use TokenAuthentication;

    /**
     * @dataProvider data
     * @test
     */
    public function http_status_400($id)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken(),
            'Content-Type' => 'application/json',
        ])->delete("/api/team/delete/$id");

        $response->assertStatus(400);
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_400.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id
            ];
        }

        return $data;
    }
}
