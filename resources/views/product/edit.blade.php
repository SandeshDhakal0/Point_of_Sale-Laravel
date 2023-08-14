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
                                    <label for="particulars">Particulars</label>
                                    <textarea class="form-control" id="particulars" name="particulars" rows="4" cols="50">
                                    {{ $product['particulars'] }}
                                    </textarea>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meter">meter</label>
                                                <input type="text" name="meter" value="{{ $quantity->meter }}" id="meter" class="form-control" placeholder="Enter meter value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sqmt">sq. meter</label>
                                                <input type="text" name="sqmt" id="sqmt" value="{{ $quantity->sqmt }}"  class="form-control" placeholder="Enter sqmt value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="perpiece">per/piece</label>
                                                <input type="text" name="perpiece" id="perpiece" value="{{ $quantity->perpiece }}"  class="form-control" placeholder="Enter per/piece value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sqft">sq. ft</label>
                                                <input type="text" name="sqft" id="sqft" value="{{ $quantity->sqft }}"  class="form-control" placeholder="Enter sqft value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cm">cm</label>
                                                <input type="text" name="cm" id="cm" value="{{ $quantity->cm }}"  class="form-control" placeholder="Enter cm value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gallons">kg</label>
                                                <input type="text" name="kg" id="kg" value="{{ $quantity->kg }}"  class="form-control" placeholder="Enter kg value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gram">gram</label>
                                                <input type="text" name="gram" id="gram" value="{{ $quantity->gram }}"  class="form-control" placeholder="Enter gram value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="litre">litre</label>
                                                <input type="text" name="litre" id="litre" value="{{ $quantity->litre }}"  class="form-control" placeholder="Enter litre value.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gallons">gallons</label>
                                                <input type="text" name="gallons" id="gallons" value="{{ $quantity->gallons }}"  class="form-control" placeholder="Enter gallons value.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="cost-price">Cost Price</label>
                                    <input type="text" class="form-control" name="cost_price" value="{{ $product['cost_price'] }}" id="cost-price" placeholder="Enter Product Cost Price.">
                                </div>
                                <div class="form-group">
                                    <label for="product-price">Marked Price</label>
                                    <input type="text" class="form-control" name="sales_price" value="{{ $product['sales_price'] }}" id="product-price" placeholder="Enter Product Marked Price.">
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
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" rows="3" name="remarks" placeholder="Enter Product Remarks">{{ $product['remarks'] }}</textarea>
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
