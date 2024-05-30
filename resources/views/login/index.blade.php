@extends('layouts.app')
@section('content')
<main class="card form-signin w-100 m-auto mt-5">
  <form action=" {{ route('login') }} " method="POST">
      @csrf
      <img class="d-flex mb-4 mx-auto" src="{{ asset('storage/static/assets/logo.webp') }}" alt="" width="100" height="100">
      <h1 class="h3 mb-3 text-center fw-normal">Admin Login</h1>
  
      <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username" value="{{ old('username')}}" required autofocus>
        <label for="username">username</label>
      </div>
      @error('username')
        <div class="mt-1 alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="form-floating">
        <input type="password" class="form-control" required name="password" id="password" placeholder="password..">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
    </form>
  </main>
@endsection