@extends('layouts.app')
@section('content')
<main class="card form-signin w-100 m-auto mt-5">
    <form action="/register" method="POST">
      @csrf
      <img class="d-flex mb-4 mx-auto" src="{{ asset('storage/static/assets/logo.webp') }}" alt="" width="100" height="100">
      <h1 class="h3 mb-3 text-center fw-normal">Register</h1>
  
      <div class="form-floating">
        <input type="text" class="form-control" name="name" id="name">
        <label for="name">name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username" value="{{ old('username')}}" required autofocus placeholder="username">
        <label for="username">username</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" name="email" id="email" placeholder="email...">
        <label for="email">email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" required name="password" id="password" placeholder="password..">
        <label for="password">Password</label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    </form>
  </main>
@endsection