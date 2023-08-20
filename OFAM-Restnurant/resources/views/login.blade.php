<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    $name = 'job';
    $imageName ='Untitled.jpg';
    ?>
    <h1>ยินดีต้อนรับ {{$name." ไม่เจอกันนานเลยนะ"}} </h1>
    @if($name == 'job')
    <h2>admin</h2>
    @else
    <h2>user</h2>
    @endif
    <img src="{{ asset('images/' . $imageName) }}">
</body>

</html>
