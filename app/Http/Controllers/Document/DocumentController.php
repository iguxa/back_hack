<?php

namespace App\Http\Controllers\Document;

use App\Docs\Parameter;
use App\Http\Models\Document\Document;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    protected $documents;

    public function __construct()
    {
        $this->documents = new Document();
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
                            'path' => '/fef/efef',
                        ),
                    1 =>
                        array (
                            'id' => 2,
                            'vote_id' => 1,
                            'path' => 'wdwd/verf/wedwd',
                        ),
                ),
            'first_page_url' => 'http://back_hack.ru/api/document?page=1',
            'from' => 1,
            'last_page' => 2,
            'last_page_url' => 'http://back_hack.ru/api/document?page=2',
            'next_page_url' => 'http://back_hack.ru/api/document?page=2',
            'path' => 'http://back_hack.ru/api/document',
            'per_page' => 2,
            'prev_page_url' => '',
            'to' => 2,
            'total' => 3,
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
        echo asset('storage/file.txt');
        return $this->documents->paginate(2);
    }

    public static function getExampleResponseDataShow()
    {
        return array (
            'id' => 1,
            'vote_id' => 1,
            'path' => '/fef/efef',
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
            'path' => '/fef/efef',
        );
    }
    public static function getDocParametersStore()
    {
        return [
            Parameter::string('vote_id')->formData(),
            Parameter::string('path')->formData(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'vote_id'=>'integer|max:10',
            'path'=>'string|max:500',
            'file' => 'string|max:10000'
        ])->validate();
        $file = $request->only('file');
        if(!$file) {
            return false;
        }
        Storage::disk('upload')->put($file, 'Contents');
        return Document::create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->documents->findOrFail($id);
    }

    public static function getExampleResponseDataUpdate()
    {
        return array (
            'id' => 1,
            'vote_id' => 1,
            'path' => '/fef/efef',
        );
    }
    public static function getDocParametersUpdate()
    {
        return [
            Parameter::string('id')->formData(),
            Parameter::string('vote_id')->formData(),
            Parameter::string('path')->formData(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
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
