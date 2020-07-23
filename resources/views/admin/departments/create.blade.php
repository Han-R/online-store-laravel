@extends('layouts.cp')
@section('title') {{ucwords(__('cp.new_department'))}}
@endsection
@section('css')
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
                              style="color: #e02222 !important;">{{__('cp.new_department')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/departments')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">
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
                                                   value="{{ old('name_'.$locale->lang) }}" required>
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
                                        <div class="col-md-6">
                                            <textarea rows="5" class="form-control" name="details_{{$locale->lang}}"
                                                   placeholder=" {{__('common.details_'.$locale->lang)}}"
                                                   id="details_{{$locale->lang}}"
                                                       required>{{ old('details_'.$locale->lang) }}</textarea>
                                        </div>
                                    </div>

                                @endforeach
                            </fieldset>



                            <fieldset>
                                <legend>{{__('common.icon')}}</legend>
                                <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                                    <div class="col-md-6 col-md-offset-3">
                                        @if ($errors->has('icon'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('icon') }}</strong>
                                            </span>
                                        @endif
                                        <div class="fileinput-new thumbnail"
                                             onclick="document.getElementById('edit_image').click()"
                                             style="cursor:pointer">
                                            <img src="{{url('images/ChoosePhoto.png')}}" id="editImage">
                                        </div>
                                        <label class="control-label">{{__('common.icon')}}</label>
                                        <div class="btn red"
                                             onclick="document.getElementById('edit_image').click()">
                                            <i class="fa fa-pencil"></i>{{__('common.change_icon')}}
                                        </div>
                                        <input type="file" class="form-control" name="icon"
                                               id="edit_image"
                                               style="display:none">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/category')}}" class="btn default">{{__('common.cancel')}}</a>
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
    </script>
@endsection
