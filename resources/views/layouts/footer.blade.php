    <!-- widgets starts -->
    <div class="widgets">
        <div class="widgets__input">
            <span class="material-icons widgets__searchIcon"> search </span>
            <form action="{{ route('search_tweet') }}" method="get">
                @csrf
                <input type="text" placeholder="Search Twitter" name="keyword" />
                <input type="submit" value="search">
            </form>
        </div>

        <div class="widgets__widgetContainer">
            <h2>What's happening?</h2>
            <blockquote class="twitter-tweet">
                <p lang="en" dir="ltr">
                    Sunsets don&#39;t get much better than this one over
                    <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>.
                    <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a>
                    <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a>
                    <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a>
                </p>
                &mdash; US Department of the Interior (@Interior)
                <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a>
            </blockquote>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
    <!-- widgets ends -->
    <!-- Script -->
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone", {
            maxFilesize: 2, // 2 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });
        myDropzone.on("success", function(file, response) {

            if (response.success == 0) { // Error
                alert(response.error);
            }

        });
    </script>
    </body>

    </html>
