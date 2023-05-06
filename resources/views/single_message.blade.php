@extends('layouts.main')

@section('content')
    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h2>Inbox</h2>
        </div>






        @foreach ($messages as $message)
            <!-- post starts -->


            <div class="post">
                <div class="post__avatar">


                    @if ($message->user_id == Auth::user()->id)
                        <img src="{{ asset('images/' . Auth::user()->image) }}" alt="" />
                    @else
                        <img src="{{ asset('images/' . $other_user[0]->image) }}" alt="" />
                    @endif


                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">


                            @if ($message->user_id == Auth::user()->id)
                                <a>{{ Auth::user()->name }}</a>
                            @else
                                <a> {{ $other_user[0]->name }}</a>
                            @endif

                            <span class="post__headerSpecial"><span class="material-icons post__badge"> </span></span>

                            <h6>{{ $message->text }} </h6>
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


    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form action="{{ route('submit_message') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="tweetbox__input">
                <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                <input name="text" type="text" placeholder="Type a message...?" />
                <input name="other_user_id" type="hidden" value="{{ $other_user[0]->id }}">

            </div>
            <input class="tweetBox__tweetButton" value="Send" type="submit">
        </form>
    </div>
    <!-- tweetbox ends -->
@endsection
