<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Counterculture</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>


</head>

<body>
    <div id="app">
        <div id="main" class="container-fluid">
            <div class="row">

                <div class="col-2 bg-light vh-100 px-0">
                    <div class="sidebar vh-100 border-end border-1">
                        <div class="d-flex">
                            <a class="mx-auto" href="#">
                                <div class="my-3">
                                    <img src="{{ asset('img/large_logo.svg') }}" />
                                </div>
                            </a>
                        </div>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button py-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        <i class="bi bi-book"></i>&nbsp; ALL NEWS
                                    </button>
                                </h2>

                                <sidebar-filters :source-filters="{{ $sources }}"></sidebar-filters>

                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button py-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        <i class="bi bi-rss"></i>&nbsp; PERSONAL FEEDS
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        Create a personal feed
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10 p-0">
                    @include('partials.nav.navbar')
                    <div class="px-5 mt-5">

                        {{-- <blockquote class="twitter-tweet"><p lang="en" dir="ltr">So if the Wuhan lab leak theory is confirmed to be true, mainstream media &amp; social media censorship helped facilitate one of the biggest cover-ups in modern history.<br><br>All in the name of &quot;stopping misinformation.&quot;<br><br>Why should they be trusted to be the arbiters of truth ever again?</p>&mdash; Paul Joseph Watson (@PrisonPlanet) <a href="https://twitter.com/PrisonPlanet/status/1397983207010746371?ref_src=twsrc%5Etfw">May 27, 2021</a></blockquote> --}}
                        {{-- <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> --}}
                        
                        
                        <article-list-large :articles="{{ $articles }}"></article-list-large>
                        <article-off-canvas></article-list-large>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
        
    window.addEventListener('scroll', function(e) {
        
        if(window.scrollY > 80){
            document.getElementById("cc_feed-title--scrolling").innerHTML = document.getElementById("cc_feed-title").innerHTML
        } else {
            document.getElementById("cc_feed-title--scrolling").innerHTML = ""
        }
        
    });


</script>

<script src="{{ asset('js/app.js') }}"></script>

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


</html>
