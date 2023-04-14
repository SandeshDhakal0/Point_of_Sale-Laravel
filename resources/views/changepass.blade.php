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
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form action={{ route('password.change') }} method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="old_pass">Current Password</label>
                        <input type="text" class="form-control form-control-border border-width-2" id="old_pass" name="old_pass" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group">
                        <label for="new_pass">New Password</label>
                        <input type="text" class="form-control form-control-border border-width-2" id="new_pass" name="new_pass" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label for="re_pass">Re-enter Password</label>
                        <input type="text" class="form-control form-control-border border-width-2" id="re_pass" name="re_pass" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group d-flex justify-content-end mt-4">
                        <button class="form-control btn btn-success w-25" type="submit">Save Changes</button>
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
