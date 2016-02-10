<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        {!! Html::style( asset('css/app.css')) !!}
    </head>
    <body class="blue-gradient-background">
        <div class="container" id="app">
            <div class="row">
                <div class="col-md-8">
                    <legend>FlyFeed <small>Displaying live coordinates feeds</small></legend>
                    <div id="feed_block">
                        
                    </div>
                    <div id="map"></div>
                </div>
                <div class="col-md-4">
                    <legend>Server status</legend>
                    <div id="server_status_block"></div>
                </div>
            </div>
        </div>
        
        {!! Html::script('js/app.js') !!}
        
    </body>
</html>
