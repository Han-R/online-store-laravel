@extends('layout.app')
@section('title') {{ucwords(__('common.edit'))}} {{ucwords(__('setting.setting'))}}
@endsection
@section('css')
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjOp2BjQx-ruFkTnb4mB_2m3eFtcCyPbU&sensor=false&libraries=places"></script>
    <style type="text/css">
        .input-controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }
    </style>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase"
                              style="color: #e02222 !important;">{{__('common.edit')}}{{__('setting.setting')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/settings')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">



                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.title_'.$locale->lang)}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="title_{{$locale->lang}}" value="{{$item->translate($locale->lang)->title}}" id="order"
                                                   placeholder=" {{__('common.title_'.$locale->lang)}}" {{ old('title_'.$locale->lang) }}>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach


                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.key_words_'.$locale->lang)}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="key_words_{{$locale->lang}}" value="{{$item->translate($locale->lang)->key_words}}" id="order"
                                                   placeholder=" {{__('common.key_words_'.$locale->lang)}}" {{ old('key_words_'.$locale->lang) }}>
                                        </div>
                                    </div>
                                </fieldset>
                             @endforeach


                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.address_'.$locale->lang)}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="address_{{$locale->lang}}" value="{{$item->translate($locale->lang)->address}}" id="order"
                                                   placeholder=" {{__('common.address_'.$locale->lang)}}" {{ old('address_'.$locale->lang) }}>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach


                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.description_'.$locale->lang)}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="description_{{$locale->lang}}" value="{{$item->translate($locale->lang)->description}}" id="order"
                                                   placeholder=" {{__('common.description_'.$locale->lang)}}" {{ old('description_'.$locale->lang) }}>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.Url')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" name="url" value="{{$item->url}}" id="order"
                                               placeholder="  {{__('common.url')}}" {{ old('url') }}>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group hidden">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.admin_email')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="admin_email" value="{{$item->admin_email}}" id="order"
                                               placeholder="  {{__('common.admin_email')}}" {{ old('admin_email') }}>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.info_email')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="info_email" value="{{$item->info_email}}" id="order"
                                               placeholder="  {{__('common.info_email')}}" {{ old('info_email') }}>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.app_store_url')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" name="app_store_url" value="{{$item->app_store_url}}" id="order"
                                               placeholder="  {{__('common.app_store_url')}}" {{ old('app_store_url') }}>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.play_store_url')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" name="play_store_url" value="{{$item->play_store_url}}" id="order"
                                               placeholder="  {{__('common.play_store_url')}}" {{ old('play_store_url') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.mobile')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="mobile" value="{{$item->mobile}}" id="order"
                                               placeholder="  {{__('common.mobile')}}" {{ old('mobile') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.phone')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="phone" value="{{$item->phone}}" id="order"
                                               placeholder="  {{__('common.phone')}}" {{ old('phone') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.facebook')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="facebook" value="{{$item->facebook}}" id="order"
                                               placeholder="  {{__('common.facebook')}}" {{ old('facebook') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.twitter')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="twitter" value="{{$item->twitter}}" id="order"
                                               placeholder="  {{__('common.twitter')}}" {{ old('twitter') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.instagram')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="instagram" value="{{$item->instagram}}" id="order"
                                               placeholder="  {{__('common.instagram')}}" {{ old('instagram') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.linked_in')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="linked_in" value="{{$item->linked_in}}" id="order"
                                               placeholder="  {{__('common.linked_in')}}" {{ old('linked_in') }}>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.google_plus')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="google_plus" value="{{$item->google_plus}}" id="order"
                                               placeholder="  {{__('common.google_plus')}}" {{ old('google_plus') }}>
                                    </div>
                                </div>
                            </fieldset>
                           
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.paginate')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="paginate" value="{{$item->paginate}}" id="order"
                                               placeholder="  {{__('common.paginate')}}" {{ old('paginate') }}>
                                    </div>
                                </div>
                            </fieldset>


                        <fieldset>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="distance">
                                        {{__('common.distance')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="distance" value="{{$item->distance}}" id="order"
                                               placeholder="  {{__('common.distance')}}" {{ old('distance') }}>
                                    </div>
                                </div>
                            </fieldset>



                             <fieldset>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="distance">
                                        {{__('common.subscribe')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="subscribe" value="{{$item->subscribe}}" id="subscribe"
                                               placeholder="  {{__('common.subscribe')}}" {{ old('subscribe') }}>
                                    </div>
                                </div>
                            </fieldset>
                            
                            
                            <!--<fieldset>-->
                            <!--    <div class="form-group">-->
                            <!--        <label class="col-sm-2 control-label" for="order">-->
                            <!--            {{__('common.vedio')}}-->
                            <!--        </label>-->
                            <!--        <div class="col-md-6">-->
                            <!--            <input type="text" class="form-control" name="vedio" value="{{$item->vedio}}" id="order"-->
                            <!--                   placeholder="  {{__('common.vedio')}}" {{ old('vedio') }}>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</fieldset>-->
                            
                            
                            
                              @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.how_it_work_'.$locale->lang)}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="how_it_work_{{$locale->lang}}" value="{{$item->translate($locale->lang)->how_it_work}}" id="order"
                                                   placeholder=" {{__('common.how_it_work_'.$locale->lang)}}" {{ old('how_it_work_'.$locale->lang) }}>
                                        </div>
                                    </div>
                                </fieldset>
                             @endforeach



                            <fieldset>
                                <legend>{{__('common.logo')}}</legend>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_logo').click()"
                                             style="cursor:pointer">
                                            <img src="{{url($item->logo)}}" id="editlogo">
                                        </div>
                                        <label class="control-label">{{__('common.logo')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_logo').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_image')}}
                                        </div>
                                        <input type="file" class="form-control" name="logo"
                                               id="edit_logo"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset>
                                <legend>{{__('common.image')}}</legend>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src="{{url($item->image)}}" id="editImage">
                                        </div>
                                        <label class="control-label">{{__('common.image')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_image').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_image')}}
                                        </div>
                                        <input type="file" class="form-control" name="image"
                                               id="edit_image"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset>
                                <legend>{{__('common.imageForEmail')}}</legend>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_imageForEmail').click()"
                                             style="cursor:pointer">
                                            <img src="{{url('uploads/settings/'.$item->imageForEmail)}}" id="editImageForEmail">
                                        </div>
                                        <label class="control-label">{{__('common.imageForEmail')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_imageForEmail').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_image')}}
                                        </div>
                                        <input type="file" class="form-control" name="imageForEmail"
                                               id="edit_imageForEmail"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset>
                                <legend>{{""}}</legend>
                                <input id="searchInput" class="input-controls" type="text"
                                       placeholder="Enter a location">
                                <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                <div class="form_area">
                                    <input type="hidden" disabled value="{{$setting->location}}" name="address" id="location">
                                    <input type="hidden" value="{{$setting->latitude}}" name="latitude" id="lat">
                                    <input type="hidden" value="{{$setting->longitude}}" name="longitude" id="lng">
                                </div>

                            </fieldset>












                                <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/home')}}" class="btn default">{{__('common.cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });


        $('#edit_logo').on('change', function (e) {
            readURL(this, $('#editlogo'));
        });

        $('#edit_imageForEmail').on('change', function (e) {
            readURL(this, $('#editImageForEmail'));
        });

        function format(){
            var e = document.getElementById("type");
            var type = e.options[e.selectedIndex].value;
            //alert(type);

            if(type == 2){

                $('#park').removeClass('hidden');
                $('#edu').prop('required',true);
            }

            if(type == 1){
                $('#park').addClass('hidden');
                $('#edu').prop('required',false);
            }

        }



        /* script */
        function initialize() {
            var latlng = new google.maps.LatLng('{{$setting->latitude}}', '{{$setting->longitude}}');
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 10
            });
            var marker = new google.maps.Marker({
                map: map,
                position: latlng,
                draggable: true,
                anchorPoint: new google.maps.Point(0, -29)
            });
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var geocoder = new google.maps.Geocoder();
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location.lng());
                infowindow.setContent(place.formatted_address);
                infowindow.open(map, marker);

            });
            // this function will work on marker move event into map
            google.maps.event.addListener(marker, 'dragend', function () {
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });
        }

        function bindDataToForm(address, lat, lng) {
            document.getElementById('location').value = address;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
//                                                console.log('location = ' + address);
//                                                console.log('lat = ' + lat);
//                                                console.log('lng = ' + lng);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
