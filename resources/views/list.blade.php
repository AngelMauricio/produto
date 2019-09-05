<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>

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
                
                float: right;
                margin-right: 20%;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 100%;
            }

            .alert {
                background: #dce6dc;
                background: -moz-linear-gradient(-45deg, #dce6dc 0%, #dfe5d7 40%, #bec8be 100%);
                background: -webkit-linear-gradient(-45deg, #dce6dc 0%,#dfe5d7 40%,#bec8be 100%);
                background: linear-gradient(135deg, #dce6dc 0%,#dfe5d7 40%,#bec8be 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dce6dc', endColorstr='#bec8be',GradientType=1 );
                width: 400px;
                border-radius: 5px;
                vertical-align: middle;
                color: #666666;
                padding-top: 14px !important;
                padding-bottom: 14px !important;
                display: inline-block;
                margin-top: 10px;
                margin-bottom: 10px;
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

            form {
                width: 0px;
                display: inline;
            }
        </style>

        <script>
            $(function(){
                $('body').on('click', '.close', function(){
                    $('.' + $(this).data('dismiss')).hide()
                })
            })
        </script>
    </head>
    <body>
        @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" 
               data-dismiss="alert"
               aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
        @endif

        <a class="btn" href="{{route('produto.create')}}">Novo</a>

        <table class="display">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->produto_nome}}</td>
                    <td>R$ {{number_format($produto->produto_preco / 100, 2, ',', '.')}}</td>
                    <td>
                        <a href="{{route('produto.show', $produto->produto_id)}}">Ver</a> | 
                        <a href="{{route('produto.edit', $produto->produto_id)}}">Editar</a> | 
                        {{ \Form::open(['method' => 'DELETE', 'route' => ['produto.destroy', $produto->produto_id]]) }}
                            <button type="submit">Deletar</button>
                        {{ \Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
