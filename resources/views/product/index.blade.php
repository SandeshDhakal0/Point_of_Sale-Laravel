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
                            <h1 class="m-0">Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Product List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" href="{{route('product.add')}}">
                                <i class="fas fa-sm fa-plus"></i> Product
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
                        <table id="example2" class="display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>


        @include('layouts.footer')

    </div>


    @include('layouts.scripts')
    <script>
        $(function() {
            var loadtable;
            function loadDatatable(){
                loadtable = $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": {
                        url: '{{route("product.list")}}',
                    },
                    "columns": [{
                            data: 'product_id'
                        },
                        {
                            data: 'product_name'
                        },
                        {
                            data: 'product_brand'
                        },
                        {
                            data: 'available_sizes'
                        },
                        {
                            data: 'stock_quantity'
                        },
                        {
                            data: 'sales_price'
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
                    url : '{{route("category.add")}}',
                    type : 'get',
                    data : formData,
                    success : function(res){
                        $('#category_model').modal('hide');
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

            $('#category_model').on('show.bs.modal',function(event){
                let button = $(event.relatedTarget);
                if(button.hasClass('editBtn')){
                    console.log(button)
                    let data_id = button.data('id');
                    let category_name = button.data('categoryname');
                    $('#editCat').html('<input type="hidden" name="category_id" value="'+data_id+'">');
                    $('#category_name').val(category_name);
                }

            });

            $('#category_model').on('hdden.bs.model',function(){
                $('#editCat').empty();
                $('#category_name').val('');
            });
        });
    </script>

</body>

</html>
