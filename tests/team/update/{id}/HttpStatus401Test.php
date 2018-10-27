<?php

namespace App\Tests\Team\Update\Id;

use Tests\TestCase;

class HttpStatus401Test extends TestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_401($id, $name = null, $location = null, $stadium = null, $season = null)
    {
        if (isset($name)) {
            $team['name'] = $name;
        }
        if (isset($location)) {
            $team['location'] = $location;
        }
        if (isset($stadium)) {
            $team['stadium'] = $stadium;
        }
        if (isset($season)) {
            $team['season'] = $season;
        }

        $response = $this->withHeaders([
            'Authorization' => 'Bearer foo',
            'Content-Type' => 'application/json',
        ])->json('PUT', "/api/team/update/$id", $team);

        $response->assertStatus(401);
    }

    public function data()
    {
        $data = [];

        $queryStrings = json_decode(file_get_contents(__DIR__.'/data/http_status_200.json'))->queryString;
        foreach ($queryStrings as $queryString) {
            $data[] = [
                $queryString->id,
            ];
        }

        $httpBodies = json_decode(file_get_contents(__DIR__.'/data/http_status_200.json'))->httpBody;
        for ($i = 0; $i < count($data); ++$i) {
            array_push(
                $data[$i],
                ...array_values((array) $httpBodies[$i])
            );
        }

        return $data;
    }
}
