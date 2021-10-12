@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row pt-5">
    <div class="col-12">
        <div id="kyc">
            <h1 class="mb-5">Verification results</h1>
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3 report-img">
                    <img src="{{asset('public/passport')}}/{{$documents->img}}" class="img-fluid" alt="">
                </div>
                <div class="col-md-4 col-sm-12 mb-3 report-img">
                    <img src="{{asset('public/user_passport')}}/{{$documents->img_passport_camera}}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="row mt-5 pl-4">
                <div class="d-flex w-100 mb-3">
                    <strong class="w-33">Facematch</strong>
                    <div class="w-66 text-green">{{round($facematch->data->similarity, 2)}}%</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">Number</strong>
                    <div class="w-66">{{$documents->id_number}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">Name</strong>
                    <div class="w-66 to-upper">{{$documents->name}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">Gender</strong>
                    <div class="w-66 to-upper">{{$documents->sex}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">Birth date</strong>
                    <div class="w-66">{{$documents->dob}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">DOI</strong>
                    <div class="w-66 to-upper">{{$documents->doi}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">DOE</strong>
                    <div class="w-66 to-upper">{{$documents->doe}}</div>
                </div>
                <div class="d-flex w-100  mb-3">
                    <strong class="w-33">Place of birth</strong>
                    <div class="w-66">{{$documents->pob}}</div>
                </div>
            </div>
            <form action="{{route('kyc.pre-passport')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn-pre" name="pre" value="0">Previous</button>
                        <button type="submit" class="btn-next" name="next" value="1">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection