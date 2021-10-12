@extends('Sites::layout')
@section('title', $row->title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                    <div class="inner-circle"></div>
                    <p class="h4 mt-3 mb-1">Residence</p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                    <div class="inner-circle"></div>
                    <p class="h4 mt-3 mb-1">Profile</p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                    <div class="inner-circle"></div>
                    <p class="h4 mt-3 mb-1">Document</p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                    <div class="inner-circle active"></div>
                    <p class="h4 mt-3 mb-1">Address</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 mb-5">
    <div class="col-12">
        <div id="kyc">
            <h1>Verify your identity</h1>

            <form action="{{route('kyc.postaddress')}}" method="post">
                @csrf
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" name="cmnd" value="cmnd" hidden>
                        <input type="text" class="form-control" name="id" value="{{$document['id']}}" hidden>
                        <input type="text" class="form-control" name="id" value="{{$document['id']}}" hidden>
                        <input type="text" class="form-control" value="{{$document['cmnd']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" class="form-control" value="{{$document['name']}}" readonly>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" value="{{$document['dob']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" class="form-control" value="{{$document['address']}}" readonly>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="text" class="form-control" value="{{$document['home']}}" readonly>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" class="form-control" value="{{$document['ethnicity']}}" readonly>
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
                    <button type="submit" class="btn-pre" name="pre" value="0">Previous</button>
                    <button type="submit" class="btn-next" name="next" value="1">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection