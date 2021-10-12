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
                    <div class="inner-circle active"></div>
                    <p class="h4 mt-3 mb-1">Document</p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                    <div class="inner-circle"></div>
                    <p class="h4 mt-3 mb-1">Address</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <div id="kyc">
            <h1>Verify your identity</h1>
            <form action="{{route('kyc.postdocument')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group f-12 mt-5">
                    <input type="radio" id="tab1" name="tab" value="cmnd" checked>
                    <label for="tab1" class="mr-3">National ID</label>
                    <input type="radio" id="tab2" name="tab" value="passport">
                    <label for="tab2" class="mr-3"> Passport</label>
                    <input type="radio" id="tab3" name="tab" value="driver">
                    <label for="tab3" class="mr-3"> Driving license</label>
                </div>

                @if(isset($noti))
                <div class="alert alert-danger text-center">
                    {{$noti}}
                </div>
                @endif

                <article>
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6 col-dt-12">
                                    <img src="/public/sites/images/icon-id-front.svg" class="img-fluid" alt="">
                                </div>
                                <div class="col-6 col-dt-12 custom">
                                    <span class="h3">Front side</span> <br>
                                    <input type="file" id="actual-btn" name="front" hidden />
                                    <!-- our custom upload button -->
                                    <label for="actual-btn">Upload</label>
                                    <br>
                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>
                                </div>
                                @error('front')
                                <div class="error-upload-front">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6 col-dt-12">
                                    <img src="{{asset('/public/sites/images/icon-id-front.svg')}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-6 col-dt-12 custom">
                                    <span class="h3">Back side</span> <br>
                                    <input type="file" id="actual-btns" name="behind" hidden />

                                    <!-- our custom upload button -->
                                    <label for="actual-btns"> Upload </label>
                                    <br>
                                    <!-- name of file chosen -->
                                    <span id="file-chosens">No file chosen</span>
                                </div>
            @error('behind')
                            <div class="error-upload-front">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-5">
                                <div class="mb-3 h3"><b>* Entry standards</b></div>
                                <div class="px-3" style="color: #a0a0a0;font-size: 15px;">
                                    <span>- The input image must have all four clear corners or the main parts of an Passport card</span> <br>
                                    <span>- The information fields on the card must be clear</span> <br>
                                    <span>- Input image should not exceed 5Mb and minimum resolution is 640x480</span> <br>
                                    <span>- The card area ratio must occupy at least 1/4 of the total image area</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="row mt-4">
                                <div class="col-6">
                                    <img src="/public/sites/images/icon-passport-front.svg" class="img-fluid" alt="">
                                </div>
                                <div class="col-6 custom">
                                    <span class="h3">Front side</span> <br>
                                    <input type="file" id="actual-btn-p" hidden name="passport" />
                                    <!-- our custom upload button -->
                                    <label for="actual-btn-p">Upload</label>
                                    <!-- name of file chosen -->
                                    <span id="file-chosen-p">No file chosen</span>
                                </div>
              @error('passport')
                                <div class="error-upload-front">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-12">
                            <div class="p-5">
                                <div class="mb-3 h3"><b>* Entry standards</b></div>
                                <div class="px-3" style="color: #a0a0a0;font-size: 15px;">
                                    <span>- The input image must have all four clear corners or the main parts of an Passport card</span> <br>
                                    <span>- The information fields on the card must be clear</span> <br>
                                    <span>- Input image should not exceed 5Mb and minimum resolution is 640x480</span> <br>
                                    <span>- The card area ratio must occupy at least 1/4 of the total image area</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <img src="/public/sites/images/icon-drivers-license-front.svg" class="img-fluid" alt="">
                                </div>
                                <div class="col-6 custom">
                                    <span class="h3">Front side</span> <br>
                                    <input type="file" id="actual-btn-3" name="driver_front" hidden />
                                    <!-- our custom upload button -->
                                    <label for="actual-btn-3">Upload</label>
                                    <!-- name of file chosen -->
                                    <span id="file-chosen-3">No file chosen</span>
                                </div>
             @error('driver_front')
                                <div class="error-upload-front">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <img src="/public/sites/images/icon-id-front.svg" class="img-fluid" alt="">
                                </div>
                                <div class="col-6 custom">
                                    <span class="h3">Back side</span> <br>
                                    <input type="file" id="actual-btn-4" name="driver_behind" hidden />

                                    <!-- our custom upload button -->
                                    <label for="actual-btn-4"> Upload </label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen-4">No file chosen</span>
                                </div>
                                @error('driver_behind')
                                <div class="error-upload-front">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-5">
                                <div class="mb-3 h3"><b>* Entry standards</b></div>
                                <div class="px-3" style="color: #a0a0a0;font-size: 15px;">
                                    <span>- The input image must have all four clear corners or the main parts of an Passport card</span> <br>
                                    <span>- The information fields on the card must be clear</span> <br>
                                    <span>- Input image should not exceed 5Mb and minimum resolution is 640x480</span> <br>
                                    <span>- The card area ratio must occupy at least 1/4 of the total image area</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="pre-next">
                    <button type="submit" class="btn-pre" name="pre" value="0">Previous</button>
                    <button type="submit" class="btn-next" name="next" value="1">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection