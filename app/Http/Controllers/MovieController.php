<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMovie;
use App\Http\Requests\RequestUpdateMovie;
use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $movies=$request->user()->movies()->get();

        if(count($movies)>0){
            
            return response()->json([
                'status'=>'ok',
                'movies'=> $movies
            ],200);

        }else{
            return response()->json([
                'status'=>'ko',
                'message'=>'no resources'
            ],404);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestMovie $request)
    {

        Movie::create([
            'title'=>$request->title,
            'viewing_date'=>$request->viewing_date,
            'img_route'=>$request->img_route,
            'id_movie'=>$request->id_movie,
            'user_id'=>$request->user()->id
        ]);
       
        return response()->json([
                'status'=>'ok'
        ],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {

        $movie = Movie::find($id);

        Gate::authorize('validateUser',  $movie, $request->user());

        return response()->json([
            'status'=>'ok',
            'movie'=> $movie
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestUpdateMovie $request, $id)
    {

       $movie=Movie::findOrFail($id);

       Gate::authorize('validateUser',  $movie, $request->user());

       $validatedData = $request->validated();

       $movie->update($validatedData);

       return response()->json([
        'status'=>'ok'
       ],203);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $movie=Movie::findOrFail($id);
        
        Gate::authorize('validateUser',  $movie, $request->user());

        $movie->delete();

        return response()->json([
            'status'=>'ok'
        ], 204);
    }

}
