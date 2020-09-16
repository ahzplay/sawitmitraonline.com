@extends('base.colorliblogin')

@section('content')

<div class="limiter">

    <div class="container-login100">

        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form class="login100-form validate-form" method="post" enctype="multipart/form-data" action="{{url('login-action')}}">
                {{csrf_field()}}
				<span class="login100-form-title p-b-33">PLAY</span>
                @if ($message = Session::get('message'))
                    <div id="success-alert" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <input type="hidden" name="webAppFlag" value="webapp">
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: Ex. sa@mo.com">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                    <input type="submit" class="login100-form-btn" value="Sign In" />
                </div>
                {{--<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Forgot
						</span>

                    <a href="#" class="txt2 hov1">
                        Username / Password?
                    </a>
                </div>--}}
                <br>
                <div class="text-center">
                    <p class="copyright"><small>This Template made by <a href="https://colorlib.com" target="_blank">Colorlib</a></small></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
