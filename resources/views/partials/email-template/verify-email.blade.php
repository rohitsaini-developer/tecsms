<h1>Email Verification Mail</h1>
  
Please verify your email with bellow link: 
<a href="{{ route('user.verify.email', ['user_id' => $user_id, 'token' => $token]) }}">Verify Email</a>
<p>If This link is not then you can copy and paste this url {{ route('user.verify.email', ['user_id' => $user_id, 'token' => $token]) }}</p>
