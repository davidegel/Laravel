<html>
<head></head>
<body>
<h1>{{$title}}</h1>
<p>{{$content}}</p>
<a href="{{ route('user_code_verify', [$email, $code]) }}">Click here</a>
</body>
</html>