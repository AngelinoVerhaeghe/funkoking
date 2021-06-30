<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="ribbon-wrapper">
        <div class="ribbon bg-gradient-light">
            FK
        </div>
    </div>
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <i class="fas fa-crown ml-4 mr-3 text-teal"></i>
        <span class="brand-text font-weight-light">Funko King</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info ml-3">
               <a href="{{route('admin')}}" class="d-block"><i class="fas fa-home mr-3"></i>Admin Homepage</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                   <a href="{{route('users.index')}}" class="nav-link">
                        <i class="fas fa-users nav-icon mr-2"></i>
                        <p>Users</p>
                    </a>
                   {{-- <router-link :to="{name: 'users'}" class="nav-link">
                        <i class="fas fa-users nav-icon mr-2"></i>
                        <p>Users</p>
                    </router-link>--}}
                </li>
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt mr-2"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag mr-2"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('stocks.index')}}" class="nav-link">
                        <i class="nav-icon fab fa-stack-overflow mr-2"></i>
                        <p>Stock</p>
                    </a>
                </li>
                <hr class="dropdown-divider">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fas fa-layer-group nav-icon mr-2"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('subcategories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-book-reader mr-2"></i>
                        <p>SubCategories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-tag mr-2"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('photos.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-image mr-2"></i>
                        <p>Photos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('addresses.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt mr-2"></i>
                        <p>Addresses</p>
                    </a>
                </li>
                <hr class="dropdown-divider">
                <li class="nav-item">
                    <a href="{{route('blogs.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-kiss-wink-heart mr-2"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('blogcategories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group mr-2"></i>
                        <p>Blog Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reviews.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-star mr-2"></i>
                        <p>Reviews</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('contacts.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-bell mr-2"></i>
                        <p>User Contact</p>
                    </a>
                </li>
                <hr class="dropdown-divider">
                <li class="nav-item">
                    <a href="{{route('faqs.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-question mr-2"></i>
                        <p>FAQ's</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('faqcategories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group mr-2"></i>
                        <p>FAQ's Categories</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
