@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row mt-5 pt-5">
    <div class="col-12">
        <div id="kyc">
            <div class="bg-email"></div>
            <h1 class="mb-4">Verify your email</h1>
            <h3 class="text-3">Confirm verify email to next steps if you want continue</h3>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="ver-content d-flex mt-5">
                        <div class="num">1</div>
                        <div class="text">
                            <strong>Enter email</strong> <br>
                            <span>Enter your email to receive verify code</span></div>
                    </div>
                    <div class="ver-content d-flex mt-4">
                        <div class="num">2</div>
                        <div class="text">
                            <strong>Enter verify code</strong> <br>
                            <span>Enter verify code to next step 2</span></div>
                    </div>
                </div>                   
                <div class="col-md-6 col-sm-12">
                    <form action="{{route('kyc.postotpemail')}}" method="post" class="verify">
                        @csrf
                        <div class="form-group mt-5 mb-3">
                            <div class="label mb-3">* OTP Email</div>
                            <input type="text" name="otp" class="form-control" placeholder="Enter your email" required>
                            @if(isset($error))
                            <span class="text-danger" style="font-size: 15px !important;">{{$error}}</span>
                            @endif
                            <input type="text" name="otp_email" value="{{$data['otp']}}" hidden>
                            <input type="text" name="email" value="{{$dataAll['email']}}" hidden>
                        </div>
                        <input type="submit" class="btn-submit mt-4" value="Get verify code">
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection