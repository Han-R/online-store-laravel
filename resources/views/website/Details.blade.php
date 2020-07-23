@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.product_detail')}}</title>
@endsection

@section('css')

@endsection

@section('body')
        <!--start information product-->
        
        <section id="informationProduct">
            <div class="container">
                <div>
                        <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}" />
                    <input type="hidden" id="product_quantity" name="product_quantity" value="{{$stock->quantity}}" />

                    <div class="col-md-6">
                        <div class="productImage">
                            <img src="{{$item->image}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="Information">
                            <p class="heading">{{$item->name}}</p>
                            <h3>{!! $item->details !!}</h3>
                            @if($item->rating_cache==0)
                                <p class="Number">{{__('website.no_rate')}}</p>
                            @else
                                <div class="star">
                                    @include('website.switchRate', array('product_rate'=>$item->rating_cache))
                                </div>
                            @endif
                            <div class="sortElectronic">
                                    <div class="namePage"><p class="title">{{$item->department->name}}</p><span class="ti-angle-right"></span><p class="subTitle">{{$item->category->name}}</p><span class="ti-angle-right"></span><p class="subTitle">{{$item->sub_category->name}}</p></div>
                            </div>
                             <div class="offers">
                                 @if($item->discount == 0)
                                     <p class="Number">{{$item->price}} {{__('website.currency')}}</p>
                                 @else
                                     <?php
                                         $price = $item->price;
                                         $discount = ($price * $item->discount)/100;
                                         $newPrice = $price -  $discount ;
                                     ?>
                                     <p class="delete">{{$item->price}} {{__('website.currency')}}</p>
                                    <p class="Number">{{$newPrice}} {{__('website.currency')}}</p>
                                  @endif
                            </div>
                            
                            <h5>{{__('website.quantity')}}</h5>
                            <div class="quality">
                               <div class="qty mt-5">
                                    <span class="minus bg-dark">-</span>
                                   @if($stock->quantity==0)
                                    <input type="number" class="count" name="quantity" id="quantity" value="0">
                                   @else
                                       <input type="number" class="count" name="quantity" id="quantity" value="1">
                                   @endif
                                    <span class="plus bg-dark">+</span>
                                   <br>
                                   @if($stock->quantity==0)
                                       <p class="title">{{__('website.out_of_stock')}}</p>
                                   @else
                                        @if($check_cart)
                                            <button disabled id="addToCartForm" class="cart" ><i class="ti-shopping-cart"></i>{{__('website.added')}}</button>
                                        @else
                                            <button id="addToCartForm" class="cart" ><i class="ti-shopping-cart"></i>{{__('website.addToCart')}}</button>
                                        @endif
                                   @endif
                                   @if($check_whishlist)
                                        <button disabled id="addToWhishlist" class="cart" ><i class="icon-heart"></i>{{__('website.added')}}</button>
                                   @else
                                        <button id="addToWhishlist" class="cart" ><i class="icon-heart"></i>{{__('website.addToWishlist')}}</button>
                                   @endif

                                   <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                   <h4 class="modal-title">{{__('website.login')}}</h4>
                                               </div>
                                               <div class="modal-body">
                                                   <p>{{__('website.action')}} </p>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn default" data-dismiss="modal" aria-hidden="true">{{__('common.cancel')}}</button>
                                                   <a href="{{route('userLogin')}}" >
                                                       <button class="btn btn-info">{{__('website.login')}}</button>
                                                   </a>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--End information product-->


        <!--Start overview tabs-->

            <section id="reviews">
                <div class="container">
                   <div class="Tabs">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{__('website.overview')}}</a></li>
                    <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">{{__('website.review')}}</a></li>

                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="overview">
                        <h5 class="heading">{{__('website.highlights')}}</h5>
                        <ul class="tabList">
                            <li>{!! $item->details !!}</li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="rating">
                      <div class="container">
                           <div class="tabReview">
                               <div class="row">
                                <div class="col-md-4">
                                    <div class="rating">
                                        <p class="rate">{{__('website.overrating')}}</p>
                                        <p class="rang">{{$item->rating_cache}}</p>
                                        <p class="reviewsNumber">{{__('website.basedOn')}} {{$item->rating_count}} {{__('website.reviews')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stander">
                                        <p>{{__('website.rate')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stander">
                                        <div>
                                            @include('website.switchRate', array('product_rate'=>$item->rating_cache))
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                          @foreach($reviews as $review)
                          <div class="allComment">
                            <div class="comment">
                                <div>
                                    @include('website.switchRate', array('product_rate'=>$review->rating))
                                </div>

                            <div>
                                <h6 class="nameWriter">{{ $review->user ? $review->user->name : 'Anonymous'}}</h6>
                                <time class="Date">{{$review->timeago}}</time>
                            </div>
                            <p class="info">{!! $review->comment !!}}</p>
                        </div>
                          </div>
                          @endforeach
                            <a href="{{ route("showReviews", ["id" => $item->id]) }}" class="seeAll">{{__('website.seeReview')}}</a>
                        </div>
                    </div>

              </div>

                    </div>
                </div><!--container-->
            </section>

        <!--End overview tabs-->


        <!-- Start viewers-->

            <section id="viewers">
                <div class="container">
                  <h1 class="titleView">{{__('website.viewed_product')}}</h1>
                    <div class="row">
                            <div class="owl-carousel owl-theme car">
                              @foreach($viewed_products as $viewed_product)
                                    <div class="item" style="width:360px">
                                        <a data-id="{{$viewed_product->id}}" class="countClick" href="{{url(getLocal().'/product/'.$viewed_product->id)}}">
                                            <div class="productDetails">
                                                <img src="{{$viewed_product->image}}" class="image">
                                                <div class="information">
                                                    <p class="name">{{$viewed_product->name}}</p>
                                                    <p class="details">{{ strip_tags( $viewed_product->details ) }}</p>
                                                    @if($viewed_product->discount == 0)
                                                        <p class="price">{{$viewed_product->price}} {{__('website.currency')}}</p>
                                                    @else
                                                        <?php
                                                        $price = $viewed_product->price;
                                                        $discount = ($price * $viewed_product->discount)/100;
                                                        $newPrice = $price -  $discount ;
                                                        ?>
                                                        <div class="discountNumber">
                                                            <span class="price">{{$viewed_product->price}} {{__('website.currency')}}</span>
                                                            <span class="spanNumber"> {{$newPrice}} {{__('website.currency')}}</span>
                                                        </div>
                                                    @endif
                                                    @include('website.switchRate', array('product_rate'=>$viewed_product->rating_cache))
                                                </div>
                                                <div class="shop">
                                                    <a data-id="{{$viewed_product->id}}" class="countClick" href='{{ route("showProductDetailsPage", ["id" => $viewed_product->id]) }}' ><i class="ti-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                              @endforeach
                            </div>
                    </div>
                </div>

            </section>

        <!-- End viewers-->
@endsection

@section('script')
    <script>
        $(document).on('click','#addToCartForm', function(e){
            e.preventDefault();
            var product_id = $('#product_id').val();
            var product_quantity = $('#product_quantity').val();
            var quantity = $('#quantity').val();
            var url = '{{url(getLocal()."/addToCartFromProductPage")}}' ;
            var csrf_token = '{{csrf_token()}}';

            if(product_quantity<quantity){
                var alert_fail='{{__('website.pro_ex_qt')}}';
                alert(alert_fail);
                window.location.reload();

            }else{
            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {product_id: product_id, quantity: quantity, _token: csrf_token},
                success: function (response) {
                    if (response.status === 'done') {
                        $('#showCart').html(response.cart);
                        var text='{{__('website.added')}}';
                        var successAlert='{{__('website.successAdd')}}';
                        $('#addToCartForm').text(text);
                        alert(successAlert);
                    }
                    else if(response.status === 'alert'){
                        $("#addToCartForm").attr("disabled", true);
                        var text='{{__('website.added')}}';
                        var failAlert='{{__('website.failAdd')}}';
                        $('#addToCartForm').text(text);
                        alert(failAlert);
                    }
                },
                error: function (e) {
                    $('#myModal').modal('show');
                }
            });}
        });

        $(document).on('click','#addToWhishlist', function(e){
            e.preventDefault();
            var product_id = $('#product_id').val();
            var url = '{{url(getLocal()."/addToWishlistFromProductPage")}}' ;
            var csrf_token = '{{csrf_token()}}';

            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {product_id: product_id, _token: csrf_token},
                success: function (response) {
                    if (response.status === 'done') {
                        $('#showWishlist').html(response.wishlistt);
                        var text='{{__('website.added')}}';
                        var successAlert='{{__('website.successAdd')}}';
                        $('#addToWhishlist').text(text);
                        alert(successAlert);
                    }
                    else if(response.status === 'alert'){
                        $("#addToWhishlist").attr("disabled", true);
                        var text='{{__('website.added')}}';
                        var failAlert='{{__('website.failAdd')}}';
                        $('#addToWhishlist').text(text);
                        alert(failAlert);
                    }
                },
                error: function (e) {
                    $('#myModal').modal('show');
                }
            });
        });
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