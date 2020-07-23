@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.subCategory')}}</title>
@endsection

@section('body')

    <!--Start slider offers-->
        
            <section id="offers">
                <div class="owl-carousel owl-theme">
                    @foreach($offers as $offer)
                        <div class="item" data-merge="6">
                            <img src="{{$offer->image}}">
                            <div class="caption vertical-center text-left"><h1>{{$offer->discount}}% {{__('website.off')}}</h1></div>
                        </div>
                    @endforeach
                </div>
            </section>
            
        <!--End Slider offers-->
            
        
        <!--Start viewers-->

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
        
        <!--End viewers-->
             
        <!--Start Shop Category-->
        
            <section id="shopCategory">
                <div class="container">
                     <h1>{{__('website.shop_category')}}</h1>
                    <div class="row">
                        @foreach($items as $item)
                            @if($item->subCategories->count()>0)
                                @foreach($item->subCategories as $subCategory)
                                    <div class="col-md-6">
                                        <div class="category">
                                            <div class="type laptop"style="background-image: url({{url($subCategory->icon)}})">
                                                <div class="details">
                                                    <h2>{{$subCategory->name}}</h2>
                                                  <a href="{{url(getLocal().'/products/'.$subCategory->id)}}">{{__('website.view_all')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        
        <!--End Shop Category-->
    
@endsection

@section('script')

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