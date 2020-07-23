@extends('layout.app')
@section('title') {{ucwords(__('ads.title'))}}
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
                              style="color: #e02222 !important;">{{__('common.edit')}}{{__('ads.ads')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/ads/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="form-body">


                            @foreach($locales as $locale)
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.description_'.$locale->lang)}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="descriptions_{{$locale->lang}}" id="order"
                                                      placeholder=" {{__('common.descriptions_'.$locale->lang)}}" {{ old('descriptions_'.$locale->lang) }}>{{$item->translate($locale->lang)->descriptions}}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach

 <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.order')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="order" value="{{$item->order_by}}" id="order"
                                               placeholder=" {{__('common.order')}}" {{ old('order') }}>
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
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/ads')}}" class="btn default">{{__('common.cancel')}}</a>
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
