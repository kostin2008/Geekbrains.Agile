@extends('layouts.main')
<div id="example-wrapper">
    <div class="div-box">
        <div class="slider-home slider-home-3">
            <div data-margin="100" data-loop="yes" data-navcontrol="yes">
                <div class="slider-1">
                    <div class="slider-content slider-1-content">
                        <div class="desc">Напоминания в вашем Телеграм</div>
                        <p class="plant">Для подключения уведомлений пройдите по ссылке,<br> войдите в свой аккаунт Телеграм и нажмите кнопку старт</p>
                        <p><a href="https://t.me/SsdTestBot_bot/start" class="btn btn-4" target="_blank">Активировать бота</a>
                        <p>После активации бота нажмите на кнопку ниже</p>
                        <a href="{{route('telegram.testMessage')}}" class="btn btn-5">Проверить уведомления</a>
                        <a href="{{route('telegram.notifyMe')}}" class="btn btn-5">Выслать действия на сегодня</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

