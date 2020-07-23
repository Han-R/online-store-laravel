@extends('layouts.cp')
@section('title') {{ucwords(__('cp.edit_product'))}}
@endsection
@section('css_file_upload')
    <link href="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('css')

    <link href="{{admin_assets('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{admin_assets('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css"/>
        
        
    <link href="{{admin_assets('/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{admin_assets('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{admin_assets('/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{admin_assets('/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{admin_assets('/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{admin_assets('/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css"/>

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
                              style="color: #e02222 !important;">{{ucwords(__('cp.edit_product'))}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/product/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}


                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('common.barCode')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="barCode" value="{{ old('barCode',$item->barCode) }}"
                                           placeholder=" {{__('common.barCode')}}">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{__('common.name')}}</legend>
                            @foreach($locales as $locale)
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="name_{{$locale->lang}}">
                                        {{__('common.name_'.$locale->lang)}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_{{$locale->lang}}"
                                               placeholder="{{__('common.name_'.$locale->lang)}}"
                                               id="name_{{$locale->lang}}"
                                               value="{{ old('name_'.$locale->lang,$item->translate($locale->lang)->name) }}" required>
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>

                        <fieldset>
                            <legend>{{__('common.details')}}</legend>
                            @foreach($locales as $locale)
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="details_{{$locale->lang}}">
                                        {{__('common.details_'.$locale->lang)}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-8">
                                            <textarea rows="5" class="form-control ckeditor" name="details_{{$locale->lang}}"
                                                      placeholder=" {{__('common.details_'.$locale->lang)}}"
                                                      id="details_{{$locale->lang}}"
                                                      required>{{ old('details_'.$locale->lang,$item->translate($locale->lang)->details) }}</textarea>
                                    </div>
                                </div>

                            @endforeach
                        </fieldset>

                        <fieldset>
                            <legend>{{__('cp.choose_department')}}</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="department_id">
                                    {{__('cp.choose_department')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2 js-example-rtl" name="department_id" required  id="department_id">
                                        <option value="" > {{__('common.select')}}</option>
                                        @foreach($departments as $one)
                                            <option value="{{$one->id}}" {{ (old("category_id",$item->department_id) == $one->id) ? "selected":"" }}>
                                                {{$one->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </fieldset>

                        <fieldset>
                            <legend>{{__('cp.choose_main_category')}}</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('cp.choose_main_category')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2 js-example-rtl" name="category_id" required  id="category_id">
                                        <option value="" > {{__('common.select')}}</option>
                                        @foreach($categories as $one)
                                            <option value="{{$one->id}}" {{ (old("category_id",$item->category_id) == $one->id) ? "selected":"" }}>
                                                {{$one->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="sub_category_id">
                                    {{__('cp.choose_subcategory')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="sub_category_id" required  id="sub_category_id">
                                        <option value="" > {{__('common.select')}}</option>
                                        @foreach($subCategories as $one)
                                            <option value="{{$one->id}}" {{ (old("sub_category_id",$item->sub_category_id) == $one->id) ? "selected":"" }}>
                                                {{$one->name}}
                                            </option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{__('common.general_information')}}</legend>

                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('common.price')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price" value="{{ old('price',$item->price) }}"
                                           placeholder=" {{__('common.price')}}" >
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('common.discount')}} %
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="discount" value="{{ old('discount',$item->discount) }}"
                                           placeholder=" {{__('common.discount')}}"/>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{__('common.delivery_time')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="delivery_time" value="{{ old('delivery_time',$item->delivery_time) }}"
                                           placeholder="  {{__('common.delivery_time')}}" >
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="status">
                                    {{__('common.status')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="status" required>
                                        <option value="active" @if(old('status',$item->status)=='active') selected @endif>{{__('common.active')}}</option>
                                        <option value="not_active" @if(old('status',$item->status)=='not_active') selected @endif> {{__('common.not_active')}}</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="recommended" value="0" />
                                    <input  {{ $item->recommended?"checked":"" }} type="checkbox" value="1" name="recommended" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{__('common.recommended')}}</label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="best" value="0" />
                                    <input  {{ $item->best?"checked":"" }} type="checkbox" value="1" name="best" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">{{__('common.best')}}</label>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <legend>{{__('cp.imagesOfProduct')}}</legend>
                            <div class="form-group">
                                <div class="row text-center">
                                    <div class="col-sm-6 col-md-offset-3">
                                        <label class="control-label">{{__('cp.imagesOfProduct')}}</label>
                                        <div id="result" style="display: block"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-offset-3">
                                        <div style="display: block">

                                            <div class="btn red" onclick="document.getElementById('files').click()">
                                                <i class="fa fa-pencil"></i>{{__('common.BrowseIamges')}}
                                            </div>
                                            <input id="files" name="images[]" type="file" multiple style="display:none"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            @foreach($item->images as $attatchment)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="dashboard-stat2 ">
                                        <li id="material-{{$attatchment->id}}" style="list-style: none; border-style: outset;">
                                            <a href="#myModal{{$attatchment->id}}" role="button"  data-toggle="modal"><button class="btn btn-outline btn-circle red btn-sm black" data-id="{{$attatchment->id}}"  >
                                                    <span class="glyphicon glyphicon-trash"></span> {{__('common.delete')}}
                                                </button></a>
                                            {{--<a href="#"--}}
                                            {{--onclick="delete_attatchment('{{$attatchment->id}}','{{$item->id}}',event)" class="btn btn-xs red tooltips">--}}
                                            {{--&nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>--}}
                                            {{--</a>--}}
                                            <a href="{{url($attatchment->name)}}" target="_blank" >
                                                <img src="{{$attatchment->name}}" height="200" class="img-responsive pic-bordered" />
                                            </a>

                                        </li>
                                    </div>
                                </div>
                                <div id="myModal{{$attatchment->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">{{__('common.delete')}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{__('common.confirm')}} </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('common.cancel')}}</button>
                                                <a  onclick="delete_attatchment('{{$attatchment->id}}','{{$item->id}}',event)"><button class="btn btn-danger">{{__('common.submit')}}</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                    <a href="{{url(getLocal().'/admin/products')}}" class="btn default">{{__('common.cancel')}}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    



@endsection
@section('js_file_upload')
    <script src="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

@endsection
@section('js')


    
    <script src="{{admin_assets('/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>
    


    <script src="{{admin_assets('/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>


@endsection
@section('script')
    <style>
        .thumbnail_flicer{
            margin: 10px;
        }
        .thumbnail_flicer1{
            height: 100px;
            width: 100px;
        }
    </style>
    <script>
        $(document).on('change','#department_id', function(e){
            var id = $(this).val();
            var url = '{{url(getLocal()."/admin/getCategories")}}/'+id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'GET',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#category_id').html("");
                        for(var i = 0 ;  response.categories.length >i; i++){
                            $('#category_id').append('<option value="'+response.categories[i]['id']+'" >'+response.categories[i]['name']+'</option>');
                        }
                    } else {
                    }
                },
                error: function (e) {
                }
            });
        });

        $(document).on('change','#category_id', function(e){
            var id = $(this).val();
            var url = '{{url(getLocal()."/admin/getSubCategories")}}/'+id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'GET',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#sub_category_id').html("");
                        for(var i = 0 ;  response.categories.length >i; i++){
                            $('#sub_category_id').append('<option value="'+response.categories[i]['id']+'" >'+response.categories[i]['name']+'</option>');
                        }
                    } else {
                    }
                },
                error: function (e) {
                }
            });
        });


        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $('#edit_file').on('change', function (e) {
            readURL(this, $('#edit_file'));
        });

     


        function delete_attatchment(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(app()->getLocale()."/admin/delete_attatchment/")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method:'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#material-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                    } else {
                    }
                },
                error: function (e) {
                }
            });

        }


        window.onload = function(){
            //Check File API support
            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("files");
                filesInput.addEventListener("change", function(event){
                    var files = event.target.files; //FileList object
                    var output = document.getElementById("result");
                    output.innerHTML = "";
                    for(var i = 0; i< files.length; i++)
                    {
                        var file = files[i];
                        //Only pics
                        if(!file.type.match('image'))
                            continue;
                        var picReader = new FileReader();
                        picReader.addEventListener("load",function(event){
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.classList.add("col-md-3");
                            div.classList.add("thumbnail_flicer");
                            div.innerHTML = "<img  class='thumbnail_flicer1' src='" + picFile.result + "'" +
                                "title='" + picFile.name + "'/>";
                            output.insertBefore(div,null);
                        });
                        //Read the image
                        picReader.readAsDataURL(file);
                    }

                });
            }
            else
            {
                console.log("Your browser does not support File API");
            }
        }


    </script>
@endsection
