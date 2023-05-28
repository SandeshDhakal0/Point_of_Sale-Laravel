<nav class="topnav">
        <div class="row m-3">
            <div class="col-1 col-sm-1 col-md-1 col-lg-1 d-flex justify-content-center">
                <div id="mySidenav" class="sidenav">

                    <a href="javascript:void(0)" class="closebtn" style="right:7px;" onclick="closeNav()">&times;</a>
                    <div class="d-block d-sm-none d-md-none d-lg-none">
                        <input type="text" class="form-control input-text p-3" placeholder="Search products...." style="margin-top: 45px;height: 45px;margin-bottom: 12px;">
                        <button class="btn btn-primary btn-square-md" type="button" style="width:100px;height:47px;"><i class="fa fa-search"></i>Search</button>
                        <button class="btn btn-light btn-square-md" type="button" style="margin-right: 10px;width: 100px;right: 0;position: absolute;height: 47px;"><i class="fa-solid fa-2xl fa-barcode"></i></button>
                    </div>
                    <a href="{{ route('user.index') }}"><button class="navbarbutton w-100 mb-3">POS</button></a>
                    <a href="{{ route('user.dailysales') }}"><button class="navbarbutton w-100 mb-3">Sales</button></a>
                    <a href="#"><button class="navbarbutton w-100 mb-3">Inventory</button></a>
                    <a href="#"><button class="navbarbutton w-100 mb-3">Invoice</button></a>
                    <a href="#"><button class="navbarbutton w-100 mb-3">Customer</button></a>
                    <a href="#"><button class="navbarbutton w-100 mb-3">Emplyoee</button></a>
                </div>
                <div id="main">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>
            </div>
            <div class="col-1 col-sm-10 col-md-10 col-lg-10 d-none d-sm-flex d-md-flex d-lg-flex flex-row align-items-center">
                <input type="text" class="form-control input-text p-3 d-sm-block d-none" placeholder="Search products...." style="height: 50px;width:1020px;">
                <button class="btn btn-primary btn-square-md" type="button" style="margin-left: 10px;width:100px;height:47px;"><i class="fa fa-search"></i>Search</button>
                <button class="btn btn-light btn-square-md" type="button" style="margin-left: 10px;width:100px;height:47px;"><i class="fa-solid fa-2xl fa-barcode"></i></button>
            </div>

            <div class="col-10 col-sm-1 col-md-1 col-lg-1 d-flex justify-content-end align-items-center">
                <div class="dropdown justify-content-end">
                    <img src="{{asset('logo/user.png')}}" alt="profile" style="height: 50px;width: 50px; border-radius: 50%;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">

                    <div class="dropdown-menu justify-content-end" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">Profile</button>
                        <button class="dropdown-item" type="button">Sign Out</button>

                    </div>
                </div>
            </div>
        </div>
    </nav>
