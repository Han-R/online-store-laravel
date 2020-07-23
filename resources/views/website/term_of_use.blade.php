@extends('layouts.websiteLayout')
@section('head')
	<title>{{__('website.terms')}} </title>
@endsection

@section('body')


	<!--Start overview tabs-->
        
          <section id="termUse">
            <div class="container">
                <div class="terms">
                    <h3>{{__('website.terms')}}</h3>
                    <p>{!! $terms_use->description  !!}</p>
                </div>
            </div>
          </section>

@endsection

@section('script')

@endsection