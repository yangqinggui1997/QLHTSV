<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="resources/js/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4f5f4bfea4d15f3b8eec', {
      cluster: 'ap1',
      forceTLS: true,
      encrypted: true
    });

    var channel = pusher.subscribe('test');
    channel.bind('test', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>