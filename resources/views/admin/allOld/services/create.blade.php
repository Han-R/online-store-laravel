@extends('layout.app')
@section('title') {{ucwords(__('bunch.services'))}}
@endsection
@section('css_file_upload')
    <link href="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('css')
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
                              style="color: #e02222 !important;">{{__("bunch.service")}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/services')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('bunch.service_provider')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="company_id" required  id="category_id">
                                        <option value="" > {{__('common.select')}}</option>
                                        @foreach($companies as $com)
                                            <option value="{{$com->id}}" {{ (old("company_id") == $com->id ? "selected":"") }}>
                                                {{$com->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            @foreach($locales as $locale)
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.name_'.$locale->lang)}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_{{$locale->lang}}" value="{{ old('name_'.$locale->lang) }}" id="order"
                                               placeholder=" {{__('common.name_'.$locale->lang)}}" {{ old('name_'.$locale->lang) }}>
                                    </div>
                                </div>
                            </fieldset>
                            @endforeach

                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.description_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="description_{{$locale->lang}}" value="{{ old('description_'.$locale->lang) }}" id="order"
                                                   placeholder=" {{__('common.description_'.$locale->lang)}}" {{ old('description_'.$locale->lang) }}>{{ old('description_'.$locale->lang) }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach

                          


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.price')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                                               placeholder=" {{__('common.price')}}" {{ old('_price') }}>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <legend>{{__('common.logo')}}</legend>
                                <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                        @endif
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src="{{url(admin_assets('/images/ChoosePhoto.png'))}}" id="editImage">
                                        </div>
                                        <label class="control-label">{{__('common.logo')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_image').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_image')}}
                                        </div>
                                        <input type="file" class="form-control" name="logo"
                                               id="edit_image"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>


                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('common.images')}}  {{__('common.upload')}} </label>
                                <div class="col-md-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> {{__('common.select')}}  {{__('common.file')}}  </span>
                                                                <span class="fileinput-exists"> {{__('common.change')}}  </span>
                                                                <input type="hidden"><input type="file" name="attatchments[]" multiple> </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> {{__('common.remove')}}  </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}} </button>
                                        <a href="{{url(getLocal().'/admin/services')}}" class="btn default">{{__('common.cancel')}} </a>
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
@section('js_file_upload')
    <script src="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

@endsection
@section('js')



    <script src="{{admin_assets('/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
    <script src="{{admin_assets('/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>


@endsection
@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $('#edit_file').on('change', function (e) {
            readURL(this, $('#edit_file'));
        });

       


    </script>
@endsection
