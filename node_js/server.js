// var app = require('express')();
// var http = require('http').Server(app);
// var io = require('socket.io')(http);

// io.on('connection', function(socket){
//   	console.log('a user connected');
//   	socket.emit('message', 'test');
//   	socket.on('disconnect', function(){
// 		console.log('user disconnected');
//   	});
// });

// http.listen(3000, function(){
//   console.log('listening on *:3000');
// });

var io = require('socket.io').listen(3000);
var mubsub = require('mubsub');
var client = mubsub('mongodb://localhost:27017/angler');
var channel = client.channel('posts', { size: 1000000000});

io.on('connection', function(socket){
  	console.log('a user connected');
  	socket.on('disconnect', function(){
		console.log('user disconnected');
  	});
});
channel.on('document', function(data){
	console.log(data.text);
  	io.emit('message', data.text);
});
