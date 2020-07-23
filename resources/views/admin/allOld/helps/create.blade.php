@extends('layout.app')
@section('title') {{ucwords(__('common.FAQS'))}}
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
                              style="color: #e02222 !important;">{{__('common.add')}}{{__('common.FAQS')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/helps')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            
                            
                            
                              @foreach($locales as $locale)
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.question_'.$locale->lang)}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="question_{{$locale->lang}}" value="{{ old('question_'.$locale->lang) }}" id="order"
                                               placeholder=" {{__('common.question_'.$locale->lang)}}" {{ old('question_'.$locale->lang) }}>
                                    </div>
                                </div>
                            </fieldset>
                            @endforeach
                            
                            
                              @foreach($locales as $locale)
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.answer_'.$locale->lang)}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea type="text" class="form-control" name="answer_{{$locale->lang}}"  id="order"
                                               placeholder=" {{__('common.answer_'.$locale->lang)}}" >{{ old('answer_'.$locale->lang) }}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            @endforeach



                          




                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/helps')}}" class="btn default">{{__('common.cancel')}}</a>
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
