/*
	pubsub from mongo insert
*/

// var io = require('socket.io').listen(3000);
// var mubsub = require('mubsub');
// var client = mubsub('mongodb://localhost:27017/angler');
// var channel = client.channel('posts', { size: 1000000000});

// io.on('connection', function(socket){
//   	console.log('a user connected');
//   	socket.on('disconnect', function(){
// 		console.log('user disconnected');
//   	});
// });
// channel.on('document', function(data){
// 	console.log(data.text);
//   	io.emit('message', data.text);
// });

/*
	coordinates streaming
*/
var io = require('socket.io').listen(3000);

var key = 'drone1';
var lat = 53.2009050000 + (Math.random() / 100);
var lng = 45.0106070000 + (Math.random() / 100);
var latO = (Math.random() - .5) / 1000;
var lngO = (Math.random() -.5) / 1000;

console.log('Sending random data for key ' + key);

setInterval( function() {
        lat += (Math.random() / 1000) + latO;
        lng += (Math.random() / 1000) + lngO;
        var o = [{"device_uid":key,"points":[[0,lat,lng,10]]}];
        console.log('feed.'+key+' '+JSON.stringify(o));
        io.emit('message', {lat: lat, lon: lng, o: JSON.stringify(o)});
    }, 1000);
