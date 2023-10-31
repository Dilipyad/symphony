@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Registration</h1>
    <a href="{{ route('user.create') }}" class="btn btn-blue">Add user</a>
    <button class="btn btn-blue" id="exportExcel">Export Excel</button>
    <button class="btn btn-blue" id="createPDF">Create PDF</button>
    <table id="userTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->address }}</td>
                    <td><img src="{{ $user->profile_pic }}" height="50px" width="100px"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
