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
                        <h1 class="m-0">User Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form action={{ route('profile') }} method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control form-control-border border-width-2" value={{ $user['name'] }} id="name" name="name" placeholder="Enter user name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-border border-width-2" id="email" name="email" value={{ $user['email'] }} placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex align-items-center">
                            <div class="form-group w-100">
                                <label for="role">Role</label>
                                <input type="text" class="form-control form-control-border border-width-2" id="role" value={{ $role[$user['role']] }} disabled>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-outline-primary" type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
     </div>

        @include('layouts.footer')


    </div>


    @include('layouts.scripts')

</body>

</html>
