@extends('layouts.main')
@section('content')
    <script type="text/javascript" src="{{ asset('libs/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <div class="div-box">
        <div class="home-4-new-collections">
            <div class="container">
                <h2 class="title-style title-style-1 text-center"><span class="title-left">Каталог </span><span
                        class="title-right"> Комнатных растений</span></h2>
                <div data-js-module="filtering-demo" class="big-demo go-wide">
                    <div class="filter-button-group button-group js-radio-button-group container">
                        <button data-filter="*" class="button is-checked" title='Показать все растения'>Все</button>
                        @foreach($tagsList as $tag)
                            <button data-filter=".{{$tag}}" class="button">{{$tag}}</button>
                        @endforeach
                    </div>
                    <!-- Проверка на добавление -->
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}}</div>
                    @endif
                    @if($search !== null)
                        <h1>Результаты поиска для "{{$search}}"</h1>
                        <BR>
                    @endif
                    <ul class="grid shortcode-product-wrap product-begreen columns-4">
                        @forelse ($plantsList as $plant)
                            <li data-category="outdoor"
                                class="element-item product-item-wrap product-style_1 {{$plant->tagsList}}">
                                <div class="product-item-inner">
                                    <div class="product-thumb">
                                        <div class="product-flash-wrap"></div>
                                        <div class="style-img-div">
                                            <img src="/Images/Small/{{$plant->photoSmallPath}}" alt="product1"
                                                 class="style-img"/>
                                        </div>
                                        <a href="{{route('onePlant', ['id' => $plant->id])}}" class="product-link">
                                            <div class="product-hover-sign">
                                                <hr/>
                                                <hr/>
                                            </div>
                                        </a>
                                        <div class="product-info">
                                            <div class="star-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <a href="#">
                                                <h3>{{$plant->name}}</h3>
                                            </a>
                                            <span class="price">
                                        <span class="product-begreen-price-amount amount">{{$plant->shortInfo}}</span>
                                    </span>
                                        </div>

                                        <div class="product-actions">
                                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-17">
                                                <div class="yith-wcwl-add-button show">

                                                    <a href="#" class="add_to_wishlist"
                                                       data-id="{{$plant->id}}"
                                                       data-isfavor="{{$plant->isFavor}}"
                                                       @auth
                                                       data-isauth="{{Auth::user()->id}}"
                                                       @else
                                                       data-isauth="0"
                                                        @endauth
                                                    >
                                                        <i @if($plant->isFavor) class="fa fa-heart" aria-hidden="true"
                                                           @else class="fa fa-heart-o" @endif}}></i> Добавить в
                                                        избранное</a>
                                                </div>
                                            </div>
                                            <div class="yith-wcwl-add-button show">
                                                <a href="{{route('onePlant', ['id' => $plant->id])}}"
                                                   class="product-quick-view">
                                                    <i class="fa fa-search"></i>
                                                    Quick view
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <h2>Что-то сломалось =(</h2>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('.add_to_wishlist').click(function (e) {
            e.preventDefault();
            let isAuth = $(this).data("isauth");
            if (isAuth === 0) {
                $('#registerModal').modal('show');
            }
            else {
                let isFavor = +$(this).data("isfavor");
                let url = '';
                if (isFavor === 1)
                    url = "{{route('plant.removeFavor', ['userId'=> 'user_id_val', 'plantId'=>'plant_id_val'])}}";
                else
                    url = "{{route('plant.addFavor', ['userId'=> 'user_id_val', 'plantId'=>'plant_id_val'])}}";

                url = url.replace('user_id_val', isAuth);
                url = url.replace('plant_id_val', $(this).data("id"));
                let element = $(this);
                let child = $(this).children('i').first();

                $('#modal-title').text("Избранные растения");

                $.ajax({
                    url: url,
                    success: function (data) {
                        console.log(url);
                        child.removeAttr('class');
                        child.removeAttr('aria-hidden');

                        if (isFavor === 1) {
                            child.addClass("fa fa-heart-o");
                            element.data("isfavor", 0);
                            $('#modalText').text("Удалено из избранного");
                            $('#favorModal').modal('show');
                            setTimeout(function(){
                                $('#favorModal').modal('hide');
                            }, 1500);


                        } else {
                            child.addClass("fa fa-heart");
                            child.attr("aria-hidden", "true");
                            element.data("isfavor", 1);
                            $('#modalText').text("Добавлено в избранное");
                            $('#favorModal').modal('show')
                            setTimeout(function(){
                                $('#favorModal').modal('hide');
                            }, 1500);
                        }

                    }
                });
            }
        });
    </script>
@endsection
