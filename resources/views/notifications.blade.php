@extends('layouts.main')

@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Notifications</h2>
        </div>

        <!-- tweetbox starts -->
        <div class="tweetBox">
            <form method="POST" action="{{ route('submit_tweet') }}">
                @csrf
                <div class="tweetbox__input">
                    <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                    <input name="text" type="text" placeholder="What's happening?" />
                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    <input name="user_name" type="hidden" value="{{ Auth::user()->name }}">
                    <input name="user_image" type="hidden" value="{{ Auth::user()->image }}">
                </div>
                <input class="tweetBox__tweetButton" value="Tweet" type="submit">
            </form>
        </div>
        <!-- tweetbox ends -->




        @foreach ($notifications as $notification)
            <!-- post starts -->

            <div class="post">
                <div class="post__avatar">
                    <img alt="" />
                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>
                                {{ $notification->text }}
                                <span class="post__headerSpecial"><span class="material-icons post__badge"> </span></span>

                            </h3>
                        </div>
                        <div class="post__headerDescription">

                        </div>
                    </div>


                    <div class="post__footer">





                    </div>


                </div>
            </div>
            <!-- post ends -->
        @endforeach

        <!-- post ends -->
    </div>
    <!-- feed ends -->
@endsection
