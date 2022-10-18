<div id="favorModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="modal-title" class="modal-title">Избранные растения</h4>
            </div>
            <div class="modal-body">
                <p id="modalText">One fine body&hellip;</p>
            </div>
        </div>
    </div>
</div>

<div id="registerModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="modal-title" class="modal-title">К сожалению, так не работает...</h4>
            </div>
            <div class="modal-body">
                <p id="registerText">Вам необходимо войти или зарегистрироваться на сайте, чтобы добавлять растения</p>
            </div>

            <div class="modal-footer">
                <a href="{{route('register')}}" class="btn btn-3">Регистрация</a>
                <a href="{{route('login')}}" class="btn btn-3">Войти</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
