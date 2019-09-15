<?php

namespace App\Http\Controllers\Auth\Api;

use App\Docs\Parameter;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    protected $users;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $users)
    {
        $this->users = $users;

    }
    public static function getExampleResponseDataShow()
    {
        return array (
            'id' => 1,
            'name' => 'Tester Tesrov',
            'email' => 'tsybykov@bk.ru',
            'email_verified_at' => '',
            'role' => '0',
            'api_token' => '733260741c131187810bc1a0a6446628653f9e5c4cc9f17402d6131b619cc5fb',
            'created_at' => '2019-09-14 23:36:27',
            'updated_at' => '2019-09-15 00:04:14',
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

    public static function getExampleResponseDataIndex()
    {
        return array (
            'token'=>'fd10b23a93ea7a96ddb8377160716a3afcc1e6d507909c80fb21154d7b3b21a7',
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
        return ['token'=>Auth::user()->api_token];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public static function getExampleResponseDataStore()
    {
        return array (
            'id' => 1,
            'name' => 'Tester Tesrov',
            'email' => 'tsybykov@bk.ru',
            'email_verified_at' => '',
            'role' => '0',
            'api_token' => '733260741c131187810bc1a0a6446628653f9e5c4cc9f17402d6131b619cc5fb',
            'created_at' => '2019-09-14 23:36:27',
            'updated_at' => '2019-09-15 00:04:14',
            'deleted_at' => '',
        );
    }
    public static function getDocParametersStore()
    {
        return [
            Parameter::string('email')->formData(),
            Parameter::string('password')->formData(),
            Parameter::string('name')->formData(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
        ];
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->users->findOrFail($id);
    }

    public static function getExampleResponseDataUpdate()
    {
        return array (
            'id' => 1,
            'name' => 'Tester Tesrov',
            'email' => 'tsybykov@bk.ru',
            'email_verified_at' => '',
            'role' => '0',
            'api_token' => '733260741c131187810bc1a0a6446628653f9e5c4cc9f17402d6131b619cc5fb',
            'created_at' => '2019-09-14 23:36:27',
            'updated_at' => '2019-09-15 00:04:14',
            'deleted_at' => '',
        );
    }
    public static function getDocParametersUpdate()
    {
        return [
            Parameter::string('email')->formData(),
            Parameter::string('password')->formData(),
            Parameter::string('name')->formData(),
            Parameter::string('email')->header(),
            Parameter::string('password')->header(),
            Parameter::string('Authorization')->header(),
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
        $user = $this->users->findOrFail($id);
        $user->update($request->all());
        return $user;
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
        $this->users->destroy($id);
        return response()->json(['Message'=>'Delete Success']);
    }
}