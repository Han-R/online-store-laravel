@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.wishlist')}}</title>
@endsection

@section('body')

    <!--Start shopping-->
    <section id="shopping">
        <div class="container">
            <div class="row">
                <div class="checkout-block">
                    <div class="table-responsive">
                        @if(count($whishlists)>0)
                        <table class="table table-st2">
                            <tbody>
                            <tr>
                                <td>
                                    <span class="tTitle">{{__('website.product')}}</span>
                                </td>
                                <td>
                                    <span class="tTitle">{{__('website.price')}}</span>
                                </td>
                                <td></td>
                            </tr>
                            @foreach($whishlists as $whishlist)
                                <tr id="tr-{{$whishlist->id}}">
                                    <td>
                                        <a data-id="{{$whishlist->product->id}}" class="countClick" href="{{url(getLocal().'/product/'.$whishlist->product->id)}}">
                                        <div class="add-img">
                                            <img src="{{$whishlist->product->image}}">
                                            <p class="productName">{{$whishlist->product->name}}</p>
                                        </div>
                                        </a>
                                    </td>
                                    <td>
                                        @if($whishlist->product->discount == 0)
                                            <span class="span2" >{{$whishlist->product->price}}</span>
                                        @else
                                            <?php
                                            $price = $whishlist->product->price;
                                            $discount = ($price * $whishlist->product->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <span class="span2" >{{$newPrice}}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group btn-action">

                                            <a href="#myModal{{$whishlist->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips address-remove"><i class="fas fa-times"></i></a>
                                            
                                            <div id="myModal{{$whishlist->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                            <a href="#" onclick="delete_adv('{{$whishlist->id}}','{{$whishlist->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="alert alert-warning">
                                {{__('website.noResult')}}:(
                            </div>
                        @endif
                        <div class="btnConfirm">
                            <a href="{{url(getLocal()."/")}}"><button class="btnContinue">{{__('website.continueShopping')}}</button></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--end shopping-->

@endsection

@section('script')

    <script>

        function delete_adv(id, iss_id, e) {

            e.preventDefault();
            var url = '{{url(getLocal()."/removeFromWishlist")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'delete'},
                success: function (response) {
                    console.log(response);
                    if (response.status === 'done') {
                        $('#showWishlist').html(response.wishlist);
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');

                    } else {
                        swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {

                }
            });

        }

    </script>

    <script>
        $(document).on('click','.countClick', function(e){

            e.preventDefault();
            var productId = $(this).attr('data-id');
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                headers: {'X-CSRF-TOKEN': csrf_token},
                url:'{{url(getLocal()."/product/track-click")}}/'+productId,
                data: {},
                type: 'get',
                success:function(response){
                    if (response.status === 'done') {

                        location.href = '{{url(getLocal()."/product")}}/'+productId;
                    }
                    else if(response.status === 'error'){
                        location.href = '{{url(getLocal()."/product")}}/'+productId;
                    }

                },
                error: function (response) {
                    location.href = '{{url(getLocal()."/product")}}/'+productId;
                }
            });
        });
    </script>

@endsection