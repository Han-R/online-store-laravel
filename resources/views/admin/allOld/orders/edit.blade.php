@extends('layout.app')
@section('title') {{__('common.view')}}  {{__('order.order')}}
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
                              style="color: #e02222 !important;">{{__('common.view')}}{{__('order.order')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/orders/'.$orders->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$orders->user_id}}">
                        <div class="form-body">

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.category')}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" @if($orders->category) value="{{$orders->category->title}} " @endif id="order"
                                                   placeholder=" {{__('common.category')}}" {{ old('category') }} disabled>
                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="order">
                                            {{__('common.name')}}
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" @if($orders->username) value="{{$orders->username->name}} " @endif id="order"
                                                   placeholder=" {{__('common.name')}}" {{ old('name') }} disabled>
                                        </div>
                                    </div>
                                </fieldset>




                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.email')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->username) value="{{$orders->username->email}} " @endif id="order"
                                               placeholder=" {{__('common.email')}}" {{ old('email') }} disabled>
                                    </div>
                                </div>
                            </fieldset>



                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.mobile')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" @if($orders->username) value="{{$orders->username->mobile}} " @endif id="order"
                                               placeholder=" {{__('common.mobile')}}" {{ old('mobile') }} disabled>
                                    </div>
                                </div>
                            </fieldset>



                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.date')}}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value="{{$orders->date}}  {{$orders->time}} " id="order"
                                               placeholder=" {{__('common.mobile')}}" {{ old('mobile') }} disabled>
                                    </div>
                                </div>
                            </fieldset>



                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.description')}}
                                    </label>
                                    <div class="col-md-6">
                                        <textarea type="text" class="form-control" name="name"
                                               placeholder=" {{__('common.mobile')}}" disabled>{{$orders->description}} </textarea>
                                    </div>
                                </div>
                            </fieldset>

@if($orders->vedio != NULL)
                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="order">
                                        {{__('common.date')}}
                                    </label>
                                    <div class="col-md-6">

                                    <video width="320" height="240" controls>
                                              <source src="{{$orders->vedio}}" >
                                        </video>
                                      </div>
                                </div>
                            </fieldset> 
@endif   



                            
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label" for="category_id">
                                    {{__('common.status')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select id="category_id" class="form-control select2" name="status"
                                            required>
                                                                                    
                                            <option value="delivered" @if($orders->status == 'delivered') selected @endif>
                                                {{"delivered"}}
                                            </option>
                                            <option value="completed" @if($orders->status == 'completed') selected @endif>
                                                {{"completed"}}
                                            </option>
                                    </select>
                                </div>
                            </div> -->




   
                          <!--   <div class="form-group">
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
                             -->
                            
                            
                            <div class="row">
                                @foreach($orders->images as $attatchment)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="dashboard-stat2 ">
                                            <li id="material-{{$attatchment->id}}" style="list-style: none; border-style: outset;">
                                               
                                                
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
                                                    <a href="#" onclick="delete_attatchment('{{$attatchment->id}}','{{$orders->id}}',event)"><button class="btn btn-danger">{{__('common.submit')}}</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>




                            <hr style="border-top: 4px solid #E4B017">

                            <br>
                            <br>
                            <br>
                            <br>


<div class="row" >
                                                <div class="col-md-4" style ="border-bottom: 1px solid #ccc;">
                                                    <div class="btn-group">
                                                        
                                                            <i class="icon-settings font-blue"></i>
<span class="caption-subject font-blue bold uppercase">{{__('common.all_offers_on_order')}}</span>
                                                        
                                                    </div>
                                                </div>
<div class="col-md-5"></div>
                                              <!--  <div class="col-md-3">
                                                    <select class="form-control select2" name="size_id" required  
                              id="status">
                                    <option value="" > {{__('common.select')}}</option>
                                    <option value="0">{{__('common.waiting')}}</option>
                                    <option value="1">{{__('common.accepted')}}</option>
                                    <option value="2">{{__('common.refuse')}}</option>
                                    <option value="3">{{__('common.inprogress')}}</option>
                                    <option value="4">{{__('common.completed')}}</option>             

                            </select>
                                                </div> -->
                                            </div>


                            <br>
                            <br>

                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                                <thead>
                                <tr>
                                    <th> {{ucwords(__('common.name'))}}</th>
                                    <th> {{ucwords(__('common.mobile'))}}</th>
                                    <th> {{ucwords(__('common.price'))}}</th>
                                    <th> {{ucwords(__('common.detection_price'))}}</th>
                                    <th> {{ucwords(__('common.day'))}}</th>
                                    <th> {{ucwords(__('common.hours'))}}</th>
                                    <th> {{ucwords(__('common.status'))}}</th>
                                    <th> {{ucwords(__('common.total'))}}</th>
                                    <!-- <th>{{ucwords(__('common.action'))}} </th> -->
                                </tr>
                                </thead>
                                <tbody>
                                @if($technicals)
                                    @forelse($technicals as $product)
                                    <tr class="odd gradeX" id="tr-{{$product->id}}" @if($product->status == "inprogress") 
style = "background :#52f275 " @endif>

                                        <td>
                                            @if($product->technical or $product->technical != '') {{$product->technical->name}} @endif

                                        </td>
<td>
                                            @if($product->technical or $product->technical != '') {{$product->technical->mobile}} @endif

                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->detection_price}}</td>
                                        <td>{{$product->days}}</td>
                                        <td>{{$product->hours}}</td>
                                                                <td>
<button type="button" @if($product->status_now == 0) class="btn yellow-crusta btn-outline sbold uppercase" @elseif($product->status_now == 1)  class="btn green btn-outline sbold uppercase" @elseif($product->status_now == 4) class="btn blue btn-outline sbold uppercase"  @elseif($product->status_now == 3) class="btn green-meadow btn-outline sbold uppercase"  @else class="btn red-mint btn-outline sbold uppercase" @endif> @php
                              $status =  $product->status ;
                               @endphp

                              {{__('common.'.$status)}}</button>
</td>
                                        <td>{{$product->price + $product->detection_price}}</td>
                                        

                                        <td>
                                           <!--  <a href="{{url(getLocal().'/admin/orders_technical/'.$product->id.'/edit_status')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a> -->

                                        </td>


                                    </tr>

                                @empty
                                    {{__('common.no')}}
                                @endforelse
                                @endif
                                </tbody>
                            </table>









 <hr style="border-top: 4px solid #E4B017">

                            <br>
                            <br>
                            <br>
                            <br>


<div class="row" >
                                                <div class="col-md-4" style ="border-bottom: 1px solid #ccc;">
                                                    <div class="btn-group">
                                                        
                                                            <i class="icon-settings font-blue"></i>
<span class="caption-subject font-blue bold uppercase">{{__('common.all_additional_work')}}</span>
                                                        
                                                    </div>
                                                </div>
<div class="col-md-5"></div>
                                        
                                            </div>


                            <br>
                            <br>

                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                                <thead>
                                <tr>
<th> {{ucwords(__('common.nu_order'))}}</th>
                                    <th> {{ucwords(__('common.description'))}}</th>
                                    
                                    <th> {{ucwords(__('common.price'))}}</th>
                               
                                </tr>
                                </thead>
                                <tbody>
<?php $i = 0 ?>

                                @if($orders->additional_work)
                                    @forelse($orders->additional_work as $work)
                                    <tr class="odd gradeX" id="tr-{{$work->id}}" <?php  $i++; ?> >
<td> <?php echo $i ; ?> </td>
                                    <td>{{$work->description}}</td>
                                    <td>{{$work->price}}</td>
                                        


                                    </tr>
                                @empty
                                    {{__('common.no')}}
                                @endforelse
                                @endif
                                </tbody>
                            </table>











                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <!-- <button type="submit" class="btn green">{{__('common.submit')}}</button> -->
@if(Request::segment(3) == "orders")
                                        <a href="{{url(getLocal().'/admin/orders')}}" class="btn default">{{__('common.cancel')}}</a>
@else
<a href="{{url(getLocal().'/admin/orders_trash')}}" class="btn default">{{__('common.cancel')}}</a>
@endif
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
