@extends('layouts.websiteLayout')
@section('head')
    <title>B1{{__('website.store')}}</title>
@endsection

@section('body')
    <!--Start slider-->

    <section id="slider">
        <div class="owl-carousel owl-theme">
            @foreach($sliders as $slider)
                <div class="item" data-merge="6">
                    <img src="{{$slider->image}}">
                    <div class="item-caption">
                        <h1>{{$slider->title}}</h1>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!--End Slider-->


    <!-- Start product-->

    <section id="recommend">
        <h1 class="title">{{__('website.RecommendedForYou')}}</h1>
        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme car">
                    @forelse($recommended_products as $product)
                        <div class="item" style="width:360px">
                            <a data-id="{{$product->id}}" class="countClick" href="{{url(getLocal().'/product/'.$product->id)}}">
                                <div class="productDetails">
                                    <img src="{{$product->image}}" class="img-fluid" alt=" ">
                                    <div class="information">
                                        <p class="name">{{$product->name}}</p>
                                        <p class="details"><?php echo $details=strip_tags(html_entity_decode($product->details));?></p>
                                        @if($product->discount == 0)
                                            <p class="price">{{$product->price}} {{__('website.currency')}}</p>
                                        @else
                                            <?php
                                            $price = $product->price;
                                            $discount = ($price * $product->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <div class="discountNumber">
                                                <span class="price">{{$product->price}} {{__('website.currency')}}</span>
                                                <span class="spanNumber">{{$newPrice}} {{__('website.currency')}}</span>
                                            </div>
                                        @endif
                                        @include('website.switchRate', array('product_rate'=>$product->rating_cache))
                                    </div>
                                    <div class="shop">
                                        <a data-id="{{$product->id}}" class="countClick" href='{{ route("showProductDetailsPage", ["id" => $product->id]) }}' ><i class="ti-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @empty
                        <div class="alert alert-warning">
                            {{__('website.noResult')}}:(
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </section>

    <!-- End product-->

    <!--Start copone-->

    <section id="copon">

        <div class="container">
            <div class="row">
                @if($discountProducts->count()==3 || $discountProducts->count()>3)
                    <div class="col-md-5">
                        <div class="images">
                            <div class="imgCopone">
                                <a data-id="{{$discountProducts[0]->id}}" class="countClick" href="{{url(getLocal().'/product/'.$discountProducts[0]->id)}}">
                                    <img src="{{$discountProducts[0]->image}}" class="imgOne">
                                    <p class="discount number1">{{$discountProducts[0]->discount}}% {{__('website.off')}}</p>
                                </a>
                            </div>
                            <div class="imgCopone">
                                <a data-id="{{$discountProducts[1]->id}}" class="countClick" href="{{url(getLocal().'/product/'.$discountProducts[1]->id)}}">
                                    <img src="{{$discountProducts[1]->image}}" class="imgOne">
                                    <p class="discount number2">{{$discountProducts[1]->discount}}% {{__('website.off')}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="imgCopone">
                            <a data-id="{{$discountProducts[2]->id}}" class="countClick" href="{{url(getLocal().'/product/'.$discountProducts[2]->id)}}">
                                <img src="{{$discountProducts[2]->image}}" class="imgThree">
                                <p class="discount number3">{{$discountProducts[2]->discount}}% {{__('website.off')}}</p>
                            </a>
                        </div>
                    </div>
                @elseif($discountProducts->count()<3 && $discountProducts->count()>0)
                    <div class="col-md-5">
                        <div class="images">
                            @foreach($discountProducts as $discountProduct)
                                <div class="imgCopone">
                                    <a data-id="{{$discountProduct->id}}" class="countClick" href="{{url(getLocal().'/product/'.$discountProduct->id)}}">
                                        <img src="{{$discountProduct->image}}" class="imgOne">
                                        <p class="discount number1">{{$discountProduct->discount}}% {{__('website.off')}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        {{__('website.noResult')}}:(
                    </div>
                @endif
            </div>
        </div>

    </section>

    <!--End Copone-->


    <!--Start slider2-->

    <section id="recommend">
        <div class="viewElectronic">
            <h1 class="titleViews">{{__('website.topViews')}}</h1>
            <a href="" class="view">{{__('website.view_all')}}</a>
        </div>

        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme car">
                    @forelse($topViews as $topView)
                        <div class="item" style="width:360px">
                            <a data-id="{{$topView->id}}" class="countClick" href="{{url(getLocal().'/product/'.$topView->id)}}">
                                <div class="productDetails">
                                    <img src="{{$topView->image}}" class="img-fluid" alt=" ">
                                    <div class="information">
                                        <p class="name">{{$topView->name}}</p>
                                        <p class="details"><?php echo $details=strip_tags(html_entity_decode($topView->details));?></p>
                                        @if($topView->discount == 0)
                                            <p class="price">{{$topView->price}} {{__('website.currency')}}</p>
                                        @else
                                            <?php
                                            $price = $topView->price;
                                            $discount = ($price * $topView->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <div class="discountNumber">
                                                <span class="price">{{$topView->price}} {{__('website.currency')}}</span>
                                                <span class="spanNumber"> {{$newPrice}} {{__('website.currency')}}</span>
                                            </div>
                                        @endif
                                        @include('website.switchRate', array('product_rate'=>$topView->rating_cache))
                                    </div>
                                    <div class="shop">
                                        <a data-id="{{$topView->id}}" class="countClick" href='{{ route("showProductDetailsPage", ["id" => $topView->id]) }}' ><i class="ti-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @empty
                        <div class="alert alert-warning">
                            {{__('website.noResult')}}:(
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </section>

    <!--End Slider2-->

    <!--Start slider2-->

    <section id="recommend">
        <div class="viewElectronic">
            <h1 class="titleViews">{{__('website.topSales')}}</h1>
            <a href="" class="view">{{__('website.view_all')}}</a>
        </div>

        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme car">
                    @forelse($topSales as $topSale)
                        <div class="item" style="width:360px">
                            <a data-id="{{$topSale->id}}" class="countClick" href="{{url(getLocal().'/product/'.$topSale->id)}}">
                                <div class="productDetails">
                                    <img src="{{$topSale->image}}" class="img-fluid" alt=" ">
                                    <div class="information">
                                        <p class="name">{{$topSale->name}}</p>
                                        <p class="details"><?php echo $details=strip_tags(html_entity_decode($topSale->details));?></p>
                                        @if($topSale->discount == 0)
                                            <p class="price">{{$topSale->price}} {{__('website.currency')}}</p>
                                        @else
                                            <?php
                                            $price = $topSale->price;
                                            $discount = ($price * $topSale->discount)/100;
                                            $newPrice = $price -  $discount ;
                                            ?>
                                            <div class="discountNumber">
                                                <span class="price">{{$topSale->price}} {{__('website.currency')}}</span>
                                                <span class="spanNumber"> {{$newPrice}} {{__('website.currency')}}</span>
                                            </div>
                                        @endif
                                        @include('website.switchRate', array('product_rate'=>$topSale->rating_cache))
                                    </div>
                                    <div class="shop">
                                        <a data-id="{{$topSale->id}}" class="countClick" href='{{ route("showProductDetailsPage", ["id" => $topSale->id]) }}' ><i class="ti-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @empty
                        <div class="alert alert-warning">
                            {{__('website.noResult')}}:(
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </section>

    <!--End Slider2-->


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