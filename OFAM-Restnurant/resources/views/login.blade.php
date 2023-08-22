<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div _ngcontent-serverapp-c91="" class="card-body p-5">
        <div _ngcontent-serverapp-c91="" class="row justify-content-center">
            <div _ngcontent-serverapp-c91="" class="col-xl-8 col-lg-9"><sbpro-login-form _ngcontent-serverapp-c91="" _nghost-serverapp-c90=""><!----><!----><!---->
                    <form method="post" action="{{ route('management.postRequest') }}">
                        @csrf
                        <label for="user">ชื่อผู้ใช้:</label><br>
                        <input type="text" id="user" name="user" @if (session('user.ole')) value="{{ session('user.ole') }}" @endif><br>
                        @if (session('errorUser'))
                        <div class="text-danger">{{ session('errorUser') }}</div>
                        @endif
                        <label for="password">รหัสผ่าน:</label><br>
                        <input type="text" id="password" name="password" @if (session('password.ole')) value="{{ session('password.ole') }}" @endif><br>
                        @if (session('errorPassword'))
                        <div class="text-danger">{{ session('errorPassword') }}</div>
                        @endif
                        <button type="submit">Submit</button>
                    </form>
                    {{ session()->forget(['errorUser', 'errorPassword', 'user.ole', 'password.ole']) }}
                </sbpro-login-form></div>
        </div>
    </div>
</body>

</html>
