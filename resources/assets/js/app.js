window.$ = window.jQuery = require('jquery')
require('bootstrap-sass');
var io = require('socket.io-client');
$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
}); 
var socket = io('http://angler:3000');
socket.on('message', function(msg){
	console.log(msg);
    $('#feed_block').html(msg+'<br>');
});
socket.on('connect', function () {
    $('#server_status_block').append('Server is connected.<br>');
});

socket.on('disconnect', function () {
    $('#server_status_block').append('Server is disconnected.<br>');
});

