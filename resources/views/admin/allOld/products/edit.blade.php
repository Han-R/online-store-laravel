@extends('layout.app')
@section('title') {{ucwords(__('common.edit'))}}{{ucwords(__('product.product'))}}
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
                              style="color: #e02222 !important;">{{ucwords(__('common.edit'))}}{{ucwords(__('product.product'))}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/products/'.$item->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

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
                                            <option value="{{$com->id}}" @if($item->company_id == $com->id) selected @endif>
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
                                            <input type="text" class="form-control" name="name_{{$locale->lang}}" value="{{$item->translate($locale->lang)->name}}" id="order"
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
                                            <textarea class="form-control" name="description_{{$locale->lang}}"  id="order"
                                                      placeholder=" {{__('common.description_'.$locale->lang)}}" {{ old('description_'.$locale->lang) }}>{{$item->translate($locale->lang)->description}}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach



                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('product.old_price')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="old_price" value="{{ $item->old_price }}"
                                               placeholder=" {{__('product.old_price')}}" {{ old('old_price') }}>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('product.current_price')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="current_price" value="{{$item->current_price }}"
                                               placeholder=" {{__('product.current_price')}}" {{ old('current_price') }}>
                                    </div>
                                </div>
                            </fieldset>






                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('product.delivered_day')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="delivered_day" value="{{ $item->delivered_day }}"
                                               placeholder=" {{__('product.delivered_day')}}" {{ old('delivered_day') }}>
                                    </div>
                                </div>
                            </fieldset>




                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('product.quentity')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="quentity" value="{{ $item->quentity }}"
                                               placeholder=" {{__('product.quentity')}}" {{ old('quentity') }}>
                                    </div>
                                </div>
                            </fieldset>



                           

                            <div class="form-group">
                                <label class="control-label col-md-2">{{__('product.status')}} {{__('product.product')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-8">
                                    <div class="mt-checkbox-inline">
                                        <label class="mt-checkbox">
                                            <input type="checkbox" name="offer" id="inlineCheckbox1" value="1" @if($item->offer == 1) checked @endif> {{__('bunch.in_offer')}}
                                            <span></span>
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>






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
                                            <img src="{{isset($item) && $item->logo ? url($item->logo) : url(admin_assets('/images/ChoosePhoto.png'))}}" id="editImage">
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
                                <label class="control-label col-md-3">{{__('common.images')}}  {{__('common.upload')}}</label>
                                <div class="col-md-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> {{__('common.select')}}  {{__('common.file')}} </span>
                                                                <span class="fileinput-exists"> {{__('common.change')}} </span>
                                                                <input type="hidden"><input type="file" name="attatchments[]" multiple> </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> {{__('common.remove')}} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                @foreach($item->products as $attatchment)
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
                                                <a href="{{url($attatchment->image)}}" target="_blank" >
                                                    <img src="{{$attatchment->image}}" height="200" class="img-responsive pic-bordered" />
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
                                                    <a href="#" onclick="delete_attatchment('{{$attatchment->id}}','{{$item->id}}',event)"><button class="btn btn-danger">{{__('common.submit')}}</button></a>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <a href="{{url(getLocal().'/admin/features_color/'.$item->id.'/create')}}" style="margin-right: 5px"
                               class="btn sbold green">{{__('common.add')}}
                                <i class="fa fa-plus"></i>
                            </a>
                            <button class="btn sbold red event" id="delete">{{__('common.delete')}}
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" id="url" value="{{url(app()->getLocale()."/admin/features_color_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th> {{ucwords(__('bunch.color'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($features_color as $feature_color)
                    <tr class="odd gradeX" id="tr-{{$feature_color->id}}">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes chkBox" value="{{$feature_color->id}}" name="chkBox"/>
                                <span></span>
                            </label>
                        </td>
                         <td>
                            <input type="text" id="hue-demo" class="form-control demo" data-control="hue" value="{{$feature_color->color}}" name="color" disabled>
                        </td>
                       
                       
                        <td>
                            <div class="btn-group btn-action">
                                
                                 <a href="#myModal{{$feature_color->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips">
                                                    &nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                                                                    
                                                                                     <div id="myModal{{$feature_color->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                    <a href="#" onclick="delete_featureColor('{{$feature_color->id}}','{{$feature_color->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{__('common.no')}}
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <a href="{{url(getLocal().'/admin/features_size/'.$item->id.'/create')}}" style="margin-right: 5px"
                               class="btn sbold green">{{__('common.add')}}
                                <i class="fa fa-plus"></i>
                            </a>
                            <button class="btn sbold red event" id="delete">{{__('common.delete')}}
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" id="url" value="{{url(app()->getLocale()."/admin/features_size_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th> {{ucwords(__('bunch.size'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($features_size as $feature_size)
                    <tr class="odd gradeX" id="tre-{{$feature_size->id}}">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes chkBox" value="{{$feature_size->id}}" name="chkBox"/>
                                <span></span>
                            </label>
                        </td>
                         <td>
                            {{$feature_size->size}}
                        </td>
                       
                       
                        <td>
                            <div class="btn-group btn-action">
                                
                                 <a href="#myModal{{$feature_size->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips">
                                                    &nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                                                                    
                                                                                     <div id="myModal{{$feature_size->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                    <a href="#" onclick="delete_featureSize('{{$feature_size->id}}','{{$feature_size->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{__('common.no')}}
                @endforelse
                </tbody>
            </table>
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
    <script>
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
        
        
        
        
         function delete_featureColor(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/admin/features_color")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method:'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                        //swal("القضية حذفت!", {icon: "success"});
                    } else {
                        // swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });

        }
        
        
        function delete_featureSize(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/admin/features_size")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method:'delete'},
                success: function (response) {
                    console.log(response);
                    if (response === 'success') {
                        $('#tre-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                    } else {
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });

        }

    </script>
@endsection
