<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;

class FollowingController extends Controller {
    //

    public function follow_user( Request $request ) {

        $user_id = $request->input( 'user_id' );
        $other_user_id = $request->input( 'other_user_id' );
        $already_following_this_person = Follower::where( 'user_id', Auth::user()->id )->where( 'other_user_id', $other_user_id )->exists();
        if ( $already_following_this_person ) {
            return redirect( '/' )->with( 'failure_message', 'You have already followed this person before' );
        }
        Follower::create( [
            'user_id'=>$user_id,
            'other_user_id'=>$other_user_id,
        ] );
        $user_name = Auth::user()->name;
        $other_user_name = DB::table( 'users' )->where( 'id', $other_user_id )->get()[ 0 ]->name;

        DB::table( 'notifications' )->insert( [ 'user_id'=>Auth::user()->id, 'text'=>'You have Followed '. $other_user_name ] );
        DB::table( 'notifications' )->insert( [ 'user_id'=>$other_user_id, 'text'=>'You have a new follower ' . $user_name ] );
        return redirect( '/' )->with( 'success_message', 'You have started following this person' );

    }

    public function followings() {
        $followings = DB::table( 'followers' )->where( 'user_id', Auth::user()->id )->leftJoin( 'users', 'followers.other_user_id', ' = ', 'users.id' )->get();
        return view( 'followings', [ 'followings'=>$followings ] );

    }

    public function Unfollow_user( Request $request ) {
        $other_user_id = $request->input( 'other_user_id' );
        DB::table( 'followers' )->where( 'user_id', Auth::user()->id )->where( 'other_user_id', $other_user_id )->delete();

        $user_name = Auth::user()->name;
        $other_user_name = DB::table( 'users' )->where( 'id', $other_user_id )->get()[ 0 ]->name;

        //add notifications ] = into database
        DB::table( 'notifications' )->insert( [ 'user_id'=>Auth::user()->id, 'text'=>'you have unfollowed '.$other_user_name ] );
        DB::table( 'notifications' )->insert( [ 'user_id'=>$other_user_id, 'text'=>Auth::user()->name.' unfollowed you' ] );

        return \redirect( '/' )->with( 'success_message', 'You have unfollowed this user successfully' );
    }

    public function followers() {
        $followers = DB::table( 'followers' )->where( 'other_user_id', Auth::user()->id )->leftJoin( 'users', 'followers.user_id', ' = ', 'users.id' )->get();
        return view( 'followers', [ 'followers'=>$followers ] );
    }
}
