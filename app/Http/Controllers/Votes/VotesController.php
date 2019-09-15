<?php

namespace App\Http\Controllers\Votes;

use App\Http\Requests\VoterCreateRequest;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Votes\Votes;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Votes::getAllWithPaginate();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VoterCreateRequest $request
     * @return Response
     */
    public function store(VoterCreateRequest $request)
    {
        $vote = new Votes();
        try{
            $date = $request->all();
            $date['creator'] = Auth::user()->id;
            $vote::create($date);
        } catch (Exception $e) {
            return response()->json([$e->getMessage(), $e->getCode()]);
        }
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $test = 'test';
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
