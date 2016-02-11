var elixir = require('laravel-elixir');


elixir(function(mix) {
	mix.scripts([
		'vendor/jquery-2.2.0.min.js',
		'vendor/bootstrap.min.js',
		'vendor/vue.min.js',
		'vendor/vue-resource.min.js',
		'vendor/socket.io-1.4.5.js',
		'vendor/gmaps.js',
		'app.js',
	], 'public/js/vendor.js');
    mix.sass('app.scss'); //.browserify('app.js');
}); 
