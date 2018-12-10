<div class="alert alert-success center-block" role="alert" style="width: 98%">
    <i class="fa fa-warning"></i> <span>&nbsp;&nbsp;Добро пожаловать в систему, приятной работы с заданиями через CRUD-API</span>
</div>
<style>
    .single-icon > i {
        font-size: 30px;
        color: #fb397d;
    }
    .single-special {
        /* border: 1px solid #eff2f6; */
        padding: 27px;
        /* border-radius: 40px 40px 40px 0px; */
        -webkit-transition-duration: 800ms;
        -o-transition-duration: 800ms;
        transition-duration: 800ms;
        margin-bottom: 30px;
        /* background: #dbc8ff; */
        border: 4px solid transparent;
        -moz-border-image: -moz-linear-gradient(top, #605ca8 0%, #605ca8 100%);
        -webkit-border-image: -webkit-linear-gradient(top, #605ca8 0%, #605ca8 100%);
        border-image: linear-gradient(to right bottom, #605ca8 0%, #605ca8 50%, #605ca8 100%);
        border-image-slice: 40%;
        transition: linear all .3s;
    }
    .single-special a {
        font-size: 18px;
    }

    #modal_form {
        width: 500px;
        height: 400px;
        border-radius: 5px;
        border: 3px #000 solid;
        background: #fff;
        position: fixed;
        top: 45%;
        left: 50%;
        margin-top: -150px;
        margin-left: -150px;
        display: none;
        opacity: 0;
        z-index: 5;
        padding: 20px 10px;
    }

    #modal_form #modal_close {
        width: 21px;
        height: 21px;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        display: block;
    }

    #overlay {
        z-index:3;
        position:fixed;
        background-color:#000;
        opacity:0.8;
        -moz-opacity:0.8;
        filter:alpha(opacity=80);
        width:100%;
        height:100%;
        top:0;
        left:0;
        cursor:pointer;
        display:none;
    }


</style>
<center><b><div id="response"></div></b></center>
<div class="row center-block" style="width: 98%">

    <form class="navbar-form navbar-left" role="search" style="margin-left: 2%">
        <div class="form-group">
            <input id="searchField" type="text" class="form-control" placeholder="Поиск..." style="width: 450px">
        </div>
        <button id="searchButton" type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </form>

    <div id="modal_form">
        <span id="modal_close">X</span>

        <div class="form-group">
            <label for="titleTask" class="cols-sm-2 control-label">Заголовок:</label>
            <div class="cols-sm-10">
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input disabled type="text" class="form-control" name="titleTask" id="titleTask" value=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="dateTask" class="cols-sm-2 control-label">Дата выполнения:</label>
            <div class="cols-sm-10">
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input disabled type="text" class="form-control" name="dateTask" id="dateTask" value=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="authorTask" class="cols-sm-2 control-label">Автор:</label>
            <div class="cols-sm-10">
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input disabled type="text" class="form-control" name="authorTask" id="authorTask" value=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="statusTask" class="cols-sm-2 control-label">Статус:</label>
            <div class="cols-sm-10">
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input disabled type="text" class="form-control" name="statusTask" id="statusTask" value=""/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="descTask" class="cols-sm-2 control-label">Описание:</label>
            <div class="cols-sm-10">
                <div class="input-group col-md-6">
                    <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                    <input disabled type="text" class="form-control" name="descTask" id="descTask" value=""/>
                </div>
            </div>
        </div>

    </div>
    <div id="overlay"></div>

    <div id="responseTable" class="table-responsive center-block" style="width: 94%">
        <table id="responsableTable" class="table table-striped table-condensed">
            <thead>
            <tr>
                <th scope="col">Номер задачи</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Дата выполнения</th>
                <td></td>
            </tr>
            </thead>
            <tbody id="responseTableBody">

            </tbody>
        </table>
    </div>

    <center><nav id="pag">
            <ul class="pagination">
            </ul>
        </nav></center>

</div>

<script>

    $(document).ready(function () {
        countTasks();
    });

    function countTasks() {
        $.get("http://dot.kv-sys.ru/records/task", function(data) {

            if(data.records.length > 0) {
                var page = Math.ceil(data.records.length / <?=$perPage?>);
                $('#response').html('');
                $(".pagination").empty();
                for (var i = page; i > 0; i--) {
                    $('ul.pagination').prepend('<li><a href="#" onclick="processPage(' + i + ')">' + i + '</a></li>');
                }
                processPage(0);
            }


        }).fail(function(data) {
            $('#response').html(data.responseJSON.message);
            $('#response').css('color', 'red');
        });
    }

    function processPage(page)  {
        if(page == 0) page = 1;
        $.get("http://dot.kv-sys.ru/records/task?page=" + page + ",<?=$perPage?>&join=task_description", function(data) {

            if(data.records.length > 0) {
                $('#response').html('');
                $("#responsableTable tbody > tr").remove();
                $.each(data.records, function (index, value) {
                    $('#responseTable tbody').append(
                        '<tr>' +
                        '<td>' + value.taskId + '</td>' +
                        '<td>' + value.task_description[0].taskName + '</td>' +
                        '<td>' + value.taskDate + '</td>' +
                        '<td><a href="#"><i onclick="viewTask(' + value.taskId + ')" class="fa fa-edit"></i></a></td>' +
                        '</tr>'
                    );
                });
            }


        }).fail(function(data) {
            $('#response').html(data.responseJSON.message);
            $('#response').css('color', 'red');
        });
    }

    function viewTask(taskId) {
        $.get("http://dot.kv-sys.ru/records/task?join=task_description&join=author&join=status&filter=taskId,eq," + taskId + "&filter=taskStatus,eq,1", function(data) {
            $('#response').html('');

            if(data.records.length > 0) {
                $('#titleTask').val(data.records[0].task_description[0].taskName);
                $('#dateTask').val(data.records[0].taskDate);
                $('#authorTask').val(data.records[0].authorId.authorName);
                $('#statusTask').val(data.records[0].taskStatus.statusValue);
                $('#descTask').val(data.records[0].task_description[0].taskDescription);
                $('#overlay').fadeIn(400,
                    function(){
                        $('#modal_form')
                            .css('display', 'block')
                            .animate({opacity: 1, top: '50%'}, 200);
                    });
            }

        }).fail(function(data) {
            $('#response').html(data.responseJSON.message);
            $('#response').css('color', 'red');
        });
    }

    $('#searchButton').click(function () {
        var search = $('#searchField').val();

        if (search == "") {
            return;
        }

        $.get("http://dot.kv-sys.ru/records/task_description?filter=taskName,sw," + encodeURIComponent(search) + "&join=task", function(data) {

            if(data.records.length > 0) {
                $('#response').html('');
                $('#pag').hide();
                $("#responsableTable tbody > tr").remove();
                $.each(data.records, function (index, value) {
                    $('#responseTable tbody').append(
                        '<tr>' +
                        '<td>' + value.taskId.taskId + '</td>' +
                        '<td>' + value.taskName + '</td>' +
                        '<td>' + value.taskDate + '</td>' +
                        '<td><a href="#"><i onclick="viewTask(' + value.taskId.taskId + ')" class="fa fa-edit"></i></a></td>' +
                        '</tr>'
                    );
                });
            }

        }).fail(function(data) {
            $('#response').html(data.responseJSON.message);
            $('#response').css('color', 'red');
        });

    });

    $('#modal_close, #overlay').click( function() {
        $('#modal_form').animate({opacity: 0, top: '45%'}, 200,
            function(){
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    });

</script>