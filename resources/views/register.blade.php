<h3>User register</h3>
<form method="post" action="{{ route('user_code_generate') }}" accept-charset="UTF-8">
name<input type="text" name="name"><br>
email<input type="text" name="email"><br>
la tua pas <input type="text" name="pwd" id="">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="submit" value="registrati">
</form>