@extends('layouts.home')

@section('title', 'Register')

@section('sub_title', 'Register now to post a blog.')

@section('bg_img', '/home-assets/assets/img/home-bg.jpg')

@section('content')
    <!-- Main Content-->
    <div class="container">
        <div class="col-lg-5 mx-auto">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="post" action="{{ route('auth.register.post') }}">
                @csrf
                <div class="mb-3">
                    <label  class="form-label" for="name">Name :</label>
                    <input class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Your Name" />
                    @error('name')
                        <div class="form-text text-danger">Invalid Name</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label" for="email">Email :</label>
                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Enter Your Email" />
                    @error('email')
                    <div class="form-text text-danger">Invalid Email / Email Already Exists</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label" for="password">Password :</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter Your Password" />
                    @error('password')
                    <div class="form-text text-danger">Password Error</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label  class="form-label" for="password_confirmation">Confirm Password :</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                </div>

                <button type="submit" class="btn btn-success">
                    Register
                </button>
            </form>
        </div>
    </div>
@endsection
