@extends('layout.app')
@section('title') {{ucwords(__('users.title'))}}
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
                            <a href="{{url(getLocal().'/admin/users/create')}}" style="margin-right: 5px"
                               class="btn sbold green">{{__('common.add')}}
                                <i class="fa fa-plus"></i>
                            </a>
                            <button class="btn sbold blue btn--filter">{{__('common.filter')}}
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-filter-collapse">
                    <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/users')}}">
                        <div class="row">
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
                                        <a href="{{url('admin/users')}}" type="submit"
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
            <input type="hidden" id="url" value="">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>
                        {{--<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">--}}
                        {{--<input type="checkbox" class="group-checkable chkBox" data-set="#sample_1 .checkboxes"/>--}}
                        {{--<span></span>--}}
                        {{--</label>--}}
                    </th>
                    <th> {{ucwords(__('common.full_name'))}}</th>
                    <th> {{ucwords(__('common.email'))}}</th>
                    <th> {{ucwords(__('common.mobile'))}}</th>
                    <th> {{ucwords(__('common.status'))}}</th>
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
                        <td> {{$item->name}}</td>
                        <td><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
                        <td> {{$item->mobile}}</td>
                        <td>
                            <span @if($item->verification == 1) class="label label-sm label-info" @elseif($item->verification == 0) class="label label-sm label-default" @else  class="label label-sm label-danger" @endif
                                 id="label-{{$item->id}}">
                            @php
                                $status = $item->subscribe
                                @endphp
                               
                                {{__('common.'.$status)}}
                            </span>
                        </td>
                        <td class="center">{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group btn-action">
                                <a href="{{url(getLocal().'/admin/users/'.$item->id.'/edit')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a>

                                   <a href="{{url(getLocal().'/admin/users/'.$item->id.'/edit_password')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-expeditedssl"></i></a>
                                  
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
        function delete_adv(id, e) {
            e.preventDefault();
            swal({
                title: "{{__('common.confirm')}}",
                text: "{{__('users.delete_msg')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    var csrf_token = '{{csrf_token()}}';
                    $.ajax({
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: url,
                        success: function (response) {
                            console.log(response);
                            if (response === 'success') {
                                $('#tr-' + id).hide(1000);
                                swal("{{__('users.delete_done')}}", {icon: "success"});
                            } else {
                                swal('Error', {icon: "error"});
                            }
                        },
                        error: function (e) {
                            swal('exception', {icon: "error"});
                        }
                    });
                } else {
                    swal("{{__('users.delete_cancel')}}");
                }
            });
        }
        
        
         function delete_adv(id,iss_id, e) {
            //alert(id);
            e.preventDefault();
            console.log(id);
            console.log(iss_id);
                    var url = '{{url(getLocal()."/admin/users")}}/' + id;
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
