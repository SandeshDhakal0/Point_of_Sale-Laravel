<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <img src="{{asset('logo/logo.png')}}" alt="logo">
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('admin.index')}}" class="nav-link {{ (Request::segment(2) == 'dashboard')?'active':'' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('wholesale.list')}}" class="nav-link {{ (Request::segment(1) == 'wholesale')?'active':'' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Wholesale Purchase Record
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('category.list')}}" class="nav-link {{ (Request::segment(1) == 'category')?'active':'' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('subcategory.list')}}" class="nav-link {{ (Request::segment(1) == 'sub-category')?'active':'' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Sub-Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('product.list')}}" class="nav-link {{ (Request::segment(1) == 'product')?'active':'' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('sale.list')}}" class="nav-link {{ (Request::segment(1) == 'sale')?'active':'' }}">
                                <i class="nav-icon fas fa-shopping-cart" style="color: #ffffff;"></i>
                                <p>
                                    Sales
                                </p>
                            </a>
                        </li>


                        <li class="nav-item ">
                            <a href="{{route('role.list')}}" class="nav-link {{ (Request::segment(2) == 'role')?'active':'' }}">
                                <i class="nav-icon fas fa-user" style="color: #ffffff;"></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('employee.list')}}" class="nav-link {{ (Request::segment(2) == 'employee')?'active':'' }}">
                            <i class="nav-icon fas fa-users" style="color: #ffffff;"></i>
                                <p>
                                    Employees
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('users.list')}}" class="nav-link {{ (Request::segment(2) == 'users')?'active':'' }}">
                            <i class="nav-icon fas fa-users" style="color: #ffffff;"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href={{ route('password.change') }} class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Change Password</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('profile') }} class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('logout') }} class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>

            </div>

        </aside>
