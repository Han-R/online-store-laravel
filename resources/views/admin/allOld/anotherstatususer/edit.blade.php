@extends('layout.app')
@section('title') {{ucwords(__('bunch.driver_edit'))}}
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
                              style="color: #e02222 !important;">{{__('bunch.driver_edit')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/anotherstatus_user/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}

                        <div class="form-body">

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.name')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"  value="{{ $item->name }}"
                                               placeholder=" {{__('common.name')}}" {{ old('name') }} required>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.email')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="email" value="{{ $item->email }}"
                                               placeholder=" {{__('common.email')}}" {{ old('email') }} required>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.mobile')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="mobile" value="{{ $item->mobile }}"
                                               placeholder=" {{__('common.mobile')}}" {{ old('mobile') }} required>
                                    </div>
                                </div>
                            </fieldset>


                             <div class="form-group">
                                    <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.department')}}
                                    <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select id="multiple" class="form-control select2-multiple" multiple name="category[]" >
                                            @foreach($categories as $cat)
                                               <option value="{{$cat->id}}"
                                                @foreach($departments as $dep)
                                                @if($dep->category_id == $cat->id) selected @endif
                                                @endforeach

                                                > {{$cat->title}}</option>
                                            @endforeach   
                                        </select>
                                    </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.verfication')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="verification" required  id="category_id">
                                        <option value="" > {{__('common.select')}}</option>
                                        
                                            <option value="0"  @if($item->verification == 0 || $item->verification == 5) selected @endif >
                                                {{__('common.unverfied')}}
                                            </option>

                                            <option value="1"  @if($item->verification == 1) selected @endif >
                                                {{__('common.verfied')}}
                                            </option>

<option value="2"  @if($item->verification == 2) selected @endif >
                                                {{__('common.frozen')}}
                                            </option>


<option value="3"  @if($item->verification == 3) selected @endif >
                                                {{__('common.Prohibited')}}
                                            </option>
                                        

                                    </select>
                                </div>
                            </div>





                            <fieldset>
                                <legend>{{__('common.image')}}</legend>
                                <div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('profile_image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile_image') }}</strong>
                                            </span>
                                        @endif
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src=" {{isset($item) && $item->profile_image ? url($item->profile_image)  : url(admin_assets('/images/ChoosePhoto.png'))}}"  id="editImage">
                                        </div>
                                        <label class="control-label">{{__('common.image')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('common.edit_image').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_image')}}
                                        </div>
                                        <input type="file" class="form-control" name="profile_image"
                                               id="edit_image"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>



                            <div class="modal-body">
                                <fieldset>
                                    {{--<legend>{{"Event Coordinates"}}</legend>--}}
                                    <input id="searchInput" class="input-controls" type="text"
                                           placeholder="{{__('common.enter_location')}}">
                                    <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                    <div class="form_area">
                                        <input type="hidden" required name="location" id="location" value="{{$item->location}}">
                                        <input type="hidden" required name="lat" id="lat" value="{{$item->lat}}">
                                        <input type="hidden" required name="lan" id="lng" value="{{$item->lan}}">
                                    </div>

                                </fieldset>
                            </div>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/anotherstatus_user')}}" class="btn default">{{__('common.cancel')}}</a>
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

<script>
  $(".select2-search__field").attr("placeholder", "");


</script>
@section('js')

$(document).ready(function(){ 
  $(".select2-search__field").attr("placeholder", "");

});

@endsection
@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });




        /* script Map */
        function initialize() {
            var latlng = new google.maps.LatLng('{{$item->lat}}', '{{$item->lan}}');
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
