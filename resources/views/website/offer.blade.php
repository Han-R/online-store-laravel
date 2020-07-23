@extends('layouts.websiteLayout')
@section('head')
    <title>{{__('website.offers')}}</title>
@endsection

@section('body')
    <!--Start Electronic page-->

    <div id="electronic">

        <div class="container">
            <div class="sortElectronic">
                <div class="sort">
                    <span class="sortBy">{{__('website.sort_by')}}</span>
                    <ul>
                        <li class="dropdown">
                            {{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{__('website.department')}} <span class="ti-angle-down"></span></a>--}}
                            <div>

                                <select class="form-control" id="department_id" name="department_id">
                                    <option value="0">{{__('website.all')}} </option>
                                    @foreach($departments as $department)
                                        <option {{ request()->department_id==$department->id?"selected":"" }} value="{{ $department->id }}">{{$department->name}} </option>
                                    @endforeach
                                </select>

                            </div>
                        </li>
                        {{--                        <li class="dropdown">--}}
                        {{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{__('website.category')}}<span class="ti-angle-down"></span></a>--}}
                        {{--                            <div class="dropdown-menu dropdown-menu_st3">--}}
                        {{--                                <ul class="drop_button">--}}
                        {{--                                    @foreach($categories as $category)--}}
                        {{--                                        <li href="#">{{$category->name}}</li>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>


        <div class="container">
            @if($offers->total()>0)
                <div class="row">
                    @foreach($offers as $item)
                        <div class="col-md-3">
                            <a data-id="{{$item->id}}" class="countClick" class="link" href="{{url(getLocal().'/product/'.$item->id)}}">
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
                                        <div class="star">
                                            @include('website.switchRate', array('product_rate'=>$item->rating_cache))
                                        </div>
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
                    {{ $offers->appends($_GET)->links() }}
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

    <script>
        $(document).on('change','#department_id', function(event) {
            // event.preventDefault();
            var department_id= $(this).val();
            var csrf_token = '{{csrf_token()}}';
            $.ajax({
                type:'GET',
                headers: {'X-CSRF-TOKEN': csrf_token},
                success: function(response){
                    window.location.href = '{{url(getLocal()."/offers")}}/'+department_id;
                }
            });
        });
    </script>

@endsection