<?php

namespace App\Tests\Team\Delete\Id;

use Tests\TokenAuthenticatedCase;

class HttpStatus404Test extends TokenAuthenticatedCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_404($id)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken,
            'Content-Type' => 'application/json',
        ])->delete("/api/team/delete/$id");

        $response->assertStatus(404);
    }

    public function data()
    {
        $data = [];
        $queryStrings = json_decode(file_get_contents(__DIR__ . '/data/http_status_404.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id
            ];
        }

        return $data;
    }
}
