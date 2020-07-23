@extends('layout.app')
@section('title') {{__('order.title')}}
@endsection
@section('css')
@endsection

@section('content')

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">
                            <button class="btn sbold red event" id="delete">{{__('common.delete')}}
                                <i class="fa fa-times"></i>
                            </button>
                             <button class="btn sbold blue btn--filter">{{__('common.filter')}}
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="box-filter-collapse">
                    <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/orders')}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.category')}}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category"
                                               placeholder="{{__('common.category')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.email')}}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email"
                                               placeholder="{{__('common.email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn sbold blue">{{__('common.search')}}
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <a href="{{url('admin/orders')}}" type="submit"
                                           class="btn sbold btn-default ">{{__('common.reset')}}
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.mobile')}}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="mobile"
                                               placeholder="{{__('common.mobile')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            <input type="hidden" id="url" value="{{url(app()->getLocale()."/admin/orders_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>

                    </th>
                    <th> {{ucwords(__('common.nu_order'))}}</th>
 
                    <th> {{ucwords(__('common.category'))}}</th>
                    <th> {{ucwords(__('common.name'))}}</th>
                    <th> {{ucwords(__('common.name_tech'))}} </th>
<th> {{ucwords(__('common.nu'))}} {{ucwords(__('common.tech'))}} </th>
                    <th> {{ucwords(__('common.date'))}}</th>
                    <th> {{ucwords(__('common.status'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                @if($item->username)
                    <tr class="odd gradeX" id="tr-{{$item->id}}">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes chkBox" value="{{$item->id}}" name="chkBox"/>
                                <span></span>
                            </label>
                        </td>

<td>
                           {{ $item->id}}

                        </td>
                        <td>
                            @if($item->category) {{$item->category->title}} @endif

                        </td>

                        <td>
                            {{$item->username->name}}

                        </td>


   <td>
@if($item->technical)
                            {{$item->technical->name}}
@endif
                        </td>


   <td>
@if($item->technical)
                            {{$item->technical->id}}
@endif
                        </td>

                     

                     

                        <td>
@if($item->status_time == 1)
                            {{$item->date}} {{$item->time}} @else {{__('common.now')}} @endif

                        </td>
                        <td>
<button type="button" @if($item->status_now == 0) class="btn yellow-crusta btn-outline sbold uppercase" @elseif($item->status_now == 1)  class="btn green-meadow btn-outline sbold uppercase" @elseif($item->status_now == 4) class="btn blue btn-outline sbold uppercase"  @else class="btn red-mint btn-outline sbold uppercase" @endif> @php
                              $status =  $item->status ;
                               @endphp

                              {{$status}}</button>
</td>


                        <td class="center">{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group btn-action">
                                <a href="{{url(getLocal().'/admin/orders_trash/'.$item->id.'/edit')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.view')}}"><i class="fa fa-eye"></i></a>
                                <a href="#myModal{{$item->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips">
                                                    &nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                                                                    
                                                                                     <div id="myModal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                    <a href="#" onclick="delete_adv('{{$item->id}}','{{$item->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </td>
                    </tr>
                @endif    
                @empty
                    {{__('common.no')}}
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
@section('script')
    <script>

        
         function delete_adv(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/admin/orders_trash")}}/' + id;
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


    </script>
@endsection
