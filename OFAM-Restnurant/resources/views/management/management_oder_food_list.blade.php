<?php

use App\Models\Employee; //เพิ่มมาทีหลัง

$employees = Employee::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOFL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Laravel 9 crud</h2>
                <h2>{{ session('User')[0]->employees_id }}</h2>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <!-- Add more table headers for other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->employees_id }}</td>
                            <td>{{ $employee->employees_password}}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->employees_phone }}</td>
                            <td><img src="{{ asset('images/' . $employee->employees_picture) }}" alt=""></td>
                            <!-- Add more table cells for other columns as needed -->
                        </tr>
                        @endforeach
                    </tbody><br>
                </table>
                <form action="{{ route('management.logout') }}" method="post">
                    @csrf <!-- Add CSRF token for Laravel form -->
                    <button type="submit" class="btn btn-success">logout</button>
                </form>
                @if(session('User')[0]->management_lavel == 'admin')
                <form action="{{ route('management.logout') }}" method="post">
                    @csrf <!-- Add CSRF token for Laravel form -->
                    <button type="submit" class="btn btn-danger">logout</button>
                </form>
                @endif
                {{session('User')}}
            </div>
        </div>
    </div>
</body>

</html>
