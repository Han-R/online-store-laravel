@extends('layout.app')
@section('title') {{__('common.edit')}}{{__('order.order')}}
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
                              style="color: #e02222 !important;">{{__('common.edit')}}{{__('order.order')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/orders_response/'.$orders->id)}}"
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
                                        {{__('common.date')}}
                                    </label>
                                    <div class="col-md-6">
                                        <textarea type="text" class="form-control" name="name"
                                               placeholder=" {{__('common.mobile')}}" disabled>{{$orders->description}} </textarea>
                                    </div>
                                </div>
                            </fieldset>

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
                            <hr style="border-top: 4px solid #E4B017">

                      

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/orders')}}" class="btn default">{{__('common.cancel')}}</a>
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
