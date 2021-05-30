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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <style>
        .testDiv {
            height: 150px;
            background: greenyellow;
            margin: 30px 0;
        }
    </style>

  
</head>

<body>


    






        <script>
          function onResize(e) {
            if(e.data.type !== 'height') return;
            if(e.origin !== "https://americasvoice.news") return;
            document.getElementById('rav-embed-1622258216000').style.height = e.data.height + 'px';
          }
          window.addEventListener('message', onResize);
          
        </script> 
        <iframe id="rav-embed-1622258216000" style="width: 100%" src="https://americasvoice.news/embed/news/us-says-iranians-should-be-free-choose-own-leaders/" frameborder="0" scrolling="no"></iframe>


<script>
    function iframeLoaded() {
      var iFrameID = document.getElementById('rav-embed-1622258216000');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }
</script>
        
        
:style="[article.image ?  {'background-image': 'url(' + article.image + ')'} : {'background-image': 'url(/img/no_image.png)'}]"

    <div class="container"></div>

    


</body>

{{-- <script>

    const container = document.querySelector('.container')

    let offset = 0

    function loadArticles(){

        window.axios.post("/test-fetch", {
            "offset": offset
            }).then(
                response => {
                    

                    let i = 0
                    while(i < response.data.length){
                        const div = document.createElement('div')
                        div.innerHTML = response.data[i].title
                        div.className = "testDiv"
                        container.appendChild(div)

                        console.log(response.data[i])
                        i++
                    }
                },
                error => {
                    console.log(error.response.data)
                }
            )
        
        offset += 10

        console.log(offset)
    }

    loadArticles()
            
    window.addEventListener('scroll', function() {

        if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 1){
            loadArticles()
        }
        
    })

</script> --}}


<script src="{{ asset('js/app.js') }}"></script>

</html>
