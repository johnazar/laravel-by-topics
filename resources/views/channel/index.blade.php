<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Channels</title>

        
    </head>
    <body class="antialiased">

        <ul>
            @foreach ($channels as $channel)
            <li>{{$channel->name}}</li>
                
            @endforeach
        </ul>
    </body>
</html>
