@extends('layout.app')
@section('title') {{ucwords(__('siderbar.notification_messages'))}}
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
                              style="color: #e02222 !important;">{{__('common.add')}}{{__('common.notification')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/message_notifications')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="form-body">



                             <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.select_group')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control select2" name="type"
                                             onchange="format();">
                                                                                    
                                               <option value="2" >  {{__('common.all')}} </option>
                                               <option value="0" >  {{__('common.customers')}} </option>
                                               <option value="1" >  {{__('common.technical')}} </option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group hidden" id="department">
                                    <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.department')}}
                                    <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select id="multiple" class="form-control select2-multiple" multiple name="category[]" >
                                            @foreach($categories as $cat)
                                               <option value="{{$cat->id}}" > {{$cat->title}}</option>
                                            @endforeach   
                                        </select>
                                    </div>
                            </div> 

                        
                            
                            
                            
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.message')}}
                                    </label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="message" value=""
                                               placeholder=" {{__('common.message')}}" {{ old('message') }}></textarea>
                                    </div>
                                </div>
                            </fieldset>
                            


                          







                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/message_notifications')}}" class="btn default">{{__('common.cancel')}}</a>
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

            if(type == 1){

                $('#department').removeClass('hidden');
                $('#multiple').prop('required',true);
                $r = '{{app()->getLocale()}}'; 
 if($r == 'ar'){     
$(".select2-search__field").attr("placeholder", "اختار");
}else{
$(".select2-search__field").attr("placeholder", "Select");

}
            }

            if(type == 2 || type == 0 ){
                $('#department').addClass('hidden');
                $('#multiple').prop('required',false);
            }

        }
    </script>
@endsection
