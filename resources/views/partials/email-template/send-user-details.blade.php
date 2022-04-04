<h2>Your Tecsms Login Details</h2>

<div class="row">
        <span>Name:</span>
        <span>{{$user_name}}</span>
</div>
<div class="row">
        <span>Password:</span>
        <span>{{$password}}</span>
</div>
{{--@if($user->hasRole('postpaid'))
    <span>Billing Id:</span>
    <span>{{$billing_id}}</span>
@endif --}}
<div class="col-md-12">
    <p>You can login with your email and password and <a href="{{ route('login') }}"> Click here</a> to login on tecsms account</p>
</div>