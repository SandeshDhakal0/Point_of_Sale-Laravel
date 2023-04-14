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
                            <h1 class="m-0">Roles</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Role List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#role_modal">
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
                                    <th>Role</th>
                                    <th>Actions
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="role_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="cat_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="editCat"></div>
                                <label for="role_name">Role Name</label>
                                <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter Role Name.">
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
            function loadDatatable(){
                loadtable = $('#example2').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": {
                        url: '{{route("role.list")}}',
                    },
                    "columns": [{
                            data: 'role_id'
                        },
                        {
                            data: 'role_name'
                        },
                        {
                            data: 'action'
                        }
                    ]

                });
            }
            loadDatatable();

            $('#cat_form').on('submit',function(event){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault();
                var formData = $(this).serializeArray();
                $.ajax({
                    url : '{{route("role.add")}}',
                    type : 'get',
                    data : formData,
                    success : function(res){
                        $('#role_modal').modal('hide');
                        res = JSON.parse(res);
                        if(res.status == 200){
                            toastr.success(res.message);
                            $('#example2 tbody').empty();
                            if(loadtable){
                                loadtable.destroy();
                            }
                            loadDatatable();
                        }else{
                            toastr.error(res.message);
                        }
                    }
                });
            });

            $('#role_modal').on('show.bs.modal',function(event){
                let button = $(event.relatedTarget);
                if(button.hasClass('editBtn')){
                    console.log(button)
                    let data_id = button.data('id');
                    let role_name = button.data('role_name');
                    $('#editCat').html('<input type="hidden" name="role_id" value="'+data_id+'">');
                    $('#role_name').val(role_name);
                }

            });

            $('#role_modal').on('hidden.bs.model',function(){
                $('#editCat').empty();
                $('#role_name').val('');
            });
        });
    </script>

</body>

</html>
