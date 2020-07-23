@extends('layout.app')
@section('title') {{ucwords(__('common.land'))}}
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
                              style="color: #e02222 !important;">{{__('common.add')}}{{__('common.land')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/land_page')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">


                          

                            @foreach($locales as $locale)
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.name_'.$locale->lang)}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_{{$locale->lang}}" value="" id="order"
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
                                    </label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="description_{{$locale->lang}}" value=""
                                               placeholder=" {{__('common.description_'.$locale->lang)}}" {{ old('description_'.$locale->lang) }}></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            @endforeach


                          







                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/land_page')}}" class="btn default">{{__('common.cancel')}}</a>
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
    </script>
@endsection
