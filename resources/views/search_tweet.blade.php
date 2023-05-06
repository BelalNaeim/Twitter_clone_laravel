@extends('layouts.main')

@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Search Tweet</h2>
        </div>






        @foreach ($tweets as $tweet)
            <!-- post starts -->


            <div class="post">
                <div class="post__avatar">
                    <img src="{{ asset('images/' . $tweet->user_image) }}" alt="" />
                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>
                                <a> {{ $tweet->user_name }}</a>
                                <span class="post__headerSpecial"><span class="material-icons post__badge"> </span></span>
                                <div>{{ $tweet->text }}</div>
                                <form method="POST" action="{{ route('follow_user') }}">
                                    @csrf
                                    <input type="hidden" name="other_user_id" value="{{ $tweet->user_id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input class="tweetBox__tweetButton" value="Follow" type="submit">
                                </form>


                            </h3>
                        </div>
                        <div class="post__headerDescription">

                        </div>
                    </div>
                    <img src="{{ asset('images/' . $tweet->image) }}" alt="" />

                    <div class="post__footer">





                    </div>


                </div>
            </div>
            <!-- post ends -->
        @endforeach


        <!-- post ends -->
    </div>
    <!-- feed ends -->


    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form method="GET" action="{{ route('search_tweet') }}">
            @csrf
            <div class="tweetbox__input">
                <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                <input name="keyword" type="text" placeholder="Search users..." />

            </div>
            <input class="tweetBox__tweetButton" value="Search" type="submit">
        </form>
    </div>
    <!-- tweetbox ends -->
@endsection
