<?php

namespace Tests\Team\Create;

use Tests\TokenAuthenticatedCase;

class HttpStatus201Test extends TokenAuthenticatedCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_201($name, $location, $stadium, $season)
    {
        $team = [
            'name' => $name,
            'location' => $location,
            'stadium' => $stadium,
            'season' => $season,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken,
            'Content-Type' => 'application/json',
        ])->json('POST', '/api/team/create', $team);

        $response->assertStatus(201);
    }

    public function data()
    {
        $data = [];
        $teams = json_decode(file_get_contents(__DIR__.'/data/http_status_201.json'))->httpBody;
        foreach ($teams as $team) {
            $data[] = [
                $team->name,
                $team->location,
                $team->stadium,
                $team->season,
            ];
        }

        return $data;
    }
}
