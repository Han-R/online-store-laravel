@extends('layouts.websiteLayout')
@section('head')
	<title>{{__('website.empty_cart')}}</title>
@endsection

@section('body')
	
        <!--start shopping empty -->
        
        <section id="startShopping">
            <div class="container">
                <div class="row">
                    <div class="emptyCart">
                        <img src="{{asset('website/images/Group%20191.svg')}}">
                        <h3>{{__('website.emptyCart')}}</h3>
                        <a href="{{url('/')}}"><button class="btn startShop">{{__('website.startShopping')}}</button></a>
                    </div>
                </div>
            </div>
        </section>
      
        <!--End Shopping empty-->
@endsection

@section('script')

@endsection