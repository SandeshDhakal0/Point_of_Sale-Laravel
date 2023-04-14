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
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-info" style="height:88%">
                                <div class="inner">
                                    <h3>Products</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-lg fa-list-alt"></i>
                                </div>
                                <a href={{ route('product.list') }} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success" style="height:88%">
                                <div class="inner">
                                    <h3>Users</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-lg fa-users-cog"></i>
                                </div>
                                <a href={{ route('users.list') }} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>


                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success" style="height:88%">
                                <div class="inner">
                                    <h3>Employees</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-lg fa-users"></i>
                                </div>
                                <a href={{ route('employee.list') }} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success" style="height:88%">
                                <div class="inner">
                                    <h3>Sales</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-lg fa-shopping-cart"></i>
                                </div>
                                <a href={{ route('sale.list') }} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

        @include('layouts.footer')


    </div>


    @include('layouts.scripts')

</body>

</html>
