<!DOCTYPE html>
<html>
<head>
    @include('user-layouts.meta')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
</head>
<body>
    @include('user-layouts.header')

    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sales Invoice Id</th>
                                    <th>Sold To</th>
                                    <th>Quantity</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

    </body>



@include('user-layouts.scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
           $(function() {
            var loadtable;

            function loadDatatable() {
                loadtable = $('#example2').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": {
                        url: '{{route("user.dailysales")}}',
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
                        }
                    ]

                });
            }
            loadDatatable();
        });
</script>

</html>
