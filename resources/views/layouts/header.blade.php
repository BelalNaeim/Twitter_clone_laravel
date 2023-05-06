<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Twitter Clone - Final</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <link href="{{ asset('css/tweet.css') }}" rel="stylesheet">
</head>

<body>
    <!-- sidebar starts -->
    <div class="sidebar">
        <i class="fab fa-twitter"></i>
        <div class="sidebarOption active">
            <span class="material-icons"> home </span>
            <h2><a href="{{ route('index') }}" style="text-decoration: none;">Home</a></h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons">explore</span>
            <h2><a href="{{ route('search_page') }}" style="text-decoration: none">Explore</a></h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> notifications_none </span>
            <h2> <a href="{{ route('notifications') }}">Notifications</a> </h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> mail_outline </span>
            <h2><a href="{{ route('messages') }}">Messages</a></h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> bookmark_border </span>
            <h2>Bookmarks</h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> list_alt </span>
            <h2><a href="{{ route('lists') }}" style="text-decoration: none;">Lists</a></h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> perm_identity </span>
            <h2><a href="{{ route('profile', ['id' => Auth::user()->id]) }}" style="text-decoration: none;">Profile</a>
            </h2>
        </div>

        <div class="sidebarOption">
            <span class="material-icons"> more_horiz </span>
            <h2>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" value="logout" style="background: none;border:none">
                </form>
            </h2>
        </div>
        <button class="sidebar__tweet">Tweet</button>
    </div>
    <!-- sidebar ends -->
