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
                            <h1 class="m-0">Wholesale Purchase Record</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Wholesale Purchase</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <nav class="header navbar navbar-expand navbar-white navbar-light">

                        <ul class="navbar-nav">
                            <h5>Wholesale Purchase Record</h5>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <a class="btn btn-app" id="addCat" data-toggle="modal" data-target="#category_model">
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
                                    <th>S.No.</th>
                                    <th>Bill No.</th>
                                    <th>VAT No.</th>
                                    <th>Vendor Name.</th>
                                    <th>Invoice Date.</th>
                                    <th>Amount.</th>
                                    <th>Amount with VAT.</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </section>

        </div>

        <div class="modal fade" id="category_model">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Wholesale Purchase</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="cat_form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="editCat"></div>
                                <label for="vendor_name">Vendor Name:</label>
                                <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Enter name of vendor.">
                            </div>
                            <div class="form-group">
                                <label for="bill_no">Bill No:</label>
                                <input type="text" class="form-control" name="bill_no" id="bill_no" placeholder="Enter Bill No.">
                            </div>
                            <div class="form-group">
                                <label for="vat_no">VAT No:</label>
                                <input type="text" class="form-control" name="vat_no" id="vat_no" placeholder="Enter VAT No.">
                            </div>
                            <div class="form-group">
                                <label for="invoice_date">Invoice Date:</label>
                                <input type="date" class="form-control" name="invoice_date" id="invoice_date" placeholder="Enter Date of Issue.">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount.">
                            </div>
                            <div class="form-group">
                                <label for="amount_with_vat">Amount(with VAT):</label>
                                <input type="text" class="form-control" name="amount_with_vat" id="amount_with_vat" placeholder="Enter Amount with VAT.">
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
                        url: '{{route("wholesale.list")}}',
                    },
                    "columns": [{
                            data: 's_no'
                        },
                        {
                            data: 'bill_no'
                        },
                        {
                            data: 'vat_no'
                        },
                        {
                            data: 'vendor_name'
                        },
                        {
                            data: 'invoice_date'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'amount_with_vat'
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
                    url : '{{route("wholesale.add")}}',
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

                    let data_id = button.data('id');
                    let category_name = button.data('categoryname');
                    $('#editCat').html('<input type="hidden" name="id" value="'+data_id+'">');
                    $.ajax({
                        url:'{{ route("wholesale.find") }}',
                        type:"GET",
                        data:{
                            id:data_id
                        },
                        success:function(res){
                            res = JSON.parse(res);
                            if(res.status ==200){
                                res = res.data;
                                $('#vendor_name').val(res.vendor_name);
                                $('#bill_no').val(res.bill_no);
                                $('#vat_no').val(res.vat_no);
                                $('#invoice_date').val(res.invoice_date);
                                $('#amount').val(res.amount);
                                $('#amount_with_vat').val(res.amount_with_vat);
                            }
                        }
                    });
                }

            });

            $('#category_model').on('hidden.bs.model',function(){
                $('#editCat').empty();
                $('#category_name').val('');
            });
        });
    </script>

</body>

</html>
