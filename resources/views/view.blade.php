<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js" type="text/javascript"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                text-align: center;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            table {
                width: 80%;
                margin-left: 10%;
            }

            table tbody tr:hover {
                background: #c3cbcf
            }

            td:last-child, th:last-child {
                width: 20%;
                text-align: center;
            }

            .btn, .btn-large, .btn-small {
                text-decoration: none;
                color: #fff;
                background-color: #14a0c7;
                text-align: center;
                letter-spacing: .5px;
                -webkit-transition: background-color .2s ease-out;
                transition: background-color .2s ease-out;
                cursor: pointer;

                border: none;
                border-radius: 2px;
                display: inline-block;
                height: 36px;
                line-height: 36px;
                padding: 0 16px;
                text-transform: uppercase;
                vertical-align: middle;
                -webkit-tap-highlight-color: transparent;

                font-size: 14px;
                outline: 0;
                
                margin-right: 20%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .btn.back {
                margin-left: 20%;
                margin-right: 100%;
            }

            .btn.save {
                margin-left: 100%;
                margin-right: 20%;
            }

            html {
                line-height: 1.5;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
                font-weight: normal;
                color: rgba(0,0,0,0.87);
            }

            button {
                background: none;
                color: inherit;
                border: none;
                padding: 0;
                font: inherit;
                cursor: pointer;
                outline: inherit;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            {{$c = 0}}
            @foreach ($images as $image)
                .slide-controller:nth-child({{$c + 1}}):checked ~ .slide-show .slides-list{--selected-item: {{$c++}};}
            @endforeach

            .slide-show{
                overflow: hidden;
            }

            .slides-list{
                --selected-item: 0;
                --total-items: {{count($images)}};
                list-style-type: none;
                margin: 10px 0;
                padding: 0;
                position: relative;
                left: calc(var(--selected-item) * -100%);
                width: calc(var(--total-items) * 100%);
                transition: left 0.4s cubic-bezier(0.680, -0.550, 0.265, 1.550);
                
                display: grid;
                grid-auto-flow: column;
                grid-auto-columns: 1fr;
            }

            .slide img {
                max-width: 500px;
                max-height: 500px;
            }

            .details, .image {
                width: 40%;
                float: left;
                margin-top: 20px
            }

            .details {
                margin-left: 10%
            }
            
            .image {
                margin-right: 10%
            }

            .description {
                width: 100%;
                display: block;
                text-align: justify;
                text-justify: inter-word;
                text-indent: 1em;
            }

            .price {
                width: 100%;
                display: block;
                text-align: right;
                font-weight: 800;
                font-size: 1.5rem;
            }
        </style>

        <script>
            $(function(){
                var imageCount = {{count($images)}}, actualImage = 0;
                function updateImage() {
                    $($('input[type="radio"]')[actualImage++]).click()
                    if (actualImage >= imageCount)
                        actualImage -= imageCount;
                }
                if (imageCount) {
                    setInterval(updateImage, 10000)
                    updateImage()
                }
            })
        </script>
    </head>
    <body>
        <a class="btn back" href="javascript:history.go(-1)">Voltar</a>
        <div class="details">
            <h1 class="name">{{$product->produto_nome}}</h1>
            <span class="price">R$ {{number_format($product->produto_preco / 100, 2, ',', '.')}}</span>
            <span class="description">{{$product->produto_descricao}}</span>
        </div>
        <div class="image">
            @foreach ($images as $image)
                <input type="radio" class="slide-controller" name="slide" />
            @endforeach

            <div class="slide-show" >
                <ul class="slides-list" >
                    @foreach ($images as $image)
                        <li class="slide" >
                            <img src="{{url('storage/produtos/'.$image->imagem_arquivo)}}" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>