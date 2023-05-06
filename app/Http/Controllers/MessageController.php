<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {
    //

    public function messages() {
        $followings = DB::table( 'followers' )->where( 'other_user_id', Auth::user()->id )->leftJoin( 'users', 'followers.user_id', '=', 'users.id' )->get();
        // dd( $followings );
        return view( 'messages', [ 'followings'=>$followings ] );

        /* followers user_id  other_user_id
        2          1
        3          1

        users id
        1
        2
        3

        */
    }

    public function single_message( Request $request ) {
        $other_user_id = $request->input( 'other_user_id' );
        $user_id = Auth::user()->id;
        $other_user = DB::table( 'users' )->where( 'id', $other_user_id )->get();
        $messages = DB::table( 'messages' )
        ->where( 'other_user_id', $other_user_id )->where( 'user_id', $user_id )
        ->orWhere( 'user_id', $other_user_id )->orWhere( 'other_user_id', $user_id )
        ->orderBy( 'id', 'desc' )
        ->get();

        return view( 'single_message', [ 'messages'=>$messages, 'other_user'=>$other_user ] );

    }

    public function submit_message( Request $request ) {
        $other_user_id = $request->input( 'other_user_id' );
        $text = $request->input( 'text' );
        DB::table( 'messages' )->insert( [
            'user_id'=>Auth::user()->id,
            'other_user_id'=>$other_user_id,
            'text'=>$text
        ] );

        return $this->single_message( $request );
    }
}
