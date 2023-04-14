@include('layouts.meta')
<style>
    .image-preview img {
        width: 200px;
        padding: 10px;
    }

    #image {
        cursor: pointer;
    }
</style>

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
                            <h1 class="m-0">Edit Product</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                @if ($errors->any())
                <div class="container-fluid p-0">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form enctype='multipart/form-data' action={{ route('product.addproduct') }} method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="product_id" value={{ $product['product_id'] }}>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="product-name">Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product-name" value={{ $product['product_name'] }} placeholder="Enter product name.">
                                </div>
                                <div class="form-group">
                                    <label for="product-brand">Brand</label>
                                    <input type="text" class="form-control" name="product_brand" id="product-brand" value={{ $product['product_brand'] }} placeholder="Enter Product Brand.">
                                </div>

                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select class="custom-select" name="category_id">
                                        @foreach($categories as $cat)
                                        <option value={{ $cat['category_id'] }} @if($cat['category_id']==$product['category_id']) selected ; @endif>{{ $cat['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-quantity">Quantity</label>
                                    <input type="number" class="form-control" name="stock_quantity" value={{ $product['stock_quantity'] }} id="product-quantity" placeholder="Enter Product Quantity.">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="product-price">Price</label>
                                    <input type="text" class="form-control" name="sales_price" value={{ $product['sales_price'] }} id="product-price" placeholder="Enter Product Price.">
                                </div>
                                <div class="form-group">
                                    <label>Available Size</label>
                                    <select class="custom-select" name="available_sizes">
                                        <option value="S" @if($cat['product_cat_id']=='S' ) selected ; @endif>S</option>
                                        <option value="M" @if($cat['product_cat_id']=='M' ) selected ; @endif>M</option>
                                        <option value="L" @if($cat['product_cat_id']=='L' ) selected ; @endif>L</option>
                                        <option value="XL" @if($cat['product_cat_id']=='XL' ) selected ; @endif>XL</option>
                                        <option value="XXL" @if($cat['product_cat_id']=='XXL' ) selected ; @endif>XXL</option>
                                        <option value="XXXL" @if($cat['product_cat_id']=='XXXL' ) selected ; @endif>XXXL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="custom-select" name="sub_category_id">
                                        @foreach($subcategory as $scat)
                                        <option value={{ $scat['sub_category_id'] }} @if($scat['sub_category_id']==$cat['product_sub_category']) selected ; @endif>{{ $scat['sub_category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="product_description" placeholder="Enter Product Description">{{ $product['product_description'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div id='image-container'>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Add Images</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input accept="image/*" type="file" class="custom-file-input" name="image[]" id="image" multiple>
                                                <label class="custom-file-label" for="image">Choose Image</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="image-preview" id="image-preview">
                                        @foreach($images as $img)
                                        <img src={{ asset('storage/products/'.$img['image_path']) }}></img>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </section>





        </div>


        @include('layouts.footer')

    </div>


    @include('layouts.scripts')
    <script>
        const imageInput = document.querySelector('#image');
        const imagePreview = document.querySelector('#image-preview');

        // Listen for changes to the image input
        imageInput.addEventListener('change', () => {
            // Clear any existing preview images
            imagePreview.innerHTML = '';

            // Loop over each selected image
            for (const file of imageInput.files) {
                // Create a new image element
                const img = document.createElement('img');

                // Set the image source to the selected file
                img.src = URL.createObjectURL(file);

                // Add the image element to the preview container
                imagePreview.appendChild(img);
            }
        });
    </script>

</body>

</html>
