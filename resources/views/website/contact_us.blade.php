@extends('layouts.websiteLayout')
@section('head')
	<title>{{__('website.contact')}} </title>
@endsection

@section('body')
        <!--Start Contact us-->
        
        <section id="contactUs">
            <div class="container">
                <div class="contact">
                    <div class="form">
                        <h3>{{__('website.contact')}}</h3>
                        <p>{{__('website.FillTheFormBelowAndWeWillGetYouBack')}}</p>
                        <form class="form_contact clearfix" method="post" action="{{url(app()->getLocale().'/contact')}}">
                            {{ csrf_field() }}
                            <div class="inputForm">
                                 <input type="text" name="name" value="{{ old('name') }}" placeholder="{{__('website.name')}}">
                                 <input type="text" name="email" value="{{ old('email') }}" placeholder="{{__('website.email')}}">
                                 <input type="text" name="subject" value="{{ old('subject') }}" placeholder="{{__('website.subject')}}">
                                <input type="number"name="mobile" value="{{ old('mobile') }}"  placeholder="{{__('website.mobile')}}">
                                <textarea name="message" value="{{ old('message') }}" placeholder="{{__('website.yourMessage')}}"></textarea>
                            </div>
                            <button class="send" type="submit"><i class="far fa-paper-plane"></i></button>
                        </form>
                    </div>
                    
                    <div class="imgContact">
                        <img src="{{asset('website/images/Group%20959.svg')}}">
                    </div>
                </div>
            </div>
        </section>
        
         <!--end Contact us-->
@endsection

@section('script')

@endsection