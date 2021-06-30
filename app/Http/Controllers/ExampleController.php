<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('age', ['only' => [
        //     'getUser',
        //     'getPost'
        // ]]);
        // $this->middleware('age', ['except' => [
        //     'getUser',
        //     'getPost'
        // ]]);
    }

    public function generateKey()
    {
        return Str::random(32);
    }

    public function fooExample()
    {
        return 'Example Controller from POST';
    }

    public function getUser($id)
    {
        return 'User id = ' . $id;
    }

    public function getPost($cat1, $cat2)
    {
        return 'Category 1 = ' . $cat1 . ' Category 2 = ' . $cat2;
    }

    public function getProfile()
    {
        return '<a href="' . route('profile.action') . '">Profile Action</a>';
    }

    public function profileAction()
    {
        return '<a href="' . route('profile') . '">Profile</a>';
    }

    public function fooBar(Request $req)
    {
        // if ($req->is('foo/bar')) {
        //     return 'Success';
        // } else {
        //     return 'Fail';
        // }
        // return $req->path();
        return $req->method();
    }

    public function userProfile(Request $req)
    {
        // return $req->all();
        // return $req->input('name', 'Matic');
        // if ($req->has('name', 'username')) {
        //     return 'success';
        // } else {
        //     return 'fail';
        // }
        // if ($req->filled('name', 'username')) {
        //     return 'success';
        // } else {
        //     return 'fail';
        // }

        return $req->only(['username', 'password']);
    }

    public function response()
    {
        $data = [
            'status' => 'Success'
        ];
        // return Response($data, 200)
        //     ->header('Content-type', 'application/json');
        return Response()->json([
            'message' => 'Not Found',
            'status' => false
        ], 404);
    }
}
