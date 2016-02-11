//vue 
// new Vue({
// 	el: '#app',

// 	ready: function() {
// 		this.fetchUsers();
// 	},

// 	methods: {
// 		fetchUsers: function() {
			
// 			this.$http.get('/api/user', function(users) {
// 				console.log(users); 
// 				self.users = users;
// 			});
// 		}
// 	}
// });

$( document ).ready(function() {
    console.log($.fn.tooltip.Constructor.VERSION);
}); 




function initMap() {
	var myLatLng = {lat: 53.199791, lng: 45.008667};

	map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 12,
	    center: myLatLng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP,
	});

	marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	});

}

var socket = io('http://angler:3000');

socket.on('message', function(msg){
	//console.log(msg);
    $('#feed_block').html(msg.o+'<br>');


    var location = new google.maps.LatLng(msg.lat, msg.lon);
    map.setCenter(location);
    marker.setPosition(location);

	console.log(marker);

});
socket.on('connect', function () {
    $('#server_status_block').append('Server is connected.<br>');
});

socket.on('disconnect', function () {
    $('#server_status_block').append('Server is disconnected.<br>');
}); 