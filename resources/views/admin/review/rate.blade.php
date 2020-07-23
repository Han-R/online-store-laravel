@extends('layouts.cp')
@section('title') {{__('website.rate')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="table-toolbar">
                    <div class="row">
                    </div>
                </div>

                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                    <thead>
                    <tr>
                        <th></th>
                        <th> {{ucwords(__('website.product_name'))}}</th>
                        <th> {{ucwords(__('common.image'))}}</th>
                        <th> {{ucwords(__('website.overrating'))}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse(@$items as $item)
                        <tr class="odd gradeX" id="tr-{{$item->id}}">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="checkboxes chkBox" value="{{$item->id}}" name="chkBox"/>
                                    <span></span>
                                </label>
                            </td>
                            <td> {{@$item->name}}</td>
                            <td><img src="{{$item->image}}" width="50px" height="50px"></td>
                            <td>@include('website.switchRate', array('product_rate'=>$item->rating_cache))</td>
                        </tr>
                    @empty
                        {{__('common.no')}}
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        @endsection

        @section('js')
        @endsection
        @section('script')
@endsection
