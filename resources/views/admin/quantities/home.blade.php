@extends('layouts.cp')
@section('title') {{__('cp.quantities')}}
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
                            <a href="{{url(getLocal().'/admin/addQuantity/'.$product->id)}}" style="margin-right: 5px"
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
            <input type="hidden" id="url" value="{{url(getLocal()."/admin/changeStatus/quantities")}}">
            <label style="font-weight: bolder;font-size: 20px;">{{ucwords(__('cp.product_name'))}} : {{$product->name}}</label>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th></th>
                    <th> # </th>
                    <th> {{ucwords(__('common.quantity'))}}</th>
                    <th> {{ucwords(__('cp.supplier'))}}</th>
                    <th> {{ucwords(__('common.price'))}}</th>
                    <th> {{ucwords(__('cp.executor_name'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr class="odd gradeX" id="tr-{{$item->id}}">

                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes chkBox" value="{{$item->id}}" name="chkBox"/>
                                <span></span>
                            </label>
                        </td>
                        <td> {{$loop->iteration}}</td>
                        <td> {{$item->quantity}}</td>
                        <td> {{@$item->supplier->name}}</td>
                        <td> {{@$item->price}}</td>
                        <td> {{@$item->admin->name}}</td>
                        <td class="center">{{$item->created_at->format('d/m/Y')}}</td>
                        <td>
                            <div class="btn-group btn-action">
                                <a href="{{url(getLocal().'/admin/editQuantity/'.$item->id)}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a>
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
            var url = '{{url(getLocal()."/admin/quantity")}}/' + id;
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
