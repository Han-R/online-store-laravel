@extends('layouts.websiteLayout')
@section('head')
    <title> </title>
@endsection

@section('body')
        
        <!--Start overview tabs-->
        
            <section id="reviews">
                <div class="container">
                   <div class="Tabs">
                      <div class="container">
                          <h3 class="titleReview">{{__('website.review')}}</h3>
                          @if($reviews->count()>0)
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
                                <time class="Date">{{$review->created_at->format('j-F-Y')}}</time>
                            </div>
                            <p class="info">{!! $review->comment !!}}</p>
                        </div>
                          </div>
                              @endforeach
                                  <nav>
                                      {{$reviews->links()}}
                                  </nav>
                           @else
                                      <div class="alert alert-warning">
                                          {{__('website.noResult')}}:(
                                      </div>
                           @endif

                        </div>
                        
                    </div>
                </div><!--container-->
            </section>
        
        <!--End overview tabs-->


@endsection

@section('script')

@endsection