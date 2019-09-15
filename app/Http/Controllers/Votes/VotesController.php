<?php

namespace App\Http\Controllers\Votes;

use App\Docs\Parameter;
use App\Http\Models\Votes\VotesMembers;
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
            'id' => 41,
            'type_id' => NULL,
            'state' => NULL,
            'q_type' => NULL,
            'q_value' => NULL,
            'title' => NULL,
            'description' => NULL,
            'creator' => 1,
            'arbiter' => NULL,
            'publish' => NULL,
            'deadline' => NULL,
            'created_at' => '2019-09-15 04:38:50',
            'updated_at' => '2019-09-15 04:38:50',
            'deleted_at' => NULL,
            'votes' =>
                array (
                    0 =>
                        array (
                            'id' => 11,
                            'votes_id' => 41,
                            'user_id' => 47,
                            'vote_value' => NULL,
                            'comment' => NULL,
                            'created_at' => '2019-09-15 07:38:50',
                        ),
                ),
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
            Parameter::string('votes')->body(),
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
        $data = $request->all();
        $data['state'] = VoterPublishRequest::DRAFT;
        $result = $this->insertVoter($data);
        if(isset($data['voters'])) {
            $this->insertMembers($data['voters'], $result->id);
        }

        $updated = Votes::with('votes')->find($result->id);
        return response()->json($updated);
    }

    private function insertMembers($data, $id)
    {
        foreach ($data as $voter) {
            $voter['votes_id'] = $id;
            $member = new VotesMembers();
            if(isset($voter['id'])){
                $member->update($voter);
            } else {
                $member::create($voter);
            }
        }
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

        return Votes::with('votes')->find($id);
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
            Parameter::string('votes')->body(),
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
        if(isset($data['voters'])) {
            $this->insertMembers($data['voters'], $result->id);
        }

        $updated = Votes::with('votes')->find($result->id);
        return response()->json($updated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result = Votes::with('votes')->find($id);
        return response()->json($result);
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
            Parameter::string('votes')->body(),
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
        if(isset($data['voters'])) {
            $this->insertMembers($data['voters'], $result->id);
        }

        $updated = Votes::with('votes')->find($result->id);
        return response()->json($updated);
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
