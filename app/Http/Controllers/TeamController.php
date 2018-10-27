<?php

namespace App\Http\Controllers;

use App\Team;
use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($season)
    {
        return Team::all('id', 'name', 'location', 'stadium', 'season');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = Team::create([
            'name' => $request->name,
            'location' => $request->location,
            'stadium' => $request->stadium,
            'season' => $request->season,
        ]);

        return new TeamResource($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $team = Team::find($id);
        $team->fill($input);
        $team->save();

        return new TeamResource($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new BadRequestHttpException;
        }

        $team = Team::find($id);

        if (!$team) {
            throw new NotFoundHttpException;
        }

        $team->delete();
    }
}
