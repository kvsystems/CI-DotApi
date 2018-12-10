<form action="" method="post" class="form-horizontal" style="margin: 15% auto 0 auto; max-width: 80%">
    <fieldset>


        <strong><center id="receivedMessage" style="height:20px"></center></strong>
        <br>

        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Ваш логин:</label>
            <div class="col-md-4">
                <input id="login" name="login" type="text" placeholder="Введите логин" class="form-control input-md" required="">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Ваш пароль:</label>
            <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="Введите пароль..." class="form-control input-md" required="">

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <a href="/register" id="singleButtonAccess" class="btn btn-success">Получить доступ</a>
                <input type="button" id="singleButtonAuthorization" class="btn btn-primary" value="Войти" />
            </div>
        </div>

    </fieldset>

</form>

</div>