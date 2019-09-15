<?php

namespace App\Http\Controllers\Votes;

use App\Docs\Parameter;
use App\Http\Controllers\Document\DocumentController;
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
            'type_id' => '',
            'state' => '',
            'q_type' => '',
            'q_value' => '',
            'title' => '',
            'description' => '',
            'creator' => 1,
            'arbiter' => '',
            'publish' => '',
            'deadline' => '',
            'created_at' => '2019-09-15 04:38:50',
            'updated_at' => '2019-09-15 04:38:50',
            'deleted_at' => '',
            'votes' =>
                array (
                    0 =>
                        array (
                            'id' => 11,
                            'votes_id' => 41,
                            'user_id' => 47,
                            'vote_value' => '',
                            'comment' => '',
                            'created_at' => '2019-09-15 07:38:50',
                        ),
                ),
        );
    }
    public static function getDocParametersIndex()
    {
        return [
            Parameter::integer('page')->query(),
            Parameter::integer('state')->query(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }
    public function index(Request $request)
    {
        $data = Votes::getAllWithPaginate($request->all());
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
            Parameter::string('title')->formData(),
            Parameter::string('description')->formData(),
            Parameter::string('state')->formData(),
            Parameter::string('q_type')->formData(),
            Parameter::string('q_value')->formData(),
            Parameter::string('type_id')->formData(),
            Parameter::string('arbiter')->formData(),
            Parameter::string('publish')->formData(),
            Parameter::string('deadline')->formData(),
            Parameter::string('votes')->formData(),
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

        $document = new DocumentController();
        $document->store($request);

        $updated = Votes::with('votes')->with('docs')->find($result->id);
        return response()->json($updated);
    }

    private function insertMembers($data, $id)
    {
        VotesMembers::deleteByVoterId($id);
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

    /**
     * Inserting Voter data
     */
    private function insertVoter($data, $id = null)
    {
        $vote = new Votes();
        try{
            $data['creator'] = Auth::user()->id;
            if($id){
                $data['id'] = $id;
                $vote->update($data);
            } else {
                $id = $vote::create($data)->getAttribute('id');
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
            Parameter::integer('id')->formData(),
            Parameter::string('title')->formData(),
            Parameter::string('description')->formData(),
            Parameter::string('state')->formData(),
            Parameter::string('q_type')->formData(),
            Parameter::string('q_value')->formData(),
            Parameter::string('type_id')->formData(),
            Parameter::string('arbiter')->formData(),
            Parameter::string('publish')->formData(),
            Parameter::string('deadline')->formData(),
            Parameter::string('votes')->formData(),
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

    public static function getExampleResponseDataShow()
    {
        return array (
            'id' => 41,
            'type_id' => '',
            'state' => '',
            'q_type' => '',
            'q_value' => '',
            'title' => '',
            'description' => '',
            'creator' => 1,
            'arbiter' => '',
            'publish' => '',
            'deadline' => '',
            'created_at' => '2019-09-15 04:38:50',
            'updated_at' => '2019-09-15 04:38:50',
            'deleted_at' => '',
            'votes' =>
                array (
                    0 =>
                        array (
                            'id' => 11,
                            'votes_id' => 41,
                            'user_id' => 47,
                            'vote_value' => '',
                            'comment' => '',
                            'created_at' => '2019-09-15 07:38:50',
                        ),
                ),
        );
    }

    public static function getDocParametersShow()
    {
        return [
            Parameter::integer('id')->formData(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result = Votes::with('votes')->with('docs')->find($id);
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
            Parameter::integer('id')->formData(),
            Parameter::string('title')->formData(),
            Parameter::string('description')->formData(),
            Parameter::string('state')->formData(),
            Parameter::string('q_type')->formData(),
            Parameter::string('q_value')->formData(),
            Parameter::string('type_id')->formData(),
            Parameter::string('arbiter')->formData(),
            Parameter::string('publish')->formData(),
            Parameter::string('deadline')->formData(),
            Parameter::string('votes')->formData(),
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
        $data = $request->all();
        $data['state'] = VoterPublishRequest::DRAFT;
        $result = $this->insertVoter($data, $id);
        if(isset($data['voters'])) {
            $this->insertMembers($data['voters'], $result->id);
        }

        $updated = Votes::with('votes')->find($result->id);
        return response()->json($updated);
    }

    public static function getExampleResponseDataVOte()
    {
        return array ();
    }
    public static function getDocParametersVote()
    {
        return [
            Parameter::integer('id')->formData(),
            Parameter::string('comment')->formData(),
            Parameter::integer('vote_value')->formData(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
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

    public function vote(Request $request, $id)
    {
        $voteFind = VotesMembers::where('user_id', '=', Auth::user()->id)->where('votes_id', '=', $id)->get();
        if(!$voteFind->count()){
            return response()->json();
        }

        $vote = $voteFind->first();
        $vote->comment = $request->get('comment');
        $vote->vote_value = $request->get('vote_value');
        $vote->save();
        return response()->json();
    }
}
