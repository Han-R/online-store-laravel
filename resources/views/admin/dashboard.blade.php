@extends('layouts.cp')
@section('title') {{ucwords(__('home.dashboard'))}}
@endsection
@section('css')

@endsection
@section('content')

    <div class="row widget-row">
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">{{__('common.categories')}}</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green fa fa-th-large"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle"></span>
                        <span class="widget-thumb-body-stat" data-counter="counterup"
                              data-value="{{$count_categories}}">{{$count_categories}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">{{__('common.products')}}</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle"></span>
                        <span class="widget-thumb-body-stat" data-counter="counterup"
                              data-value="{{$count_products}}">{{$count_products}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">{{__('common.total_orders')}}</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle"></span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$count_orders}}">{{$count_orders}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">{{__('common.users')}}</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle"></span>
                        <span class="widget-thumb-body-stat" data-counter="counterup"
                              data-value="{{$count_users}}">{{$count_users}}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" style="text-align: center;">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newQuantity" style="margin: 100px;width: 120px;height: 40px;font-size: 20px;font-weight: 700;">
                    {{__('cp.in')}}
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="" style="margin: 100px;width: 120px;height: 40px;font-size: 20px;font-weight: 700;">
                    {{__('cp.out')}}
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="" style="margin: 100px;height: 40px;font-size: 20px;font-weight: 700;">
                    {{__('cp.internalSale')}}
                </button>

            </div>
        </div>

    </div>


    <div class="modal fade" id="newQuantity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ucwords(__('cp.new_quantity'))}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <fieldset>
                            <legend>{{__('common.barCode')}}</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="barCode">
                                    {{__('common.barCode')}}
                                    <span class="symbol">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="barCode"
                                           placeholder="{{__('common.barCode')}}"
                                           id="barCode"
                                           value="{{ old('barCode') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" id="checkBarCode">Check</button>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">

                            <div class="form-group detailsOfProduct" style="display: none">
                                <div class="col-md-12" style="text-align: center;">
                                    <p></p>
                                    <img src="" width="100" height="100">
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>{{__('common.quantity')}}</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="quantity">
                                                {{__('common.quantity')}}
                                                <span class="symbol">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="{{__('common.quantity')}}" id="quantity" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{__('common.price')}}</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="price">
                                                {{__('common.price')}}
                                                <span class="symbol">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="{{__('common.price')}}" id="price" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{__('common.source')}}</legend>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="source">
                                                {{__('common.source')}}
                                                <span class="symbol">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select id="supplier_id" name="supplier_id" class="form-control" required>
                                                    <option >{{__('common.select')}}</option>
                                                    @foreach($suppliers as $one)
                                                        <option value="{{$one->id}}">{{$one->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-12" style="text-align: center;margin-top: 50px;">
                                    <button type="button" class="btn btn-primary" id="SubmitQuantity" style="width: 100px;">Send</button>
                                </div>


                            </div>
                            <div class="noProductFound alert alert-danger" role="alert" style="margin-top: 40px;text-align: center;display: none"><p>no product found</p></div>
                            <div class="successOperation alert alert-success" role="alert" style="margin-top: 40px;text-align: center;display: none"><p>Done Successfully</p></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;margin-top: 50px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection

@section('script')
<script>
    $('#barCode').keypress(function(event) {
        if (event.keyCode == 13 || event.which == 13) {
            $('#checkBarCode').click();
            event.preventDefault();
        }
    });
    $(document).on('click','#checkBarCode',function (e) {
        e.preventDefault();
        var barCode = $('#barCode').val();
        var url = '{{url(getLocal()."/admin/checkBarCode")}}/' + barCode;
        var csrf_token = '{{csrf_token()}}';
        $.ajax({
            type: 'get',
            headers: {'X-CSRF-TOKEN': csrf_token},
            url: url,
            data: {_method:'get'},
            success: function (response) {
                console.log(response);
                if (response) {
                    $('.noProductFound').slideUp();
                    $('.detailsOfProduct').slideDown('500');
                    $('.detailsOfProduct').find('p').html(response['name']);
                    $('.detailsOfProduct').find('img').attr('src',response['image']);
                    $('#quantity').focus();
                } else {
                    $('.detailsOfProduct').slideUp();
                    $('.noProductFound').slideDown('500');
                }
            },
            error: function (e) {
                // swal('exception', {icon: "error"});
            }
        });

    });


    $(document).on('click','#SubmitQuantity',function (e) {
        e.preventDefault();
        var barCode = $('#barCode').val();
        var quantity = $('#quantity').val();
        var supplier_id = $('#supplier_id').val();
        var price = $('#price').val();
        var url = '{{url(getLocal()."/admin/addQuantityByBarCode")}}';
        var csrf_token = '{{csrf_token()}}';
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': csrf_token},
            url: url,
            data: {
                'barCode': barCode,
                'quantity': quantity,
                'supplier_id': supplier_id,
                'price': price,
                '_token': csrf_token
            },
            success: function (response) {
                console.log(response);
                if (response=='done') {
                    $('.successOperation').slideDown('500');
                    $('.detailsOfProduct').slideUp();
                    $('#barCode').val("");
                } else {
                    $('.noProductFound').slideDown('500');
                }
            },
            error: function (e) {
                // swal('exception', {icon: "error"});
            }
        });

    });

</script>
@endsection
