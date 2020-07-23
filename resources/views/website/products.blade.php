@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.products')}}</title>
@endsection

@section('body')

    <div id="electronic">
        
        <div class="container">
            @if($items->total()>0)
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-3">
                        <a data-id="{{$item->id}}" class="countClick" href="{{url(getLocal().'/product/'.$item->id)}}">
                            <div class="productDetails">
                                <img style="width: 300px; height: 200px" src="{{$item->image}}" class="image">
                                <div class="information">
                                    <p class="name">{{$item->name}}</p>
                                    <p class="details">{{ strip_tags( $item->details ) }}</p>
                                    @if($item->discount == 0)
                                        <p class="Number">{{$item->price}} {{__('website.currency')}}</p>
                                    @else
                                        <?php
                                        $price = $item->price;
                                        $discount = ($price * $item->discount)/100;
                                        $newPrice = $price -  $discount ;
                                        ?>
                                        <div class="discountNumber">
                                            <span class="price">{{$item->price}} {{__('website.currency')}}</span>
                                            <span class="spanNumber"> {{$newPrice}} {{__('website.currency')}}</span>
                                        </div>
                                    @endif
                                    @include('website.switchRate', array('product_rate'=>$item->rating_cache))
                                </div>
                                <div class="shop">
                                    <a data-id="{{$item->id}}" class="countClick" href='{{ route("showProductDetailsPage", ["id" => $item->id]) }}' ><i class="ti-shopping-cart"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
                <nav>
                    {{ $items->links() }}
                </nav>

            @else
                <div class="alert alert-warning">
                    {{__('website.noResult')}}:(
                </div>
            @endif
        </div>
    </div>

    <!--End Electronic page-->
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