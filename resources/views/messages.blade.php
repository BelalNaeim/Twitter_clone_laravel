@extends('layouts.main')

@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Messages</h2>
        </div>






        @foreach ($followings as $user)
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
                                    {{ $user->name }}
                                    <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                        </span>{{ $user->email }}</span>
                                    <form method="POST" action="{{ route('single_message') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="other_user_id">
                                        <input class="tweetBox__tweetButton" value="Message" type="submit">
                                    </form>


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
            @endif
        @endforeach


        <!-- post ends -->
    </div>
    <!-- feed ends -->
@endsection
