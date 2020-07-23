@extends('layouts.websiteLayout')

@section('head')
    <title>{{__('website.profile')}} </title>
@endsection

@section('body')
        <!--Start profile information-->
        
            <section id="profileInfo">
            <div class="container">
                <div class="profileInfo">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="photo">
                                <img src="{{$user->avatar}}">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="generalInfo">
                                <h2>{{$user->name}}</h2>
                                <p>{{$user->mobile}}</p>
                                <p>{{$user->email}}</p>
                                <address>{{$user->address}}</address>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="writing"><a href="{{url(getLocal().'/editProfile')}}"><i class="far fa-edit"></i></a></div>
{{--                            <div class="writing"><a href="{{url(getLocal().'/editProfile/'.$user->id)}}"><i class="far fa-edit"></i></a></div>--}}
                        </div>
                    </div>
                </div>
                    <h2 class="myOrder">{{__('website.my_order')}}</h2>
                @if(count($orders)>0)
                @foreach($orders as $order)
                    <div class="profileOrder">
                        <div class="orderInfo">

                               <div class="personData">
                                <h5>{{__('website.order_number')}}:</h5>
                                   <p>{{$order->id}}</p>
                               </div>

                                <div class="personData">
                                    <h5>{{__('website.order_date')}}:</h5>
                                    <time>{{$order->created_at->format('j-F-Y')}}</time>
                                </div>

                                <div class="personData">
                                    <h5>{{__('website.status')}}:</h5>
                                    <?php
                                    $status = '';
                                    if($order->status == 0) $status = __('website.new');
                                    elseif ($order->status == 1) $status = __('website.accept');
                                    elseif ($order->status == 2) $status = __('website.in_progress');
                                    else $status = __('website.completed');
                                    ?>
                                    <p>{{$status}}</p>
                                </div>
                        </div>
                        @foreach($order->products as $product)
                        <div class="row">
                            <div class="col-md-4">
                               <div class="aboutOrder">
                                   <div class="productOrder">
                                        <img src="{{$product->image}}">
                                    </div>
                                    <div class="infoOrder">
                                           <p>{{$product->name}}</p>
                                           <p>Qty : <span>{{$product->pivot->quantity}}</span></p>
                                           <p>Price : <span>{{$product->price}}</span></p>
                                    </div>
                               </div>
                            </div>
                        </div>

                        <div class="ratingOrder">
                            <div class="TotlaAmount">
                                <h4>{{__('website.total')}} : <span>{{$order->total}} {{__('website.currency')}}</span></h4>
                            </div>
                                @if($product->currentUserHasSubmittedReview() == true)
                                    <div class="rateUs">
                                        <a name="product_id" href="#" data-toggle="modal" class="productRate" data-product-id="{{ $product->id }}" data-target="#rate">{{__('website.ratePro')}}</a>
                                    </div>
                                @else
                                       <div class="iconRate">
                                          @include('website.switchRate', array('product_rate'=>@$product->currentUserReview()->rating))
                                       </div>
                                @endif
                        </div>
                        @endforeach
                        @endforeach
                @else
                    <div class="alert alert-warning">
                        {{__('website.noResult')}}:(
                    </div>
                @endif
            </div>
            </div>
            </section>
        
         <!--end profile information-->

        <!--Start Rating Modal-->

        <div id="rate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-person" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-details">
                            <h4 class="titleRate">{{__('website.ratePro')}}</h4>
                            <div class="col-md-6">
                                    <select class="form-control" id="rating" name="rating">
                                        <option value="">{{__('website.select')}}</option>
                                        @for ($i=1; $i <= 6 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                            </div>
                            <div class="btnSend">
                                <textarea id="comment" name="comment"  value="{{ old('comment') }}"
                                          placeholder="{{__('website.writeReview')}}">{{ old('comment') }}</textarea>
                            </div>
                            <div class="sentMessage"><button id="sendRate" class="btn sending">{{__('website.send')}}</button></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end Rating Modal-->
@endsection

@section('script')

    <script>
        $(document).on('click','#sendRate', function(e){
            e.preventDefault();
            var comment = $('#comment').val();
            var rating = $('#rating').val();
            var product_id = $('.productRate').data("product-id");
            var url = '{{url(getLocal()."/rate")}}' ;
            var csrf_token = '{{csrf_token()}}';
            if(comment == "" || rating == "" ){
                if(comment == "")$('#comment').css("border", "red solid 1px");
                if(rating == "")$('#rating').css("border", "red solid 1px");
                return false;
            }
            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {comment: comment,rating: rating, _token: csrf_token, product_id: product_id},
                success: function (response) {
                    if (response.status === 'done') {
                        $('#comment,#rating').val("");
                        $('#rate').modal('hide');
                        var successAlert='{{__('website.successReview')}}';
                        alert(successAlert);
                    }
                    else if(response.status === 'error'){
                        $('#rate').modal('hide');
                        var failAlert='{{__('website.failReview')}}';
                        alert(failAlert);
                    }
                },
                error: function (e) {
                    // swal('exception', {icon: "error"});
                }
            });
        });
    </script>

@endsection