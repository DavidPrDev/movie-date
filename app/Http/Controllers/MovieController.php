<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestMovie;
use App\Http\Requests\RequestUpdateMovie;
use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Movie Controller",
 *     description="Endpoints related to movies controller"
 * )
 * 
 * @OA\Schema(
 *     schema="RequestMovie",
 *     @OA\Property(property="title", type="string", example="Hana-bi"),
 *     @OA\Property(property="viewing_date", type="string", example="2024-05-28"),
 *     @OA\Property(property="seen_status", type="boolean", example=false),
 *     @OA\Property(property="img_route", type="integer", example="image.jpg"),
 *     @OA\Property(property="id_movie", type="string", example="263"),
 *     @OA\Property(property="user_id", type="integer", example=1),
 * )
 * 
 *  * @OA\Schema(
 *     schema="RequestUpdateMovie",
 *     @OA\Property(property="viewing_date", type="string", example="2024-05-28"),
 *     @OA\Property(property="seen_status", type="boolean", example=false),
 * )
 */

class MovieController extends Controller
{
    /**
     * Show all movies
     *
     * @OA\Get(
     *     path="/api/movie",
     *     summary="Show a all movie ",
     *     tags={"Movie Controller"},
     *     security={{"bearerAuth":{}}},
     * 
     *     @OA\Response(
     *         response=200,
     *         description="Movie found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     * 
     */
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
     * Store a movie
     *
     * @OA\Post(
     *     path="/api/movie",
     *     summary="Store a movie",
     *     tags={"Movie Controller"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Recipe data",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/RequestMovie"  
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie stored",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="ok")
     *          )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error"
     *     )
     * )
     * 
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
     * Show a movie
     *
     * @OA\Get(
     *     path="/api/movie/{id}",
     *     summary="Show a movie by ID",
     *     tags={"Movie Controller"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="Movie found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     * 
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
     * Update  movie
     *
     * @OA\Put(
     *     path="/api/movie/{id}",
     *     summary="Update movie",
     *     tags={"Movie Controller"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Movie data",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/RequestUpdateMovie"  
     *         )
     *     ),
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie stored",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="ok")
     *          )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error"
     *     )
     * )
     * 
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
     * Delete a movie
     *
     * @OA\Delete(
     *     path="/api/movie/{id}",
     *     summary="Delete a movie by ID",
     *     tags={"Movie Controller"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response=203,
     *         description="Deleted movie"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     * 
     */
    public function destroy(Request $request, $id)
    {
        $movie=Movie::findOrFail($id);
        
        Gate::authorize('validateUser',  $movie, $request->user());

        $movie->delete();

        return response()->json([
            'status'=>'ok'
        ], 203);
    }

}
