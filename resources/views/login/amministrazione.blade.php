<h3>benvenuto {{ auth()->user()->email }}</h3>
<h4>sei un </h4>

@permission('create-post')
    <p>This is visible to users with the given permissions. Gets translated to 
    </p>
@endpermission

@foreach(auth()->user()->roles as $roles) 

   {{ $roles['display_name'] }}

@endforeach;

amministrazione

<a href="{{ URL::to('davide/logout') }}">Logout</a>