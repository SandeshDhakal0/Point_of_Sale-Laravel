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
                            <h1 class="m-0">Sales</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Sales List</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#sales_modal">
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
                                    <th>Sales Invoice Id</th>
                                    <th>Sold To</th>
                                    <th>Quantity</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="sales_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="sales_form">
                        @csrf
                        <div class="modal-body">
                            <div id="editCat"></div>
                            <div class="form-group">
                                <label>Buyer</label>
                                <select class="form-control select2bs4" name="buyer_data" id="buyer_data" style="width: 100%;">
                                    @foreach($users as $val)
                                    <option value={{ $val->id.','.$val->name }}>{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product</label>
                                <select class="form-control select2bs4" name="product_id" id="product_id" style="width: 100%;">
                                    @foreach($product as $val)
                                    <option value={{ $val->product_id }}>{{ $val->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sold_quantity">Product Quantity</label>
                                <input type="text" class="form-control" name="sold_quantity" id="sold_quantity" placeholder="Enter product quantity.">
                            </div>

                            <div class="form-group">
                                <label for="sold_amount">Total Price</label>
                                <input type="text" class="form-control" name="sold_amount" id="sold_amount" placeholder="Enter total price.">
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
                        url: '{{route("sale.list")}}',
                    },
                    "columns": [{
                            data: 'id'
                        },
                        {
                            data: 'to_user'
                        },
                        {
                            data: 'sold_quantity'
                        },
                        {
                            data: 'product'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'action'
                        }
                    ]

                });
            }
            loadDatatable();

            $('#sales_form').on('submit', function(event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault();
                var formData = $(this).serializeArray();
                $.ajax({
                    url: "{{route('sale.add')}}",
                    type: 'get',
                    data: formData,
                    success: function(res) {
                        $('#sales_modal').modal('hide');
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

            $('#sales_modal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                if (button.hasClass('editBtn')) {
                    let data_id = button.data('id');
                    $('#editCat').html('<input type="hidden" name="sales_id" value="' + data_id + '">');
                    $.ajax({
                        url: "{{route('sale.find')}}",
                        type: 'get',
                        data: { 'sales_id':data_id },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status == 200) {
                                res = res.data;
                                $('#buyer_data').val(res.sold_to_user_id+','+res.sold_to_user_name);
                                $('#product_id').val(res.product_id);
                                $('#sold_quantity').val(res.sold_quantity);
                                $('#sold_amount').val(res.sold_amount);

                            }
                        }
                    });
                }

            });

        });
        $('#sales_modal').on('hide.bs.modal', function() {
                $('#editCat').empty();
                $('#buyer_data').val('');
                $('#product_id').val('');
                $('#sold_quantity').val('');
                $('#sold_amount').val('');

            });
    </script>

</body>

</html>
