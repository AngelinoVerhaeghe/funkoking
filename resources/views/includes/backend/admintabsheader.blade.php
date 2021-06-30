<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="{{route('users.index')}}" class="text-dark">
            <div class="info-box shadow rounded-0">
                <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number">{{ session('usersCount') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="{{route('products.index')}}" class="text-dark">
            <div class="info-box shadow rounded-0">
                <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fab fa-product-hunt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Products</span>
                    <span class="info-box-number">{{ session('productCount') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="{{route('orders.index')}}" class="text-dark">
            <div class="info-box shadow rounded-0">
                <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-shopping-bag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Orders</span>
                    <span class="info-box-number">{{ session('ordersCount') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="{{route('stocks.index')}}" class="text-dark">
            <div class="info-box shadow rounded-0">
                <span class="info-box-icon bg-gradient-olive elevation-1"><i class="fas fa-cubes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stocks</span>
                    <span class="info-box-number">{{ session('stocksCount') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>
    <!-- ./col -->
</div>
