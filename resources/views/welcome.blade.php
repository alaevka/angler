<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        {!! Html::style( asset('css/app.css')) !!}
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <legend>Feed</legend>
                    <div id="feed_block"></div>
                </div>
                <div class="col-md-4">
                    <legend>Server status</legend>
                    <div id="server_status_block"></div>
                </div>
            </div>
        </div>
        {!! Html::script('js/app.js') !!}
        
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

        <script>
            var socket = io('http://angler:3000');
            socket.on('message', function(msg){
                $('#feed_block').append(msg+'<br>');
            });
            socket.on('connect', function () {
                $('#server_status_block').append('Server is connected.<br>');
            });

            socket.on('disconnect', function () {
                $('#server_status_block').append('Server is disconnected.<br>');
            });
        </script>

    </body>
</html>
