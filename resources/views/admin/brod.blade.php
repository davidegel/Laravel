<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h3>ciao</h3>
    <a href="{{ url("/posts/2") }}">post</a>
<div id="status">stat: </div>

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/brodcast.js') }}"></script>
</body>
</html>