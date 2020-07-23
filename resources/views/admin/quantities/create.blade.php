@extends('layouts.cp')
@section('title') {{ucwords(__('cp.new_quantity'))}}
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
                              style="color: #e02222 !important;">{{__('cp.new_quantity')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <label style="font-weight: bolder;font-size: 20px;">{{ucwords(__('cp.product_name'))}} : {{$product->name}}</label>
                    <form method="post" action="{{url(app()->getLocale().'/admin/addQuantity/')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{$product->id}}"/>
                        <div class="form-body">
                            <fieldset>
                                <legend>{{__('common.quantity')}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="quantity">
                                            {{__('common.quantity')}}
                                            <span class="symbol">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="quantity"
                                                   placeholder="{{__('common.quantity')}}"
                                                   id="quantity"
                                                   value="{{ old('quantity') }}" required>
                                        </div>
                                    </div>

                            </fieldset>

                            <fieldset>
                                <legend>{{__('common.price')}}</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="price">
                                        {{__('common.price')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="{{__('common.price')}}" name="price" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>{{__('common.source')}}</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="source">
                                        {{__('common.source')}}
                                        <span class="symbol">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="supplier_id" class="form-control" required>
                                            <option >{{__('common.select')}}</option>
                                            @foreach($suppliers as $one)
                                                <option value="{{$one->id}}">{{$one->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                        <a href="{{url(getLocal().'/admin/quantities/'.$product->id)}}" class="btn default">{{__('common.cancel')}}</a>
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
