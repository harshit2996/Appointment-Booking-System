<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <user v-bind:current-user='{!!json_encode(auth()->user())!!}'></user>

  </div>
</body>
<script>
    window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
  
<script type="text/javascript">
    var i = 0;
    var id = "{{Auth::id()}}";
    // console.log(id);
    window.Echo.private('admin.'+id)
      .listen('.AdminEvent', (data) => {
        $("#notification").append('<div><div style="display:inline-block; background-color:lightgreen;padding:5px;margin:2px;border-radius:2px">'+data.title+'<div></div>');
    });
    window.Echo.private('user.'+id)
      .listen('.UserEvent', (data) => {
        $("#notification").append('<div align="right"><div style="display:inline-block; background-color:orange;padding:5px;margin:2px;border-radius:2px">'+data.title+'</div></div>');
    });
        
</script>

</html>

