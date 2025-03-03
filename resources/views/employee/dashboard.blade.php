@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Dashboard</h1>
        <p>Welcome to your dashboard, {{ auth()->user()->first_name }}!</p>

        <div class="card">
            <div class="card-body">
                <h5>Your Profile</h5>
                <p><strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> Employee</p>
            </div>
        </div>
    </div>
@endsection
