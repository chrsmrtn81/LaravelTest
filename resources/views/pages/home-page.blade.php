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
            background-image: url('{{ $location_image }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
    
<body style="margin: 0;">
{{-- {{ dd( }} --}}
    <div class="bg position-relative h-100">
        <div class="container-fluid position-absolute" style="bottom: 16px">
            <div class="row">
                <div class="col-2 bg-dark d-flex p-3">
                    <img class="m-auto" src="https://res.cloudinary.com/chrsmrtn81/image/upload/c_scale,h_120/v1615670923/Chris%20Martin/cm-monogram_yqo4en.svg" style="height: 100px;" />
                </div>
                <div class="col-10 text-white d-flex justify-content-end" style="background: rgba(52,58,64, 0.6);">
                    <div class="my-auto text-right">
                        <p class="m-0" style="font-size: 2rem; font-weight: bold;">{{ $location_data->name }}, {{ $location_data->sys->country }}</p>
                        <p class="m-0" style="font-size: 1rem;">{{ number_format($location_data->main->temp, 0) }}&deg;C {{ $location_data->weather[0]->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>