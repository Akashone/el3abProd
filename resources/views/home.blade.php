@extends('layouts.app')

@section('css')
<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: space-between;
        justify-content: space-between;
        border: 1px solid #d2d2d2;
        border-radius: 10px;
        align-items: flex-start;
        background-color: white;
        line-height: 30px;
        list-style-type: none;
    }

    .sidebar li a:hover{
        color: blue;
    }

    .sidebar li a{
        text-decoration: none;
        color: black;
    }

    .sidebar li a.active{
        color: blue;
    }

    .card{
        display: none;
    }

    .card.active{
        display: block;
    }

    #games .card-header{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: space-between;
        justify-content: space-between;
        align-items: center;
    }

    #games .card-body .table thead tr th:nth-child(3), #games .card-body .table tbody tr td:nth-child(3){
        display: flex;
        align-items: end;
        justify-content: flex-end;
    }

    #questions .card-header{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: space-between;
        justify-content: space-between;
        align-items: center;
    }

    #questions .card-body .table thead tr th:nth-child(3), #questions .card-body .table tbody tr td:nth-child(3){
        display: flex;
        align-items: end;
        justify-content: flex-end;
    }

    #options .card-header{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: space-between;
        justify-content: space-between;
        align-items: center;
    }

    #options .card-body .table thead tr th:nth-child(4), #options .card-body .table tbody tr td:nth-child(4){
        display: flex;
        align-items: end;
        justify-content: flex-end;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="sidebar">
                <li>
                    <a href="#dashboard" class="change-pview active">Dashboard</a>
                </li>
                <li>
                    <a href="#games" class="change-pview">Games</a>
                </li>
                <li>
                    <a href="#questions" class="change-pview">Questions</a>
                </li>
                <li>
                    <a href="#options" class="change-pview">Options</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card active" id="dashboard">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            @include('layouts.partialviews.games')
            @include('layouts.partialviews.questions')
            @include('layouts.partialviews.options')
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        window.onload = function () {
			$('.active').removeClass('active');
			var hash = window.location.hash;
			$("a[href='"+hash+"']").addClass('active');
			$(hash).addClass('active');
		}

        $(document).on('click', '.change-pview', function(){
            let cardColl = document.querySelectorAll('.card');
            cardColl.forEach(element => {
                element.classList.remove('active');
            });
            let classCol = document.querySelectorAll('.change-pview');
            classCol.forEach(element => {
                element.classList.remove('active');
            });
            $(this).addClass('active');
            $($(this).attr('href')).addClass('active');
        });

        $(document).on('click', '.addOrUpdateGame', function () {
            var id = $(this).data('id');
            var mode = $(this).data('mode');

            $("#addNewGameForm input[name='id']").val(id);
            $("#addNewGameForm input[name='mode']").val(mode);

            if (mode == 'edit') {
                $.ajax({
                    type: "post",
                    url: "{{ route('getGameDetails') }}",
                    data: {_token: "{{ csrf_token() }}", id: id},
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $("#addNewGameForm input[name='name']").val(response.success.name);
                            $('#addNewGame').modal('show');
                        }
                        else
                        {
                            Swal.fire({
								title: 'Game not found, please try after refresh.',
								icon: 'error'
							});
                        }
                    }
                });
            }
            
            if(mode == 'add')
            {
                $("#addNewGameForm input[name='name']").val('');
                $('#addNewGame').modal('show');
            }

        });

        $(document).on('click', '.closeModal', function(){
            $('#'+$(this).data('modalname')).modal('hide');
        });

        $(document).on('click', '.addOrUpdateGameToDb', function () {
            let name = $.trim($("#addNewGameForm input[name='name']").val());
            let id = $("#addNewGameForm input[name='id']").val();
            let mode = $("#addNewGameForm input[name='mode']").val();
            
            if (name == '') {
                $('#gamenamevalidation').text('Please enter name of game!');
                return;
            }

            $('#gamenamevalidation').empty();
            $('#gamevalidations').empty();
            $.ajax({
                type: "post",
                url: "{{ route('addOrUpdateGame') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id : id,
                    name: name,
                    mode: mode
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();                        
                    } 
                    else if (response.msg) {
                        valError = response.msg;
                        valErrHtml = '';
                        console.log(valError);
                        $.each(valError, function (i, val) {
                            valErrHtml += '<strong style="color: red;">&#8226; '+val+'</strong>';
                        });
                        $('#gamevalidations').append(valErrHtml);
                    }else {
                        
                    }
                }
            });
        });

        $(document).on('click', '.addOrUpdateQuestion', function () {
            var id = $(this).data('id');
            var mode = $(this).data('mode');

            $("#addNewQuestionForm input[name='id']").val(id);
            $("#addNewQuestionForm input[name='mode']").val(mode);

            if (mode == 'edit') {
                $.ajax({
                    type: "post",
                    url: "{{ route('getQuestionDetails') }}",
                    data: {_token: "{{ csrf_token() }}", id: id},
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $("#addNewQuestionForm input[name='name']").val(response.success.name);
                            $('#addNewQuestion').modal('show');
                        }
                        else
                        {
                            Swal.fire({
								title: 'Game not found, please try after refresh.',
								icon: 'error'
							});
                        }
                    }
                });
            }
            
            if(mode == 'add')
            {
                $("#addNewQuestionForm input[name='name']").val('');
                $('#addNewQuestion').modal('show');
            }

        });

        $(document).on('click', '.addOrUpdateQuestionToDb', function () {
            let name = $.trim($("#addNewQuestionForm input[name='name']").val());
            let id = $("#addNewQuestionForm input[name='id']").val();
            let mode = $("#addNewQuestionForm input[name='mode']").val();
            
            if (name == '') {
                $('#quenamevalidation').text('Please enter question...');
                return;
            }

            $('#quenamevalidation').empty();
            $('#quevalidations').empty();
            $.ajax({
                type: "post",
                url: "{{ route('addOrUpdateQuestion') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id : id,
                    name: name,
                    mode: mode
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();                        
                    } 
                    else if (response.msg) {
                        valError = response.msg;
                        valErrHtml = '';
                        console.log(valError);
                        $.each(valError, function (i, val) {
                            valErrHtml += '<strong style="color: red;">&#8226; '+val+'</strong>';
                        });
                        $('#quevalidations').append(valErrHtml);
                    }else {
                        
                    }
                }
            });
        });

        // options data operations
        $(document).on('click', '.addOrUpdateOption', function () {
            var id = $(this).data('id');
            var mode = $(this).data('mode');

            $("#addNewOptionForm input[name='id']").val(id);
            $("#addNewOptionForm input[name='mode']").val(mode);

            if (mode == 'edit') {
                $.ajax({
                    type: "post",
                    url: "{{ route('getOptionDetails') }}",
                    data: {_token: "{{ csrf_token() }}", id: id},
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $("#addNewOptionForm input[name='name']").val(response.success.name);
                            $("#addNewOptionForm input[name='point']").val(response.success.point);
                            $('#addNewOption').modal('show');
                        }
                        else
                        {
                            Swal.fire({
								title: 'Option not found, please try after refresh.',
								icon: 'error'
							});
                        }
                    }
                });
            }
            
            if(mode == 'add')
            {
                $("#addNewOptionForm input[name='name']").val('');
                $("#addNewOptionForm input[name='point']").val('');
                $('#addNewOption').modal('show');
            }

        });

        $(document).on('click', '.addOrUpdateOptionToDb', function () {
            let name = $.trim($("#addNewOptionForm input[name='name']").val());
            let point = $.trim($("#addNewOptionForm input[name='point']").val());
            let id = $("#addNewOptionForm input[name='id']").val();
            let mode = $("#addNewOptionForm input[name='mode']").val();
            
            if (name == '') {
                $('#optionnamevalidation').text('Please enter Option...');
                return;
            }

            if (point == '') {
                $('#optionpointvalidation').text('Please enter point...');
                return;
            }

            $('#optionnamevalidation').empty();
            $('#optionpointvalidation').empty();
            $('#optionvalidations').empty();
            $.ajax({
                type: "post",
                url: "{{ route('addOrUpdateOption') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id : id,
                    name: name,
                    point: point,
                    mode: mode
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();                        
                    } 
                    else if (response.msg) {
                        valError = response.msg;
                        valErrHtml = '';
                        console.log(valError);
                        $.each(valError, function (i, val) {
                            valErrHtml += '<strong style="color: red;">&#8226; '+val+'</strong>';
                        });
                        $('#optionvalidations').append(valErrHtml);
                    }else {
                        
                    }
                }
            });
        });
    </script>
@endsection