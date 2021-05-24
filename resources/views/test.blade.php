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


    <div class="container"></div>


</body>

<script>

    const URL = 'https://source.unsplash.com/random/200x200?sig='
    const container = document.querySelector('.container')

    function getRandNumber(){
        return Math.floor(Math.random() * 100)
    }

    function loadImages(numImages = 10){
        let i = 0
        while(i < numImages){
            const img = document.createElement('img')
            img.src = `${URL}${getRandNumber()}`
            container.appendChild(img)
            i++
        }
    }

    loadImages()
            
    window.addEventListener('scroll', function() {

        console.log(document.documentElement.scrollHeight)
        console.log(window.scrollY + window.innerHeight)

        if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 1){
            loadImages()
        }
        
    })

</script>


<script src="{{ asset('js/app.js') }}"></script>

</html>
