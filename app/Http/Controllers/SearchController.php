<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {
    //

    public function search_page( Request $request ) {
        $users = DB::table( 'users' )->where( 'name', 'like', $request->input( 'keyword' ).'%' )->get();
        return view( 'search_page', [ 'users'=>$users ] );
    }

    public function search_tweet( Request $request ) {
        $tweets = DB::table( 'tweets' )->where( 'text', 'like', $request->input( 'keyword' ).'%' )->get();
        return view( 'search_tweet', [ 'tweets'=>$tweets ] );

    }
}
