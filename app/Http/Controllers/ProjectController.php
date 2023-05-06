<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {
    //

    public function submit_tweet( Request $request ) {
        $tweet = [
            'text'=>$request->text,
            'user_id'=>$request->user_id,
            'user_name'=>$request->user_name,
            'user_image'=>$request->user_image,
            'time'=>date( 'Y-m-d H:i:s' ),
        ];

        $imageName = time().'.'.$request->image->extension();

        $request->image->move( public_path( 'images' ), $imageName );
        $tweet[ 'image' ] = $imageName;

        // dd( $tweet );
        Tweet::create( $tweet );
        return redirect( '/' );
    }

    public function index() {
        // $tweets = DB::table( 'tweets' )->get();
        $following_tweets = DB::table( 'followers' )->where( 'other_user_id', Auth::user()->id )->leftJoin( 'tweets', 'followers.user_id', '=', 'tweets.user_id' )
        ->orderBy( 'tweets.id', 'desc' )->paginate( 2 );

        //tweet user_id        followers other_user_id
        //1
        //2
        return view( 'index', [ 'following_tweets'=>$following_tweets ] );
    }

    public function lists() {
        $users = User::select( 'id', 'name', 'image' )->paginate( 2 );
        return view( 'lists', [ 'users'=>$users ] );

    }

    public function like_post( Request $request, $tweet_id, $user_id ) {
        $has_user_liked_this_post = DB::table( 'likes' )->where( 'tweet_id', $tweet_id )->where( 'user_id', $user_id )->exists();

        if ( $has_user_liked_this_post ) {
            return \redirect( '/' )->with( 'failure_message', 'you have liked this post before' );
        }

        //increase number of likes
        $tweet = DB::table( 'tweets' )->where( 'id', $tweet_id )->get();
        DB::table( 'tweets' )->where( 'id', $tweet_id )->update( [
            'number_of_likes'=> $tweet[ 0 ]->number_of_likes+1
        ] );

        //notify other_user that their tweet has been liked
        // $other_user =   DB::table( 'tweets' )->where( 'id', $tweet_id )->get()[ 0 ];
        // DB::table( 'notifications' )->insert( [ 'user_id'=>$other_user->user_id, 'text'=>'Your tweet has been liked by '.Auth::user()->name ] );

        //insert tweet_id and user_id in like table
        DB::table( 'likes' )->insert( [ 'tweet_id'=>$tweet_id, 'user_id'=>$user_id ] );

        return \redirect( '/' )->with( 'success_message', 'You have liked this tweet' );

    }

    public function logout() {
        Auth::logout();
        return redirect( '/login' );
    }

    public function notifications( Request $request ) {
        $notifications = DB::table( 'notifications' )->where( 'user_id', Auth::user()->id )->get();
        return  view( 'notifications', [ 'notifications'=>$notifications ] );

    }

}

