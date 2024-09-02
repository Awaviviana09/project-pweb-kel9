@php
    $username = auth()->user()->username;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 + 1 = 5</title>
</head>
<body>
    <div>
        <h1 style="  height: 100%; display: flex; justify-content: center; align-items: center;">{{ $username }} WAS HERE!</h1>
        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>