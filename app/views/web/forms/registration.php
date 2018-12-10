<form name="GetAuth" action="/api/activation" method="post" class="form-horizontal" style="margin: 10% auto 0 auto; max-width: 90%">
    <fieldset>

            <strong><center id="receivedMessage" style="height:20px"></center></strong>
            <br>

            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Ключ продукта:</label>
                <div class="col-md-4">
                    <input maxlength="32" name="activationKey" type="text" placeholder="Введите 12-значный ключ продукта" class="form-control input-md" required="">
                </div>

            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <a href="/" id="singleButtonAuthorization" class="btn btn-danger">Авторизация</a>
                    <input type="button" id="singleButtonActivation" class="btn btn-primary" value="Активировать" />
                </div>
            </div>


    </fieldset>
</form>

</div>