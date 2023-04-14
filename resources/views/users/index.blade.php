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
                            <h1 class="m-0">Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>User List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#user_modal">
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
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="user_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="cat_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="editCat"></div>
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name.">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2bs4" name="role" id="role" style="width: 100%;">
                                    <option  value='0'>User</option>
                                    <option  value='1'>Admin</option>
                                    <option  value='2'>Employee</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <lable id="email">Email</lable>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <lable id="password">Password</lable>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <lable id="re-pass">Re-enter Password</lable>
                                <input type="password" class="form-control" name="re-pass" id="re-pass">
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
                        url: '{{route("users.list")}}',
                    },
                    "columns": [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'role'
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
                    url: "{{route('users.add')}}",
                    type: 'get',
                    data: formData,
                    success: function(res) {
                        $('#user_modal').modal('hide');
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

            $('#user_modal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                if (button.hasClass('editBtn')) {
                    let data_id = button.data('id');
                    $('#editCat').html('<input type="hidden" name="id" value="' + data_id + '">');
                    $.ajax({
                        url: "{{route('users.find')}}",
                        type: 'get',
                        data: { 'id':data_id },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status == 200) {
                                res = res.data;
                                $('#name').val(res.name);
                                $('#role').val(res.role);
                                $('#email').val(res.email);
                                $('#password').val(res.password);

                            }
                        }
                    });
                }

            });

        });
        $('#user_modal').on('hidden.bs.modal', function() {
                $('#editCat').empty();
                $('#name').val('');
                $('#role').val('');
                $('#email').val('');
                $('#password').val('');
                $('#re-pass').val('');
        });


    </script>

</body>

</html>
