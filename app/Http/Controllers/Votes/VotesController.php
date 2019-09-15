<?php

namespace App\Http\Controllers\Votes;

use App\Docs\Parameter;
use App\Http\Requests\VoterCreateRequest;
use App\Http\Requests\VoterPublishRequest;
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

    public static function getExampleResponseDataIndex()
    {
        return array (
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'type_id' => 111,
                            'state' => '',
                            'q_type' => '',
                            'q_value' => '',
                            'title' => '',
                            'description' => '',
                            'creator' => '',
                            'arbiter' => '',
                            'publish' => '',
                            'deadline' => '',
                            'created_at' => '',
                            'updated_at' => '',
                            'deleted_at' => '',
                        )
                ),
            'first_page_url' => 'http://vtb-test.ru/api/votes?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://vtb-test.ru/api/votes?page=1',
            'next_page_url' => '',
            'path' => 'http://vtb-test.ru/api/votes',
            'per_page' => 20,
            'prev_page_url' => '',
            'to' => 16,
            'total' => 16,
        );
    }
    public static function getDocParametersIndex()
    {
        return [
            Parameter::integer('page')->query(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }
    public function index(Request $request)
    {
        $data = Votes::getAllWithPaginate();
        return response()->json($data);
    }

    public static function getExampleResponseDataStore()
    {
        return array (
            'id' => 1
        );
    }
    public static function getDocParametersStore()
    {
        return [
            Parameter::string('title')->body(),
            Parameter::string('description')->body(),
            Parameter::string('state')->body(),
            Parameter::string('q_type')->body(),
            Parameter::string('q_value')->body(),
            Parameter::string('type_id')->body(),
            Parameter::string('arbiter')->body(),
            Parameter::string('publish')->body(),
            Parameter::string('deadline')->body(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param VoterCreateRequest $request
     * @return Response
     */
    public function store(VoterCreateRequest $request)
    {
        $date = $request->all();
        $data['state'] = VoterPublishRequest::DRAFT;
        $result = $this->insertVoter($date);
        return response()->json($result);
    }

    private function insertVoter($data, $id = null)
    {
        $vote = new Votes();
        try{
            $date['creator'] = Auth::user()->id;
            if($id){
                $id = $date['id'];
                $vote->update($date);
            } else {
                $id = $vote::create($date)->getAttribute('id');
            }
        } catch (Exception $e) {
            return [$e->getMessage(), $e->getCode()];
        }
        return ['id' => $id];
    }

    public static function getExampleResponseDataPublish()
    {
        return array (
            'id' => 1
        );
    }
    public static function getDocParametersPublish()
    {
        return [
            Parameter::integer('id')->body(),
            Parameter::string('title')->body(),
            Parameter::string('description')->body(),
            Parameter::string('state')->body(),
            Parameter::string('q_type')->body(),
            Parameter::string('q_value')->body(),
            Parameter::string('type_id')->body(),
            Parameter::string('arbiter')->body(),
            Parameter::string('publish')->body(),
            Parameter::string('deadline')->body(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VoterPublishRequest $request
     * @return Response
     */
    public function publish(VoterPublishRequest $request, $id)
    {
        $date = $request->all();
        $data['status'] = VoterPublishRequest::PUBLISH;
        $result = $this->insertVoter($date, $id);
        return response()->json($result);
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

    public static function getExampleResponseDataUpdate()
    {
        return array (
            'id' => 1
        );
    }
    public static function getDocParametersUpdate()
    {
        return [
            Parameter::integer('id')->body(),
            Parameter::string('title')->body(),
            Parameter::string('description')->body(),
            Parameter::string('state')->body(),
            Parameter::string('q_type')->body(),
            Parameter::string('q_value')->body(),
            Parameter::string('type_id')->body(),
            Parameter::string('arbiter')->body(),
            Parameter::string('publish')->body(),
            Parameter::string('deadline')->body(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
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
        $date = $request->all();
        $data['state'] = VoterPublishRequest::DRAFT;
        $result = $this->insertVoter($date, $id);
        return response()->json($result);
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
