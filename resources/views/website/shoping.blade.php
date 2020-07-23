@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.cart')}}</title>
@endsection

@section('body')

    <!--Start shopping-->
    <section id="shopping">
        <div class="container">
            <div class="row">
                <div class="checkout-block">
                    <div class="table-responsive">
                        <table class="table table-st2">
                            <tbody>
                            <tr>
                                <td>
                                    <span class="tTitle">{{__('website.product')}}</span>
                                </td>
                                <td>
                                    <span class="tTitle">{{__('website.price')}}</span>
                                </td>
                                <td>
                                    <span class="tTitle">{{__('website.quantity')}}</span>
                                </td>
                                <td>
                                    <span class="tTitle">{{__('website.subtotal')}}</span>
                                </td>
                                <td></td>
                            </tr>
                            @foreach($carts as $cart)
                                <tr id="tr-{{$cart->id}}">
                                    <td>
                                        <div class="add-img">
                                            <img src="{{$cart->product->image}}">
                                            <p class="productName">{{$cart->product->name}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        @if($cart->product->discount == 0)
                                            <span class="span2" >{{$cart->product->price}}</span>
                                        @else
                                            <?php
                                            $price = $cart->product->price;
                                            $discount = ($price * $cart->product->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <span class="span2" >{{$newPrice}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="quality">
                                            <div class="qty mt-5">
                                                <a onclick="decrease_quantity('{{$cart->id}}')" id="decreaseQuantity-{{$cart->id}}" class="minus bg-dark">-</a>
{{--                                                <input id="cart-{{$cart->id}}"  class="count" name="quantity" value="{{$cart->quantity}}">--}}
                                                <span id="cart-{{$cart->id}}" class="span3">{{$cart->quantity}}</span>
                                                <a  onclick="increase_quantity('{{$cart->id}}')" id="increaseQuantity-{{$cart->id}}"  class="plus bg-dark">+</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($cart->product->discount == 0)
                                            <span id="total-{{$cart->id}}" class="span2">{{ ($cart->product->price) * ($cart->quantity) }}</span>
                                        @else
                                            <?php
                                            $price = $cart->product->price;
                                            $discount = ($price * $cart->product->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <span id="total-{{$cart->id}}" class="span2">{{ ($newPrice) * ($cart->quantity) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-action">

                                            <a href="#myModal{{$cart->id}}" role="button"  data-toggle="modal" class="btn btn-xs red tooltips address-remove"><i class="fas fa-times"></i></a>

                                            <div id="myModal{{$cart->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                            <a href="#" onclick="delete_adv('{{$cart->id}}','{{$cart->id}}',event)"><button class="btn btn-danger">{{__('common.delete')}}</button></a>
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
                        <div class="btnConfirm">
                            <a href="{{url(getLocal()."/")}}"><button class="btnContinue">{{__('website.continueShopping')}}</button></a>
                            <a href="{{url(getLocal()."/checkout")}}"><button class="btnClear">{{__('website.checkout')}}</button></a>
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


        function increase_quantity(id) {

            //e.preventDefault();
            var url = '{{url(getLocal()."/increaseQuantity")}}/'+id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'get'},
                success: function (response) {
                    console.log(response);
                    if (response.status === 'done') {
                       $('#cart-' + id).html(response.quantityy);
                       $('#total-' + id).html(response.subTotal);

                    } else if(response.status === 'error'){
                         var alert_fail='{{__('website.pro_ex_qt')}}';
                        alert(alert_fail);
                    }
                },
                error: function (e) {

                }
            });

        }

        function decrease_quantity(id) {

            //e.preventDefault();
            var url = '{{url(getLocal()."/decreaseQuantity")}}/'+id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'get'},
                success: function (response) {
                    console.log(response);
                    if (response.status === 'done') {
                        $('#cart-' + id).html(response.quantityy);
                        $('#total-' + id).html(response.subTotal);

                    } else if(response.status === 'error'){
                        var alert_fail='{{__('website.pro_le_qt')}}';
                        alert(alert_fail);
                    }
                },
                error: function (e) {

                }
            });

        }

        function delete_adv(id, iss_id, e) {

            e.preventDefault();
            var url = '{{url(getLocal()."/removeFromCart")}}/' + id;
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'delete',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'delete'},
                success: function (response) {
                    console.log(response);
                    if (response.status === 'done') {
                        $('#showCart').html(response.cart);
                        $('#tr-' + id).hide(500);
                        $('#myModal' + id).modal('toggle');
                        //window.location.reload();
                        
                    } else {
                        swal('Error', {icon: "error"});
                    }
                },
                error: function (e) {

                }
            });

        }

    </script>

@endsection