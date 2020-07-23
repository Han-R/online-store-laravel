@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.checkout')}}</title>
@endsection

@section('body')
        <!--Start check out-->
        
        <section id="checkOut">
            <div class="container">
                @if($carts->count()>0)
                    <div class="row">
                    <div class="col-md-6">
                        <div class="BillInfo">
                             <h3>{{__('website.billInfo')}}</h3>
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input disabled required="" id="name" name="name" value="{{$user->name}}" type="text" class="form-control" placeholder="Full Name" aria-required="true">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input  required="" id="mobile" name="mobile" value="{{$user->mobile}}" type="text" class="form-control" placeholder="Mobile Number" aria-required="true">
                                         </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input  required="" id="address" name="address" value="{{$user->address}}" type="text" class="form-control" placeholder="Address" aria-required="true">
                                         </div>
                                    </div>
                                </div>
                            
                            </form>
                              <div class="payment">
                                <h3>{{__('website.paymentMethod')}}</h3>
                                <div class="form-check-inline">
                                    <label class="customradio"><span class="radiotextsty">{{__('website.cash')}}</span>
                                        <input id="cash" class="payment_method" type="radio" name="payment_method" value="cash">
                                      <span class="checkmark"></span>
                                    </label>        
                                </div>
                            </div>
                             <button id="confirmation" class="btn confirmOrder" data-toggle="modal" data-target="#modalConfirm">{{__('website.orderConfirm')}}</button>
                            
                       
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="summary">
                            <h3>{{__('website.summary')}}</h3>
                            <?php $total = 0 ?>
                            @foreach($carts as $cart)
                                @if($cart->product->discount == 0)
                                    <?php $total += $cart->product->price * $cart->quantity ?>
                                @else
                                    <?php
                                    $price = $cart->product->price;
                                    $discount = ($price * $cart->product->discount)/100;
                                    $newPrice = $price -  $discount ;
                                    ?>
                                    <?php $total += $newPrice * $cart->quantity ?>
                                @endif
                            <div class="Info">
                                <div class="flex1">
                                        <p style="width: 60%">{{$cart->product->name}}</p>
                                        <p style="width: 15%">{{__('website.quantity')}} {{$cart->quantity}}</p>
                                    @if($cart->product->discount == 0)
                                        <p style="width: 15%" class="amount">{{__('website.price')}} {{$cart->product->price}} </p>
                                    @else
                                        <?php
                                        $price = $cart->product->price;
                                        $discount = ($price * $cart->product->discount)/100;
                                        $newPrice = $price -  $discount ;
                                        ?>
                                        <p style="width: 15%" class="amount">{{__('website.price')}} {{$newPrice}}</p>
                                    @endif
                                        <p class="sub" style="width: 20%">{{__('website.subtotal')}}</p>
                                    @if($cart->product->discount == 0)
                                        <p class="zero" style="width: 20%"> {{ ($cart->product->price) * ($cart->quantity) }}  {{__('website.currency')}}</p>
                                    @else
                                        <?php
                                        $price = $cart->product->price;
                                        $discount = ($price * $cart->product->discount)/100;
                                        $newPrice = $price -  $discount ;
                                        ?>
                                            <p class="zero" style="width: 20%"> {{ ($newPrice) * ($cart->quantity) }}  {{__('website.currency')}}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
{{--                            <div class="Info">--}}
{{--                                <div class="flex1">--}}
{{--                                    <p class="sub">{{__('website.shipping')}}</p>--}}
{{--                                    <p class="zero">0$</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="Info">
                                <div class="flex1">
                                    <p class="totalName">{{__('website.total')}}</p>
                                    <p  class="numberTotal" value="{{$total}}">{{$total}} {{__('website.currency')}}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                @else
                    <div class="alert alert-warning">
                        {{__('website.noResult')}}:(
                    </div>
                    <a href="{{url('/')}}"><button class="btn startShop">{{__('website.startShopping')}}</button></a>
                @endif
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">{{__('website.paymentMethod')}}</h4>
                            </div>
                            <div class="modal-body">
                                <p>{{__('website.payment_validate')}} </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('website.agree')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
         <!--end check out-->

@endsection

@section('script')

    <script>
        $(document).on('click','#confirmation', function(e){
            e.preventDefault();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var payment_method =$(".payment_method:checked").val();
            if(mobile == "" || address == "" || payment_method == ""){
                if(mobile == "")$('#mobile').css("border", "red solid 1px");
                if(address == "")$('#address').css("border", "red solid 1px");
                if(payment_method == ""){
                    $('#myModal').modal('show');
                }
                return false;
            }
            var url = '{{url(getLocal()."/checkout")}}';
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {mobile: mobile, address: address, payment_method: payment_method, _token: csrf_token},
                success: function (response) {
                    if (response.status === 'done') {
                        var successAlert='{{__('website.successOrder')}}';
                        alert(successAlert);
                        var url = '{{url(getLocal()."/profile")}}';
                        window.location.href=url;

                    }
                    else{
                        var failAlert='{{__('website.failOrder')}}';
                        alert(failAlert);
                    }
                },
                error: function (e) {
                    $('#myModal').modal('show');
                }
            });
        });
    </script>

@endsection