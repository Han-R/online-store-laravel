@extends('layout.app')
@section('title') {{ucwords(__('common.pages'))}}
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
                            <!--<a href="{{url(getLocal().'/admin/pages/create')}}" style="margin-right: 5px"-->
                            <!--   class="btn sbold green">{{ucwords(__('common.add'))}}-->
                            <!--    <i class="fa fa-plus"></i>-->
                            <!--</a>-->
                            {{--<button class="btn sbold blue btn--filter">{{__('common.filter')}}--}}
                                {{--<i class="fa fa-search"></i>--}}
                            {{--</button>--}}
                            <!--<button class="btn sbold red event" id="delete">{{__('common.delete')}}-->
                            <!--    <i class="fa fa-times"></i>-->
                            <!--</button>-->
                            <!--<button class="btn sbold green event" id="active">{{__('common.active')}}-->
                            <!--    <i class="fa fa-check"></i>-->
                            <!--</button>-->
                            <!--<button class="btn sbold default event" id="not_active">{{__('common.not_active')}}-->
                            <!--    <i class="fa fa-minus"></i>-->
                            <!--</button>-->
                        </div>
                    </div>

                </div>
                <div class="box-filter-collapse">
                    <form class="form-horizontal" method="get" action="{{url(getLocal().'/admin/pages')}}">
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
                                        <a href="{{url('admin/pages')}}" type="submit"
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
            <input type="hidden" id="url" value="{{url(app()->getLocale()."/admin/pages_changeStatus")}}">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                <tr>
                    <th>

                    </th>
                    <th> {{ucwords(__('common.name'))}}</th>
                    <th> {{ucwords(__('common.created'))}}</th>
                    <th> {{ucwords(__('common.action'))}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pages as $page)
                    <tr class="odd gradeX" id="tr-{{$page->id}}">
                        <td>
                                <span>{{$page->id}}</span>
                            </label>
                        </td>
                        <td>{{$page->title}}</td>
                        
                       
                        <td class="center">{{$page->created_at}}</td>
                        <td>
                            <div class="btn-group btn-action">
                                <a href="{{url(getLocal().'/admin/pages/'.$page->id.'/edit')}}"
                                   class="btn btn-xs blue tooltips" data-container="body" data-placement="top"
                                   data-original-title="{{__('common.edit')}}"><i class="fa fa-edit"></i></a>
                                <!--<a href="#myModal{{$page->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips">-->
                                <!--                    &nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true"></i>-->
                                <!--                </a>-->
                                                                                    
                                                                                     <div id="myModal{{$page->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                    <a href="#" onclick="delete_adv('{{$page->id}}','{{$page->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
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
            console.log(id);
            console.log(iss_id);
            var url = '{{url(getLocal()."/admin/pages")}}/' + id;
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
