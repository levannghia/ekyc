@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div id="kyc">
            <div class="check-times">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Account authentication error</h1>
            <h3>Please try the above steps again</h3>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <a href="/document" class="btn-pre">Try again</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection