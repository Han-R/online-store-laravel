@extends('layouts.cp')
@section('title') {{__('website.order_details')}}
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
                              style="color: #e02222 !important;">{{__('website.order_details')}}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{url(app()->getLocale().'/admin/orders/'.$order_i->id)}}"
                          class="form-horizontal" role="form" id="form_company">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.customer_name'))}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{@$order_i->user->name}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.customer_mobile'))}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{@$order_i->user->mobile}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.total'))}}({{ucwords(__('website.currency'))}})
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"value="{{$order_i->total}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset style="margin-top:50px">
                            <div class="form-group" id="gover_option">
                                <label class="control-label col-md-2">{{__('website.change_status')}}
                                </label>
                                <div class="col-md-6">
                                    <select id="multiple2" class="form-control select2"
                                            name="status">
                                        <option value="">--</option>

                                        <option value="0"@if($order_i->status == '0') selected @endif>
                                            {{__('website.new')}}
                                        </option>
                                        <option value="1"@if($order_i->status == '1') selected @endif>
                                            {{__('website.accept')}}
                                        </option>
                                        <option value="2"@if($order_i->status == '2') selected @endif>
                                            {{__('website.in_progress')}}
                                        </option>
                                        <option value="3"@if($order_i->status == '3') selected @endif>
                                            {{__('website.completed')}}
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                    <a href="{{url(getLocal().'/admin/orders')}}" class="btn default">{{__('common.cancel')}}</a>
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

@endsection
