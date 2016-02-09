<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {{-- <div class="content">
                <div class="title">Laravel 5</div>
            </div> --}}
        </div>
        <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

        <script>
            var socket = io('http://angler:3000');
            socket.on('message', function(msg){
                $('.container').append(msg+'<br>');
            });
        </script>
    </body>
</html>
