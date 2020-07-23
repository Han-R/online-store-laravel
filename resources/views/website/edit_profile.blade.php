@extends('layouts.websiteLayout')
@section('head')
	<title>{{__('website.editprofile')}} </title>
@endsection

@section('body')
        <!--Start profile-->
        
        <section id="profile">
            <div class="container">
                <form class="allInfo" method="post" enctype="multipart/form-data" action="{{route('user.update')}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                    <div class="personalInfo">
                        <div class="personlName">
                            <h3>{{__('website.GeneralInformation')}}</h3>
                        </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="personalForm">

                                <div class="detailsInfo">
                                    <div class="firstInput">
                                        <label for="Name">{{__('website.name')}}</label>
                                        <input type="text" id="" name="name" value="{{$user->name}}" placeholder="{{__('website.name')}}">
                                    </div>
                                </div>
                                <div class="detailsInfo">
                                     <div class="firstInput">
                                        <label for="email">{{__('website.email')}}</label>
                                        <input type="text" id="" name="email" value="{{$user->email}}" placeholder="{{__('website.email')}}">
                                    </div>
                                    <div class="firstInput">
                                        <label for="lastName">{{__('website.mobile')}}</label>
                                        <input type="number" id="" name="mobile" value="{{$user->mobile}}" placeholder="{{__('website.mobile')}}">
                                    </div>
                                </div>
                                <div class="detailsInfo">
                                    <div class="firstInput">
                                        <label for="firstName">{{__('website.address')}}</label>
                                        <input type="text" id="" name="address" value="{{$user->address}}" placeholder="{{__('website.mobile')}}">
                                    </div>
                                </div>

                            </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><i class="fas fa-pencil-alt"></i></label>
                                        </div>
                                            <img class="avatar-preview" src="{{$user->avatar}}" id="imagePreview">
                                    </div>
                                </div>
                            </div>
                          <div class="saveInfo"><button type="submit" class="btn save">{{__('website.save')}}</button></div>
                    </div>
                   
                  
                </form>
            </div>
        </section>
        
         <!--end profile-->
@endsection

@section('script')

@endsection