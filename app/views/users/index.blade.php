@extends('layout')

@section('title', $title)

@section('content')
<h2>All Users</h2>

@if (empty($users))
    <p>No users found.</p>
@else
    <ul>
    @foreach ($users as $user)
        <li>
            <a href="/users/{{ $user->id }}">
                {{ $user->name }} ({{ $user->email }})
            </a>
        </li>
    @endforeach
    </ul>
@endif

<p><a href="/">Back to Home</a></p>
@endsection