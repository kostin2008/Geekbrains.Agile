@extends('layouts.admin')
@section('content')
    <div class="col-md-4  offset-2">
        <form method="post"
              @if(empty($plants))
              action="{{route('admin::plants::create')}}"
              @else
              action="{{route('admin::plants::update', ['id' => $plants->id])}}"
              @endif
              enctype="multipart/form-data">
            <input type="file" class="form-control" name="photoSmallPath" placeholder="photoSmallPath"
                   value="{{$plants->photoSmallPath ?? ''}}" style="display: none;">
            <input type="file" class="form-control" name="photoBigPath" placeholder="photoBigPath"
                   value="{{$plants->photoBigPath ?? ''}}" style="display: none;">
            @csrf
            <div class=" div-box mb mt">
                <div class="container">
                    <h1 id="name">Редактировать растение<span></span></h1><br><br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="single-product-slider">
                                <div id="sync1" class="owl-carousel owl-template">
                                    @if(!empty($plants->photoSmallPath))
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <figure><img src="/Images/Big/{{$plants->photoBigPath ?? ''}}" alt="slide"--}}
                                        {{--                                                         width="1080" height="768"/></figure>--}}
                                        {{--                                        </div>--}}
                                </div>
                                <div id="sync2" class="owl-carousel owl-template">
                                    <div class="item">
                                        <figure><img src="/Images/Small/{{$plants->photoSmallPath ?? ''}}" alt="slide"
                                                     width="180"
                                                     height="130"/></figure>
                                    </div>
                                    @else
                                        <p>Нет картинок</p>
                                    @endif
                                </div>
                            </div>
                            <h2>Добавить фото</h2>
{{--                            <form action="" enctype="multipart/form-data" method="post">  <!--обязательно должно быть прописано-->--}}
                                <input type="file" name = 'photo' id="file">
                            <span id="newFile"></span>
{{--                                <input type="submit">--}}
{{--                            </form>--}}
                        </div>
                        <div class="col-md-7">
                            <div class="single-product-content">
                                <div class="summary-product entry-summary">
                                    <label for="name1">
                                        <h3>Название растения</h3><br>
                                    </label>
                                    <input id="name1" type="text" class="form-control" name="name" placeholder="name"
                                           value="{{$plants->name ?? ''}}">
                                    <label for="shortInfo">
                                        <br>
                                        <h3>Короткое описание продукта</h3><br>
                                    </label>
                                    <div class="product-single-short-description">
                                        <p><input id="shortInfo" type="text" class="form-control" name="shortInfo"
                                                  placeholder="shortInfo"
                                                  value="{{$plants->shortInfo ?? ''}}"></p>
                                    </div>

                                    <div class="product_meta" style="margin-top: 30px;">
                                    <span class="product-stock-status-wrapper" style="display: flex;">
                                        <label for="start" style="align-self: center; width: 100%;">
                                            Дата старта для расчёта календаря:
                                        </label>
                                        <span class="product-stock-status in-stock">
                                            <input id="start" type="date" class="form-control" name="addDate"
                                                   placeholder="addDate"
                                                   value="{{$plants->addDate ?? ''}}" style="width: min-content;">
                                        </span>
                                    </span>
                                        <span class="posted_in" style="display: flex;">
                                        <label for="wateringDays" style="align-self: center; width: 100%;">
                                            Частота полива:
                                        </label>
                                            <input id="wateringDays" type="number"
                                                   value="{{$plants->wateringDays ?? ''}}" name="wateringDays">

                                        </span>

                                        <span class="posted_in" style="display: flex;">
                                        <label for="manuringDays" style="align-self: center; width: 100%;">
                                            Период подкормки (дн.):
                                        </label>
                                            <input id="wateringDays" type="number"
                                                   value="{{$plants->manuringDays ?? ''}}" name="manuringDays">
                                        </span>
                                        <span class="posted_in" style="display: flex;">
                                        <label for="pestControlDays" style="align-self: center; width: 100%;">
                                            Период обработки от вредителей (дн.):
                                        </label>
                                            <input id="wateringDays" type="number"
                                                   value="{{$plants->pestControlDays ?? ''}}" name="pestControlDays">
                                        </span>

                                        <span class="posted_in" style="display: flex;">
                                        <label for="tags" style="align-self: center; width: 100%;">
                                            Теги:
                                        </label>
                                            <ul>
                                                @forelse($tags as $key => $tag)
                                                    <li><input type="checkbox" name="tag{{$key}}" value="{{$tag}}"
                                                               @if(!empty($plantTags))
                                                               @foreach ($plantTags as $tagPlants)
                                                               @if($tag == $tagPlants)checked
                                                                        @endif
                                                            @endforeach
                                                            @endif
                                                    >{{$tag}}</li>
                                                @empty
                                                    <p>Тегов нет</p>
                                                @endforelse

                                            </ul>
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
                                        <label for="fullInfo">
                                            <h3>Подробное описание продукта</h3><br>
                                        </label>
                                        <textarea rows="7" cols="30" style="width:95%;" class="form-control"
                                                  name="fullInfo"
                                                  value="{{$plants->fullInfo ?? ''}}">{{$plants->fullInfo ?? ''}}</textarea>
                                    <!-- <h2 class="mb-20">Подробное описание продукта</h2>
                                    <p><input type="text" class="form-control" name="fullInfo" placeholder="fullInfo"
                                            value="{{$plants ->fullInfo ?? ''}}"></p> -->
                                    </div>
                                    {{--                                    <br /><input class="btn btn-primary" style="float: right" type="submit"--}}
                                    {{--                                                 value="Сохранить"><br><br><br><br>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br/><input class="btn btn-primary" style="float: right" type="submit"
                        value="Сохранить"><br><br><br><br>

        <!-- <p><input type="text" class="form-control" name="title" placeholder="Заголовок" value="{{$plants->name ?? ''}}">
                <button type="submit" class="btn btn-success">Сохранить</button> -->
        </form>
    </div>


@endsection
