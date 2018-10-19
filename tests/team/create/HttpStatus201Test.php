<?php

namespace Tests\Team\Create;

use Tests\TestCase;

class HttpStatus201Test extends TestCase
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

        $response = $this->json('POST', '/api/team/create', $team);

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
