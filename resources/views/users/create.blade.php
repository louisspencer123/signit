@extends('layouts.app')
@section('title', 'Register')
@section('content')

    <form action="{{ route('store') }}" method="POST">
        @csrf

        <div class=" my-10">
            <label for="name">Name:</label>
            <input name="name" id="name" row="5" class=" p-2 bg-gray-200 @error('name') is-invalid @enderror"></input>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class=" my-10">
            <label for="email">Email:</label>
            <input name="email" id="email" row="5" class=" p-2 bg-gray-200 @error('email') is-invalid @enderror"></input>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class=" my-10">
            <label for="password">Password:</label>
            <input name="password" id="password" row="5" class=" p-2 bg-gray-200 @error('password') is-invalid @enderror"></input>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-blue">Register</button>
    </form>


@endsection