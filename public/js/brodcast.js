
Pusher.logToConsole = true;

var pusher = new Pusher('0aa8ac4953f4fcd5e8cc', {
    cluster: 'eu',
    encrypted: true
  });

  var channel = pusher.subscribe('notify');
  
  pusher.connection.bind('connected', function() {
  
    var inputs = document.getElementById("status").innerHTML = "New text!";

  });
  
  /*
  channel.bind('notify-event', function(message) {
    alert(message);
  });
  */