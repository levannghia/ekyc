@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row mt-4 mb-5">
    <div class="col-12">
        <div id="kyc">
            <h1>Verify your identity</h1>

            <form action="{{route('kyc.postaddress')}}" method="post">
                @csrf
                <div class="form-group mt-5" style="text-align: center;">
                    <input type="text" class="form-control" name="passport" value="passport" hidden>
                    <input type="text" class="form-control" name="id" value="{{$passport['id']}}" hidden>
                    <input type="text" class="form-control" value="{{$passport['id_number']}}" readonly>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" name="id" value="{{$passport['id']}}" hidden>
                        <input type="text" class="form-control" value="{{$passport['name']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" class="form-control" value="{{$passport['dob']}}" readonly>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" value="{{$passport['pob']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" class="form-control" value="{{$passport['sex']}}" readonly>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" value="{{$passport['dob']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">

                        <input type="text" class="form-control" value="{{$passport['doe']}}" readonly>
                    </div>
                </div>
                <div class="form-group custom">
                    <div class="photo mt-3">
                        <video id="camera"></video>
                        <canvas id="canvas"></canvas>
                    </div>
                    <audio id="snapSound" src="audio/snap.wav" preload="auto"></audio>
                    <input type="button" value="Take your photo" class="actual-btns" id="take-photo">
                    <input type="text" src="" value="" id="download-photo" name="photo" alt="" hidden>
                    @if(isset($error))
                    <div class="error-upload-front">
                        <span class="text-danger">{{$error}}</span>
                    </div>
                    @endif
    <div class="d-flex">
                        <input type="button" value="Try it" class="actual-try" id="try">
                        <input type="button" value="Take" name="checkVision" class="actual-take mt-5" id="checker">
                    </div>
                </div>


                <div class="pre-next">
                    <button type="submit" class="btn-next-left" name="pre" value="0">Previous</button>
                    <button type="submit" class="btn-next" name="next" value="1">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection