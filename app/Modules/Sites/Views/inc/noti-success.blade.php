@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div id="kyc">
            <div class="check-times-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Account authentication success</h1>
            <h3><a href=""></a>Return to your app and carry on.</h3>
        </div>
    </div>
</div>
@endsection