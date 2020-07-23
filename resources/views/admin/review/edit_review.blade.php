@extends('layouts.cp')
@section('title') {{__('website.review_details')}}
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
                    <form method="post" action="{{url(app()->getLocale().'/admin/review/'.$item->id)}}"
                          class="form-horizontal" role="form" id="form_company">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.customer_name'))}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{@$item->user->name}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.product_name'))}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{@$item->product->name}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="order">
                                    {{ucwords(__('website.comment'))}}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{@$item->comment}}" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="approved" value="0" />
                                    <input  {{ $item->approved?"checked":"" }} type="checkbox" value="1" name="approved" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{__('website.approved')}}</label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="spam" value="0" />
                                    <input  {{ $item->spam?"checked":"" }} type="checkbox" value="1" name="spam" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">{{__('website.spam')}}</label>
                                </div>
                            </div>
                        </fieldset>



                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">{{__('common.submit')}}</button>
                                    <a href="{{url(getLocal().'/admin/review')}}" class="btn default">{{__('common.cancel')}}</a>
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
