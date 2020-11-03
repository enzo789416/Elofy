<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Elofy', 'Elofy') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.checkboxes.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Elofy', 'Elofy') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/dataTables.checkboxes.js') }}" ></script>
    <script src="{{ asset('js/dataTables.checkboxes.min.js') }}" ></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}" ></script>

    <script>
        $(document).ready(function() {
            $.noConflict();

            var table = $('#example').DataTable({

                "processing": true,
                //"dom": '<"toolbar"><"float-left"f>t<"float-right"p><"float-right"><"float-left"l>i',
                "dom": "<'row justify-content-between'<'col-2'f><'col-2'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
            "buttons": [
                    {
                        text: 'Cadastrar Pessoa',
                        action: function ( e, dt, node, config ) {
                            //window.location.href = "{{ route('manage.people.create')}}"
                            addPeople()
                        }
                    }
                ],
                //  "initComplete": function(){
                //             $("div.toolbar").html('<select class="form-control"><option>option 1</option><option>option 2</option><option>option 3</option><option>option 4</option><option>option 5</option></select>');
                // },
                "pagingType": "simple",
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
                    'search' : '',
                    'searchPlaceholder':'Search',
                    "lengthMenu": "Show per page _MENU_ "
                },
                'columnDefs': [
                    {
                    'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [

                ]
            })

            $('input:checkbox').on('change', function () {
                table.draw();
            });
                // Handle form submission event
                $('#frm-example').on('submit', function(e) {
                    var form = this;
                    var rows = table.column(0).checkboxes.selected();
                    $.each(rowsel,function (index, rowId){
                        $(form).append(
                            $('<input>').att('type','hidden').attr('name','marcados[]').val(rowId)
                        )
                    })
                })
            })
            $(function() {
                otable = $('#example').dataTable();
            })

            function filteratl(){
                debugger;
                var atl = $('input:checkbox[name="atleta"]:checked').map(function() {
                    return '^' + this.value + '\$';
                }).get().join('|');
                //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
                otable.fnFilter(atl,5, true, false, false, false);
            }

            function filterme() {
                debugger;
                var lact = $('input:checkbox[name="lact"]:checked').map(function() {
                    return '^' + this.value + '\$';
                }).get().join('|');
                //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
                otable.fnFilter(lact, 4, true, false, false, false);

            }

            function addPeople(){
                $("#people").val('');
                $('#people-modal').modal('show');
            }

            function editPeople(event) {
                debugger
                var id  = $(event).data("id");
                let _url = `manage/people/${id}/edit`;
                $("#people_id").text('');
                $("#name").text('');
                $("#height").text('');
                $("#lactose").text('');
                $("#weight").text('');
                $("#athlete").text('');
                $('#people-modal').text('');

                $.ajax({
                url: _url,
                type: "GET",
                    success: function(response) {
                        if(response) {
                            $("#people_id").val(response.id);
                            $("#name").val(response.name);
                            $("#height").val(response.height);
                            $("#lactose").val(response.lactose);
                            $("#weight").val(response.weight);
                            $("#athlete").val(response.athlete);
                            $('#people-modal').modal('show');
                        }
                    }
                });
            }

            function createPeople() {
                var name = $('#name').val();
                var height = $('#height').val();
                var lactose = $('#lactose').val();
                var weight = $('#weight').val();
                var athlete = $('#athlete').val();
                var id = $('#people_id').val();

                let _url     = `manage/people`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: "POST",
                    data: {
                    id: id,
                    name: name,
                    height: height,
                    lactose: lactose,
                    weight: weight,
                    athlete: athlete,
                    _token: _token
                    },
                    success: function(response) {
                        if(response.code == 200) {
                        if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.name);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.height);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.lactose);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.weight);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.athlete);
                        } else {
                            $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.height+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPeople(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePeople(event.target)">Delete</a></td></tr>');
                        }
                        $("#name").text('');
                        $("#height").text('');
                        $("#lactose").text('');
                        $("#weight").text('');
                        $("#athlete").text('');

                        $('#people-modal').modal('hide');
                        }
                    },
                    error: function(response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#heightError').text(response.responseJSON.errors.height);
                    $('#lactoseError').text(response.responseJSON.errors.lactose);
                    $('#weightError').text(response.responseJSON.errors.weight);
                    $('#athleteError').text(response.responseJSON.errors.athlete);
                    }
                });
            }

            function deletePeople(event) {
                debugger
                var id  = $(event).data("id");
                let _url =  `/manage/people/${id}`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                    _token: _token
                    },
                    success: function(response) {
                    $("#row_"+id).remove();
                    }
                });
            }



      </script>
</body>
</html>
