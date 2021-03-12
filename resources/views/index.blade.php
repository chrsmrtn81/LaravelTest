<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chris Martin</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        @font-face {
            font-family: 'Helvetica';
            src: url(https://res.cloudinary.com/chrsmrtn81/raw/upload/v1615582707/Chris%20Martin/Helvetica_nprwdq.ttf);
        }

        body, html {
            height: 100%;
            font-family: 'Helvetica';
        }

        .bg {
            background-image: url("{{ "/images/middlesbrough.jpg" }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
    
<body style="margin: 0;">

    <div class="bg position-relative h-100">
        <div class="container-fluid position-absolute" style="bottom: 16px">
            <div class="row">
                <div class="col-2 bg-dark d-flex p-3">
                    <img class="m-auto" src="{{ asset("/images/cm-monogram.svg") }}" style="height: 100px;" />
                </div>
                <div class="col-10 text-white d-flex" style="background: rgba(52,58,64, 0.7);">
                    <p class="my-auto" style="font-size: 2rem; font-weight: bold;">Middlesbrough, UK</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>