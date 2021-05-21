<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</head>

<body>
    <div id="app">
        <div id="sideNav" class="sideNav">
            <span class="sideNav__closeBtn" onClick=navigation__closeNav()>
                &times;
            </span>
            <ul class="pl-0">
                <li>item 1</li>
                <li>item 2</li>
                <li>item 3</li>
            </ul>
        </div>
        <div id="main" class="container-fluid">
            <div class="row">

                <div class="col-3 bg-light vh-100 px-0">
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

                <div class="col-9 p-0">
                    @include('partials.nav.navbar')
                    <div class="px-5">
                        <h1 class="my-5">Most Recent</h1>
                        <article-list-large :articles="{{ $articles }}"></article-list-large>
                        {{-- <ul>
                            @foreach ($articles as $k => $v)
                                <li class="article-card__animated" style="--animation-order: {{ $k }};">
                                    <div class="row mb-4 py-3 article-card">
                                        <div class="col-2">
                                            <div class="w-100 article-card__img"
                                                style="background-image: url('{{ $v->image ? $v->image : asset('/img/no_image.png') }}')">
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <a class="m-0">{{ $v->title }}</a><br>
                                            <div class="article-card__info-meta">{{ $v->source_name }} /
                                                {{ Carbon\Carbon::parse($v->pub_date)->diffForHumans() }}
                                            </div>
                                            <div class="article-card__info-meta">
                                                {{ $v->short_description }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function navigation__closeNav() {
        document.getElementById("sideNav").style.right = "-320px";
        document.getElementById("main").style.left = "0";
    }

    function navigation__openNav() {
        document.getElementById("sideNav").style.right = "0";
        document.getElementById("main").style.left = "-320px";
    }

</script>
<script src="{{ asset('js/app.js') }}"></script>

</html>
