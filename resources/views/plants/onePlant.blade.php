@extends('layouts.main')
@section('content')
<div class="div-box mb mt">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-slider">
                    <div id="sync1" class="owl-carousel owl-template">
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="1080"
                                    height="768" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="1080"
                                    height="768" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="1080"
                                    height="768" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="1080"
                                    height="768" /></figure>
                        </div>
                    </div>
                    <div id="sync2" class="owl-carousel owl-template">
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="180"
                                    height="130" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="180"
                                    height="130" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="180"
                                    height="130" /></figure>
                        </div>
                        <div class="item">
                            <figure><img src="/Images/Small/{{$onePlant->photoSmallPath}}" alt="slide" width="180"
                                    height="130" /></figure>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <div class="summary-product entry-summary">
                        <h2 class="product_title mb-45">{{$onePlant->name}}</h2>
                        <div>
                            <p class="price">Краткое описание</p>
                        </div>
                        <div class="product-single-short-description">
                            <p>{{$onePlant->shortInfo}}</p>
                        </div>
                        @auth
                        <div class="yith-wcwl-add-to-wishlist">
                            <div class="yith-wcwl-add-button show">
                                <a href="{{route('addPlantToFavor', ['userId'=>Auth::user()->id, 'plantId'=>$onePlant->id])}}"
                                    class="add_to_wishlist">
                                    <i class="fa fa-heart-o"></i>
                                    Добавить в избранное
                                </a>
                            </div>
                        </div>
                        @endauth
                        <div class="product_meta"><span class="product-stock-status-wrapper">
                            <span class="tagged_as">
                                <label>Теги:</label>
                                @foreach($onePlant->tags as $tag)
                                <a href="#">{{$tag}}</a>
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="div-box mt mb">
    <div class="product-begreen-tabs">
        <div class="container">
            <div class="row">

                <div class="col-md-10 col-sm-12">
                    <div class="desc-review-content tab-content clearfix">
                        <div id="tab-description" class="tab-pane active">
                            <h2 class="mb-20">Подробное описание продукта</h2>
                            <p>{{$onePlant->fullInfo}}</p>
                        </div>
                        <div id="tab-reviews" class="tab-pane dib-none">
                            <div id="reviews" class="product-begreen-reviews">
                                <div id="comments">
                                    <h2 class="product-begreen-reviews-title">Reviews</h2>
                                    <p class="product-begreen-noreviews">There are no reviews yet.</p>
                                </div>
                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">
                                            <h3 id="reply-title" class="comment-reply-title">Be the first to review “The
                                                Calvert with Succulents” <small></small></h3>
                                            <form id="commentform" class="comment-form">
                                                <div class="comment-notes"><span id="email-notes">Your email address
                                                        will not be published.</span> Required fields are marked <span
                                                        class="required">*</span></div>
                                                <div class="comment-form-rating mb-20 mt-20">
                                                    <label>Your Rating</label>
                                                </div>
                                                <div class="star-rating"><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                                <div class="comment-form-comment">
                                                    <label class="mb-20 mt-20">Your Review *</label>
                                                    <textarea id="comment" name="comment" cols="45" rows="8"
                                                        required=""></textarea>
                                                </div>
                                                <div class="comment-fields-wrap">
                                                    <div class="comment-fields-inner clearfix">
                                                        <p class="comment-form-author">
                                                            <label class="mb-20 mt-20">Name *</label>
                                                            <input id="author" type="text" />
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label class="mb-20 mt-20">Email *</label>
                                                            <input id="email" name="email" size="30" required=""
                                                                type="email" />
                                                        </p>
                                                        <p class="form-submit mt-20">
                                                            <input id="submit" name="submit" value="Submit"
                                                                type="submit" class="submit" />
                                                        </p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><a href="{{route('plant.edit', ['id' => $onePlant->id])}}" class="btn btn-primary"
                style="float: right">Редактировать</a><br><br><br>
        </div>
    </div>
</div>

@endsection
