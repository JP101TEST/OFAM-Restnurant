<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">ลงชื่อเข้าใช้</h3>

                            <form method="post" action="{{ route('management.postRequest') }}">
                                @csrf
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input class="form-control {{ session('errorUser') ? 'is-invalid' : '' }}" type="text" id="user" name="user" @if (session('user.ole')) value="{{ session('user.ole') }}" @endif>
                                        <label for="user">ชื่อผู้ใช้</label>
                                    </div>
                                    @if (session('errorUser'))
                                    <div class="invalid-feedback">
                                        {{ session('errorUser') }}
                                    </div>
                                    @endif
                                </div>
                                <br>
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input class="form-control {{ session('errorPassword') ? 'is-invalid' : '' }}" type="password" id="password" name="password" @if (session('password.ole')) value="{{ session('password.ole') }}" @endif>
                                        <label for="password">รหัสผ่าน</label>
                                    </div>
                                    @if (session('errorPassword'))
                                    <div class="invalid-feedback">
                                        {{ session('errorPassword') }}
                                    </div>
                                    @endif
                                </div><br>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">เข้าสู่ระบบ</button>
                            </form>
                            {{ session()->forget(['errorUser', 'errorPassword', 'user.ole', 'password.ole']) }}
                            </sbpro-login-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
