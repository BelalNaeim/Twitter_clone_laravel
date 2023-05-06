@extends('layouts.main')
@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Home</h2>
        </div>
        @if (Session::has('success_message'))
            <div class="alert alert-success text-center">{{ Session::get('success_message') }}</div>
        @endif

        @if (Session::has('failure_message'))
            <div class="alert alert-danger text-center">{{ Session::get('failure_message') }}</div>
        @endif

        <!-- tweetbox starts -->
        <div class="tweetBox">
            <form method="post" action="{{ route('submit_tweet') }}" enctype="multipart/form-data">
                @csrf
                <div class="tweetbox__input">
                    <img src="{{ asset('images/' . Auth::user()->image) }}" alt="" />
                    <input name="text" type="text" placeholder="What's happening?" />
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_image" value="{{ Auth::user()->image }}">
                </div>
                <div class="mx-5">
                    <label for="formFileSm" class="form-label" style="font-size: 10px">Upload Image</label>
                    <input name="image" class="form-control form-control-sm" id="formFileSm" type="file">
                </div>
                <button class="tweetBox__tweetButton">Tweet</button>
            </form>
        </div>
        <!-- tweetbox ends -->
        <!-- post starts -->
        {{-- @php
            dd($following_tweets);
        @endphp --}}
        @foreach ($following_tweets as $tweet)
            <div class="post">
                <div class="post__avatar">
                    <img src="{{ asset('images' . $tweet->user_image) }}" alt="" />
                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>
                                {{ $tweet->user_name }}
                                <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                    </span>@somanathg</span>
                            </h3>
                        </div>
                        <div class="post__headerDescription">
                            <p>{{ $tweet->text }}</p>
                        </div>
                    </div>
                    <img src="{{ asset('images/' . $tweet->image) }}" alt="" />
                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <span onclick="window.location.href= '/like_post/{{ $tweet->id }}/{{ Auth::user()->id }}' "
                            class="material-icons"> favorite_border
                            <!-- <input type="submit" value="like">  -->

                        </span>
                        <div>{{ $tweet->number_of_likes }} likes</div>
                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center" style="width: 50;">
            {!! $following_tweets->links() !!}
        </div>
        <!-- post ends -->


    </div>
    <!-- feed ends -->
@endsection
