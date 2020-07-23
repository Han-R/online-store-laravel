@extends('layout.app')
@section('title') {{ucwords(__('common.land'))}}
@endsection
@section('css')
@endsection

@section('content')

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group" style="margin-top: 20px;">
                           
                        </div>
                    </div>

                </div>
                <div class="box-filter-collapse">
                    <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/land_page')}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">{{__('common.status')}}</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="status">
                                            <option value="active">{{__('common.active')}}</option>
                                            <option value="not_active"> {{__('common.not_active')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn sbold blue">{{__('common.search')}}
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <a href="{{url('admin/brands')}}" type="submit"
                                           class="btn sbold btn-default ">{{__('common.reset')}}
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <input type="hidden" id="url" value="{{url("/en/admin/packages_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>

                    </th>
                    <th> {{ucwords(__('common.name'))}}</th>
                    <th> {{ucwords(__('common.status'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr class="odd gradeX" id="tr-{{$item->id}}">
                        <td>
                                <span> {{$item->id}}</span>
                        </td>
                        <td>
                            @foreach($locales as $locale)
                                {{$item->translate($locale->lang)->name}}
                            @endforeach

                        </td>

                        <td>
                            <span class="label label-sm <?php echo ($item->status == "Active")
                                ? "label-info" : "label-danger"?>" id="label-{{$item->id}}">
                            @php
                                $status = $item->status
                                @endphp
                               
                                {{__('common.'.$status)}}
                            </span>
                        </td>
                        <td class="center">{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group btn-action">
                                <a href="{{url(getLocal().'/admin/land_page/'.$item->id.'/edit')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a>
                                
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
                text: "{{__('delete_msg')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    var url = '{{url(getLocal()."/admin/land_page")}}/' + id;
                    var csrf_token = '{{csrf_token()}}';
                    $.ajax({
                        type: 'delete',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: url,
                        success: function (response) {
                            console.log(response);
                            if (response === 'success') {
                                $('#tr-' + id).hide(1000);
                                swal("{{__('delete_done')}}", {icon: "success"});
                            } else {
                                swal('Error', {icon: "error"});
                            }
                        },
                        error: function (e) {
                            swal('exception', {icon: "error"});
                        }
                    });
                } else {
                    swal("{{__('delete_cancel')}}");
                }
            });
        }


    </script>
@endsection
