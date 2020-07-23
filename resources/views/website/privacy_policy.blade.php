@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.privacy')}} </title>
@endsection

@section('body')


    <!--Start overview tabs-->

    <section id="termUse">
        <div class="container">
            <div class="terms">
                <h3>{{__('website.privacy')}}</h3>
                <p>{!! $privacy_policy->description  !!}</p>
            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection