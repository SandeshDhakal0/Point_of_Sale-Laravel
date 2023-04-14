@include('layouts.meta')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- <div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__shake" src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
</div> -->
        @include('layouts.header')


        @include('layouts.sidebar')

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Employees</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Employees</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Employee List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#employee_modal">
                                <i class="fas fa-sm fa-plus"></i> Add
                            </a>
                        </ul>
                    </nav>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employee Name</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="employee_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="cat_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="editCat"></div>
                                <label for="employee_name">Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="Enter Employee Name.">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2bs4" name="role_id" id="role_id" style="width: 100%;">
                                    @foreach($role as $val)
                                    <option  value={{ $val->role_id }}>{{ $val->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <lable id="join_date">Joined Date</lable>
                                <input type="date" class="form-control" name="join_date" id="join_date">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        @include('layouts.footer')

    </div>


    @include('layouts.scripts')
    <script>
        $(function() {
            var loadtable;

            function loadDatatable() {
                loadtable = $('#example2').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": {
                        url: '{{route("employee.list")}}',
                    },
                    "columns": [{
                            data: 'employee_id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'role'
                        },
                        {
                            data: 'join_date'
                        },
                        {
                            data: 'action'
                        }
                    ]

                });
            }
            loadDatatable();

            $('#cat_form').on('submit', function(event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault();
                var formData = $(this).serializeArray();
                $.ajax({
                    url: "{{route('employee.add')}}",
                    type: 'get',
                    data: formData,
                    success: function(res) {
                        $('#employee_modal').modal('hide');
                        res = JSON.parse(res);
                        if (res.status == 200) {
                            toastr.success(res.message);
                            $('#example2 tbody').empty();
                            if (loadtable) {
                                loadtable.destroy();
                            }
                            loadDatatable();
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            });

            $('#employee_modal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                if (button.hasClass('editBtn')) {
                    let data_id = button.data('id');
                    let employee_name = button.data('name');
                    $('#editCat').html('<input type="hidden" name="employee_id" value="' + data_id + '">');
                    $('#employee_name').val(employee_name);
                    $('#role_id').val(button.data('role'));
                    console.log(button.data('joindate'));
                    $('#join_date').val(button.data('joindate'));
                }

            });

        });
        $('#employee_modal').on('hide.bs.modal', function() {
                $('#editCat').empty();
                $('#employee_name').val('');
                $('#role_id').val('');
                $('#join_date').val('');
        });


    </script>

</body>

</html>
