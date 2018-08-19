<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    
    <div id="utenti"></div>

    <form action="" method="post">
    <input type="text" name="nome" id="nome">
    <input type="text" name="email" id="email">s
    <input type="button" value="invia" onclick="return sendServer();">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/ajax.js') }}"></script>
</body>
</html>