@extends('layouts.websiteLayout')
@section('head')
	<title>{{__('website.about_us')}}</title>
@endsection

@section('body')
        <!--Start About Us-->
        
        <section id="aboutUs">
            <div class="container">
                <div clas="row">
                    <div class="col-md-6">
                        <div class="aboutInfo">
                            <h1>{{__('website.about_us')}}</h1>
                            <p>{!! $about->description  !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aboutImg">
                            <img src="{{asset('website/images/aboutus.svg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
         <!--end ِAbout us-->

@endsection

@section('script')

@endsection