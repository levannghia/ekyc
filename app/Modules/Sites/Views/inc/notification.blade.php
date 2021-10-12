@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div id="kyc">
            <div class="check">
                <i class="far fa-check-circle"></i>
            </div>
            <h1>Account verification successful</h1>
            <!-- <h3>Welcome to <span class="yotrip">Yotrip</span></h3> -->
            <div class="row">
                <div class="col-12">
                    <a href="index-email.html" class="btn-next">Continue</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection