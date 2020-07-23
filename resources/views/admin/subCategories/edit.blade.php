@extends('layouts.cp')
@section('title') {{ucwords(__('cp.edit_subcategory'))}}
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
                              style="color: #e02222 !important;">{{__('cp.edit_subcategory')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/subCategory/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">

                            <fieldset>
                                <legend>{{__('cp.choose_department')}}</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="parent_id">
                                        {{__('cp.choose_department')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="department_id" required  id="department_id">
                                            <option value="" > {{__('common.select')}}</option>
                                            @foreach($departments as $one)
                                                <option value="{{$one->id}}" {{ (old('department_id',$item->department_id) == $one->id) ? "selected":"" }}>
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
                                    <label class="col-sm-2 control-label" for="parent_id">
                                        {{__('cp.choose_main_category')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="parent_id" required  id="parent_id">
                                            <option value="" > {{__('common.select')}}</option>
                                            @foreach($categories as $one)
                                                <option value="{{$one->id}}" {{ ($item->parent_id == $one->id) ? "selected":"" }}>
                                                    {{$one->name}}
                                                </option>
                                            @endforeach

                                        </select>
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
                                                   id="name_{{$locale->name}}"
                                                   value="{{ old('name_'.$locale->lang, $item->translate($locale->lang)->name)}}" required>
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
                                                      required>{{ old('details_'.$locale->lang, $item->translate($locale->lang)->details) }}</textarea>
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
                                            <img src="{{ isset($item) && $item->icon ? url($item->icon) :  url('/images/ChoosePhoto.png')}}" id="editImage">
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
                                        <a href="{{url(getLocal().'/admin/subCategories')}}" class="btn default">{{__('common.cancel')}}</a>
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

    </script>
@endsection
