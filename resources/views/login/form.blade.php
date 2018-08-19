@extends('template')


@section('title')
navigation
@endsection

@section('content')

<h2>login</h2>

@foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
@endforeach

<form method="POST" action="{{ route('access') }}">
  email:<br>
  <input type="text" name="email">
  <br>
  passw:<br>
  <input type="text" name="password">
  <input type="submit" value="login">
</form>

@endsection