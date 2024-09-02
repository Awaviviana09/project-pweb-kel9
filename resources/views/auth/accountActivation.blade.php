<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <title>Activation Account !</title>
  <link rel="stylesheet" href="{{asset('assets/css/accountActivation.css')}}">
  <link href='https://  unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  @if(session()->has('otpFailed'))
  <script>
    alert("{{session('otpFailed')}}")
  </script>
  @endif

<div class="wrapper">
    <span class="bg-animate"></span>
    <span class="bg-animate2"></span>

  <div class="form-box activate"><br>
    <form action="{{route('auth.validatingOTP')}}" method="post">
      
      <div class="input-box animation" style="--i:2; --j:23;">
        @csrf
        @method('post')
        <input type="text" required name="otp" maxlength='6'>
        <label >Enter OTP Code</label>
      </div>
      <button type="submit" class="btn animation" style="--i:3; --j:24;">Send</button>

      <div class="logreg-link animation" style="--i:4; --j:25;">
        <p><a href="{{route('auth.login')}}" class="register-link">Back to home</a></p>
        
        {{-- TODO : Add ROute!!!!! --}}
        {{-- <p><a href="#" class="register-link">Resend code</a></p> --}}
        {{-- DONT FORGET!! --}}
      </div>
    </form>
  </div>
    <div class="info-text activate">
      <h2 class="animation" style="--i:0; --j:20;">Account Activation</h2><br><br>
      <p class="animation" style="--i:1; --j:21;">OTP Code, Check Your Email.</p>
    </div>

      </form>
    </div>
</div>

    <script src="{{asset('assets/js/accountActivation.js')}}"></script>
</body>
</html>
