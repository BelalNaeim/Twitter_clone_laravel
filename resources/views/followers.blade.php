@extends('layouts.main')
@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Followers</h2>
        </div>

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
        @foreach ($followers as $user)
            {{-- @php
                dd($followings);
            @endphp --}}
            <!-- post starts -->
            @if ($user->id != Auth::user()->id)
                <div class="post">
                    <div class="post__avatar">

                        <img src="{{ asset('images/' . $user->image) }}" alt="" />
                    </div>

                    <div class="post__body">
                        <div class="post__header">
                            <div class="post__headerText">
                                <h3>
                                    <a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }}</a>
                                    <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                        </span>{{ $user->email }}</span>
                                </h3>
                            </div>

                        </div>

                        <div class="post__footer">


                            <div class="tweetbox__input">

                                <form method="POST" action="{{ route('Unfollow_user') }}">
                                    @csrf
                                    <input type="hidden" name="other_user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input class="tweetBox__tweetButton" value="Unfollow" type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- post ends -->
            @endif
        @endforeach


    </div>
    <!-- feed ends -->
@endsection
