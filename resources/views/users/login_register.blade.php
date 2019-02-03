@extends('frontend.front_design')

@section('content')

    <section id="form" style="margin-top: 20px;"><!--form-->
        <div class="container">
            <div class="row">
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong class="text-warning">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{route('user.login')}}" id="loginForm" name="loginForm" method="post">
                            @csrf
                            <input type="email" placeholder="Email Address" name="email" id="email"/>
                            <input type="password" placeholder="Password" name="password"  />

                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{route('user.register')}}" id="registerForm" name="registerForm" method="post">
                            @csrf
                            <input type="text" placeholder="Name" name="name" id="name"/>
                            <input type="email" placeholder="Email Address" name="email" id="email"/>
                            <input type="password" placeholder="Password" name="password" id="password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

    @endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js?fbclid=IwAR1RjITeTwmkv0NszrXT4kZGopGY0gYIwkjQLvDvAh1kw4tBD4JdJFHpgl8">

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#registerForm").validate({
                rules: {
                    name: {
                        required : true
                    },
                    password:{
                        required : true
                    },
                    email:{
                        required: true,
                        email: true,
                    }
                },
                messages: {
                    name: {
                        required : "<span class='text-danger'> Please Enter Name</span>"
                    },
                    password:{
                        required: "<span class='text-danger'> Please Enter Password</span>"
                    },
                    email:{
                        required: "<span class='text-danger'> Please Enter Email</span>",
                        email: "<span class='text-danger'> Please Insert Valid Email Address </span>"
                    }

                }
            });
        });

        $(document).ready(function () {
            $("#loginForm").validate({
                rules: {

                    password:{
                        required : true
                    },
                    email:{
                        required: true,
                        email: true,
                    }
                },
                messages: {

                    password:{
                        required: "<span class='text-danger'> Please Enter Password</span>"
                    },
                    email:{
                        required: "<span class='text-danger'> Please Enter Email</span>",
                        email: "<span class='text-danger'> Please Insert Valid Email Address </span>"
                    }

                }
            });
        });


        $('#password').passtrength({
            minChars: 4,
            passwordToggle: true,
            tooltip: true,
        eyeImg : "http://localhost:8888/hamroshop/public/frontpanel/images/eye.svg" // toggle icon

        });



    </script>
    @endsection