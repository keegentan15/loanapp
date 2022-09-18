
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="{{asset('/dist/css/style.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Javascript Here -->
  <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"> -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

<!--===============================================================================================-->
</head>
<style>
body {
  padding:0;
  margin:0;
}

.container-login {
  height:100vh;
  background: linear-gradient(#e66465, #9198e5);
}

.container-login-center {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  width:400px;
  background:white;
  border-radius:10px;
}

.container-login-center h1 {
  text-align: center;
  padding:0 0 20px 0;
  border-bottom:1px solid silver;
}

.container-login-center form {
  padding:0 40px;
  box-sizing:border-box;
}

.container-login-center form .txt_field {
  position:relative;
  border-bottom:2px solid #adadad;
  margin:30px 0;
}

.txt_field input {
  width:100%;
  padding:0 5px;
  height:40px;
  font-size:16px;
  border:none;
  background:none;
  outline:none;
}

.txt_field label {
  position:absolute;
  top:50%;
  left:5px;
  color:#adadad;
  transform: translateY(-50%);
  font-size:16px;
  pointer-events:none;
  transition:.5s;
}

.txt_field span:before {
  content:'';
  position:absolute;
  top:40px;
  left:0;
  width:0%;
  height:2px;
  background:#2961d9;
  transition:.5s;
}

.txt_field input:focus ~ label,
.txt_field input:valid ~ label {
  top:-5px;
  color:#2961d9;
}

.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before {
  width:100%;
}

input[type="submit"] {
  width:100%;
  height:50px;
  border:1px solid;
  background:#2691d9;
  font-size:18px;
  color:#e9f4fb;
  font-weight:700;
  cursor:pointer;
  outline:none;
  margin:30px 0;
}

input[type="submit"]:hover {
  border-color:#2691d9;
  transition:.5s;
}

.login-box{
  display:flex;
  flex-direction:column;
}

img{
  width:60%;
  margin-top:-60px;
  margin-bottom:-100px;
  align-self:center;
}

</style>

<body>
	<div class="container-login">
    <div class="container-login-center">
      <img style="width:100%;margin-bottom:-150px;margin-top:-100px;"src="{{asset('assets/images/logo.png')}}" class="dark-logo"alt="hompeage"/>

      <form method="POST" action="{{route('login-user')}}">
        @if(Session::has('success'))
            <div class="alert">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
        @csrf
        <div class="txt_field">
          <input type="text" name="Email" required>
          <span></span>
          <label>Email</label>  
        </div>
        <div class="txt_field">
          <input type="password" name="Password" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" value="Login">
      </form>
    </div>
  </div>


	{{-- <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{route('login-user')}}">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-success">{{Session::get('fail')}}</div>
            @endif
            @csrf
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> --}}
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <link href="{{asset('/dist/css/style.min.css')}}" rel="stylesheet">


</body>
</html>