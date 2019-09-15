<?php

namespace App\Http\Controllers\Chat;

use App\Docs\Parameter;
use App\Http\Models\Chat\Chat;
use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $chats;

    public function __construct(Chat $chats)
    {
        $this->chats = $chats;
    }

    public static function getExampleResponseDataIndex()
    {
        return array (
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'vote_id' => 1,
                            'comment' => 'testoviy comment',
                            'replay_comment_id' => '',
                            'created_at' => '',
                            'updated_at' => '',
                            'deleted_at' => '',
                        ),
                    1 =>
                        array (
                            'id' => 2,
                            'vote_id' => 1,
                            'comment' => 'otvet na testoviy',
                            'replay_comment_id' => '2',
                            'created_at' => '',
                            'updated_at' => '',
                            'deleted_at' => '',
                        ),
                ),
            'first_page_url' => 'http://back_hack.ru/api/chat?page=1',
            'from' => 1,
            'last_page' => 3,
            'last_page_url' => 'http://back_hack.ru/api/chat?page=3',
            'next_page_url' => 'http://back_hack.ru/api/chat?page=2',
            'path' => 'http://back_hack.ru/api/chat',
            'per_page' => 2,
            'prev_page_url' => '',
            'to' => 2,
            'total' => 5,
        );
    }
    public static function getDocParametersIndex()
    {
        return [
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }

    public function index()
    {
        return $this->chats->paginate(2);
    }

    public static function getExampleResponseDataShow()
    {
        return array (
            'id' => 1,
            'vote_id' => 1,
            'comment' => 'testoviy comment',
            'replay_comment_id' => '',
            'created_at' => '',
            'updated_at' => '',
            'deleted_at' => '',
        );
    }
    public static function getDocParametersShow()
    {
        return [
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }
    public static function getExampleResponseDataStore()
    {
        return array (
            'id' => 1,
            'vote_id' => 1,
            'comment' => 'testoviy comment',
            'replay_comment_id' => '',
            'created_at' => '',
            'updated_at' => '',
            'deleted_at' => '',
        );
    }
    public static function getDocParametersStore()
    {
        return [
            Parameter::string('vote_id')->formData(),
            Parameter::string('comment')->formData(),
            Parameter::string('replay_comment_id')->formData(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatRequest $request)
    {
        return Chat::create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->chats->findOrFail($id);
    }

    public static function getExampleResponseDataUpdate()
    {
        return array (
        'id' => 1,
        'vote_id' => 1,
        'comment' => 'testoviy comment',
        'replay_comment_id' => '',
        'created_at' => '',
        'updated_at' => '',
        'deleted_at' => '',
    );
    }
    public static function getDocParametersUpdate()
    {
        return [
            Parameter::string('vote_id')->formData(),
            Parameter::string('comment')->formData(),
            Parameter::string('replay_comment_id')->formData(),
        ];
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
        $chat = $this->chats->findOrFail($id);
        $chat->update($request->all());
        return $chat;
    }
    public static function getExampleResponseDataDestroy()
    {
        return ['Message'=>'Delete Success'];
    }
    public static function getDocParametersDestroy()
    {
        return [
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->chats->destroy($id);
        return response()->json(['Message'=>'Delete Success']);
    }
}
