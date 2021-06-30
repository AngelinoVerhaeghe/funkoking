<aside class="control-sidebar control-sidebar-dark px-1">
    <!-- Control sidebar content goes here -->
    <div class="mt-5">
    <!-- small box -->
    <a href="{{route('categories.index')}}" class="text-dark">
        <div class="info-box shadow">
            <span class="info-box-icon bg-gradient-lightblue elevation-1"><i class="fas fa-layer-group"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Categories</span>
                <span class="info-box-number"><h4>{{session('categoriesCount')}}</h4></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    <!-- small box -->
    <a href="{{route('addresses.index')}}" class="text-dark">
        <div class="info-box shadow">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-address-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Addresses</span>
                <span class="info-box-number"><h4>{{session('addressCount')}}</h4></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    <!-- small box -->
    <a href="{{route('photos.index')}}" class="text-dark">
        <div class="info-box shadow">
            <span class="info-box-icon bg-gradient-blue elevation-1"><i class="fas fa-photo-video"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Photos</span>
                <span class="info-box-number"><h4>{{session('photosCount')}}</h4></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    <!-- small box -->
    <a href="{{route('faqs.index')}}" class="text-dark">
        <div class="info-box shadow">
            <span class="info-box-icon bg-gradient-fuchsia elevation-1"><i class="fas fa-question-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">FAQ</span>
                <span class="info-box-number"><h4>{{session('faqsCount')}}</h4></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    <!-- small box -->
    <a href="{{route('reviews.index')}}" class="text-dark">
        <div class="info-box shadow">
            <span class="info-box-icon bg-gradient-navy elevation-1"><i class="far fa-eye"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reviews</span>
                <span class="info-box-number"><h4>?{{--{{session('productCount')}}--}}</h4></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    </div>
</aside>
