<p> Welcome {{ $user->name }}</p>

<p>You recieve this message because iloveyou</p>
<p>please click the button</p>

<p>
    <a href="{{ url('/verification/' . $user->id . '/' . $user->remember_token) }}">Click Here</a>
</p>
