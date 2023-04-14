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
                            <h1 class="m-0">Sub Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Sub Category</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Sub Category List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#sub_category_model">
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
                                    <th>Sub Category Id</th>
                                    <th>Sub Category Name</th>
                                    <th>Parent Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="sub_category_model">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="cat_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="editCat"></div>
                                <label for="sub_category_name">Sub Category Name</label>
                                <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Enter Sub Category Name.">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                                    @foreach($category as $key=>$cat)
                                    <option {{($key == 0)?'selected="selected"':''}} value={{ $cat->category_id}}>{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
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
                        url: '{{route("subcategory.list")}}',
                    },
                    "columns": [{
                            data: 'sub_cat_id'
                        },
                        {
                            data: 'sub_cat_name'
                        },
                        {
                            data: 'cat_id'
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
                    url: "{{route('subcategory.add')}}",
                    type: 'get',
                    data: formData,
                    success: function(res) {
                        $('#sub_category_model').modal('hide');
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

            $('#sub_category_model').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                if (button.hasClass('editBtn')) {
                    let data_id = button.data('id');
                    let category_name = button.data('categoryname');
                    $('#editCat').html('<input type="hidden" name="sub_category_id" value="' + data_id + '">');
                    $('#sub_category_name').val(category_name);
                }

            });

        });
        $('#sub_category_model').on('hide.bs.modal', function() {
                $('#editCat').empty();
                $('#sub_category_name').val('');

            });
    </script>

</body>

</html>
