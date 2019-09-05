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

            form {
                width: 50%;
                margin-left: 25%;
            }

            textarea {
                width: 100%
            }

            .right {
                float: right
            }

            #image-slider {
                width: 100%;
                overflow-y: auto;
                border-left: 5px solid #14a0c7;
                border-radius: 5px;
                margin-left: 11px;
            }

            .image-item {
                width: 250px;
                margin-left: auto;
                left: auto;
                right: auto;
                float: left;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding: 0 0.75rem;
                min-height: 1px;
            }

            .card {
                position: relative;
                margin: 0.5rem 0 1rem 0;
                background-color: #fff;
                -webkit-transition: -webkit-box-shadow .25s;
                transition: -webkit-box-shadow .25s;
                transition: box-shadow .25s;
                transition: box-shadow .25s, -webkit-box-shadow .25s;
                border-radius: 2px;
            }

            .card .card-image {
                position: relative;
            }

            .card .card-image img {
                width: 227px;
                height: 227px;
                object-fit: cover;

                display: block;
                border-radius: 2px 2px 0 0;
                position: relative;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
            }

            .card .card-content {
                padding-top: 24px;
                padding-right: 0px;
                padding-bottom: 24px;
                padding-left: 0px;
                border-radius: 0 0 2px 2px;

                text-align: center;
            }

            .card textarea {
                width: 223px;
            }

            .card input {
                width: 212px;
            }

            #image-slider > .row {
                width: max-content;
            }

            input[type=file], input[type=checkbox] {
                display:none
            }
        </style>

            <script>
            var newImageQuantity = 0;
            $(function(){
                $('.money').mask('000.000,00', {reverse: true});

                $('body').on('click', '.new .delete-img', function () {
                    $(this).closest('.image-item').remove()
                })

                $('body').on('click', '.old .delete-img', function () {
                    var container = $(this).closest('.image-item');
                    var actualStatus = $('input[type="checkbox"]', container).is(':checked')
                    $('input[type="checkbox"]', container).prop('checked', !actualStatus)
                    if (actualStatus) {
                        $(this).text('Deletar')
                        $('img', container).css({ opacity: 1 })
                    } else {
                        $(this).text('Cancelar')
                        $('img', container).css({ opacity: 0.5 })
                    }
                })

                $('.add-img').on('click', function(){
                    var FileField = $('<input type="file" accept="image/*" class="hide">');
                    FileField.click();
                    FileField.on('change', function() {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            var template =
                                $(`<div class="image-item new" data-id="${++newImageQuantity}">
                                                <div class="card">
                                                    <div class="card-image">
                                                        <img src="/tcc/assets/images/no-image.svg">
                                                    </div>
                                                    <div class="card-content">
                                                        <a href="javascript:void(0)" class="delete-img">Deletar</a>
                                                    </div>
                                                </div>
                                            </div>`);
                            reader.onload = function(e) {
                                $('img', template).attr('src', e.target.result);
                            }

                            reader.readAsDataURL(this.files[0]);
                            FileField.attr('name', 'newFile[]')
                            $(template).append(FileField);
                            $('#image-slider .row').append(template);

                        }
                    })
                })
            })
            </script>
    </head>
    <body>
        <a class="btn back" href="javascript:history.go(-1)">Voltar</a>
        {{ \Form::open(['method' => 'PUT', 'route' => ['produto.update', $product->produto_id], 'enctype' => 'multipart/form-data']) }}
            <label>Nome</label><br>
            <input type="text" name="produto_nome" value="{{$product->produto_nome}}"><br><br>

            <label>Preço</label><br>
            <input type="text" name="produto_preco" value="{{$product->produto_preco}}" class="money"><br><br>

            <label>Descricao</label><br>
            <textarea name="produto_descricao" maxlength="255">{{$product->produto_descricao}}</textarea><br><br>

            <div class="col s12" id="image-slider">
                <label class="active left">Imagens</label><br>

                <div class="row">
                    @foreach ($images as $image)
                        <div class="image-item old">
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{url('storage/produtos/'.$image->imagem_arquivo)}}">
                                </div>
                                <div class="card-content">
                                    <input type="checkbox" name="deleteImage[{{$image->imagem_id}}]">
                                    <a href="javascript:void(0)" class="delete-img">Deletar</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="javascript:void(0)" class="add-img">Adicionar Imagem</a>

            <button type="submit" class="btn save">Salvar</button>
        {{ \Form::close() }}
    </body>
</html>
