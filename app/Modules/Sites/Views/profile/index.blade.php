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
                    <div class="inner-circle active"></div>
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

            <form action="{{route('kyc.postprofile')}}" method="post">
                @csrf
                <div class="form-group mt-4">
                    <input type="radio" name="gender" value="male" required> <span class="mr-3" required>Male</span>
                    <input type="radio" name="gender" value="female"> <span>Female</span>
                </div>
                <div class="d-flex w-100 mt-5">
                    <div class="form-group w-50 mr-2">
                        <input type="text" name="first_name" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="text" name="last_name" class="form-control" placeholder="Last name" required>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="form-group w-50 mr-2">
                        <input type="date" name="date" class="form-control" id="book_off_date" placeholder="Date" required>
                    </div>
                    <div class="form-group w-50 ml-2">
                        <input type="email" name="email" class="form-control" value="<?= session()->get('email') ?>"
                               required placeholder="Email" readonly>
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