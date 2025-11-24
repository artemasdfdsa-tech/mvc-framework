@extends('layout')

@section('title', $title)

@section('content')
<h2>User Details</h2>
<p>User ID: {{ $user_id }}</p>

<div>
    <p><strong>ID:</strong> {{ $user_id }}</p>
    <!-- In a real app, we would display actual user data here -->
    <p><strong>Name:</strong> Sample User</p>
    <p><strong>Email:</strong> sample@example.com</p>
</div>

<p><a href="/users">Back to Users</a> | <a href="/">Home</a></p>
@endsection