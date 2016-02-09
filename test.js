var PGPubsub = require('pg-pubsub');

var pubsubInstance = new PGPubsub('postgres://postgres@localhost/angler');

pubsubInstance.addChannel('channelName', function (channelPayload) {
  	console.log(channelPayload);
});

pubsubInstance.publish('channelName', { hello: "world" });