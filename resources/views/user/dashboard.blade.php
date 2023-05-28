<!DOCTYPE html>
<html>
<head>
    @include('user-layouts.meta')
</head>
<body>
    @include('user-layouts.header')

    <div class="row m-5 mt-3">
        <div class="col-8 col-sm-8 col-xs-12">
            <ul class="nav nav-tabs">
            <?php $i = 0 ; ?>
            @foreach($response['category'] as $cat)
            <li <?php if($i == 0){ $i++; echo 'class="active"'; } ?>>
                    <a data-toggle="tab"><button data-id={{ $cat->category_id }} class="tabbutton">{{ $cat->category_name }}</button></a>
                </li>
            @endforeach


            </ul>
            <!-- tab content -->

            <div class="tab-content">
                <!-- category-1 -->
                <?php $i = 0 ; ?>
                @foreach($response['product'] as $prod)
                <div class="tab-pane <?php if($i == 0){ $i++; echo 'active'; } ?>" id={{$prod['cat_id']}}>
                    <section>
                        <div class="row">
                        @if(count($prod) > 1)
                        @for($i = 0 ; $i < count($prod)-1; $i++)
                            <div class="col-sm-8 col-md-12 col-lg-2 mb-4 mb-md-0 mt-2 mb-4">
                                <div class="card rounded-5 shadow-1-strong mb-5" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset; ">
                                    @if(count($prod[$i]['images']) > 0)
                                        <img src="{{ asset('storage/products/'.$prod[$i]['images'][0]->image_path) }}" class="card-img-top m-1 cardimgsize" alt="Laptop" style="opacity: 1; padding-right: 5%;">
                                    @endif
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h5 class="mb-0">{{$prod[$i]['product_name']}}</h5>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <h5 class="text-dark mb-0">Rs. {{$prod[$i]['price']}}</h5>
                                        </div>
                                        <!-- Existing code -->
         <button onclick="addProduct('{{$prod[$i]['product_id']}}','{{$prod[$i]['product_name']}}', '{{$prod[$i]['price']}}')">Add to Cart</button>
         <!-- Existing code -->
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif

                        </div>
                    </section>
                </div>
                @endforeach
            </div>
            <!-- end of tab content -->

            <script>

                var tabPanel = document.getElementsByClassName('tabbutton');
                for(i = 0 ; i< tabPanel.length; i++){
                    tabPanel[i].addEventListener('click',function(){
                        var nav_items = document.querySelectorAll('.nav.nav-tabs li');
                        for(j = 0 ; j< nav_items.length; j++){
                            nav_items[j].classList.remove('active');
                        }
                        this.parentNode.parentNode.classList.add('active');
                        pane_id = this.dataset.id;
                        var allpanel = document.getElementsByClassName('tab-pane');
                        for(j = 0 ; j< allpanel.length; j++){
                            allpanel[j].classList.remove('active');
                        }
                        var curr = document.getElementById(pane_id);
                        curr.classList.add('active');
                    });
                }

    </script>





            <!-- INVOICE -->
        </div>
        <!-- <div class="col-4 col-sm-4 col-xs-12" style="padding-top: 4.1%;">
            <div class="card">
                <div class="invoice p-3 m-1">

                        <div id="qr-reader" style="width:100%"></div>
                        <div id="qr-reader-results"></div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody id="product-list>


                                    </tbody>
                            </table>

                            <div class="row d-flex justify-content-end">
                                <div class="just">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Subtotal</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>Rs.1984</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Tax Fee</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>Rs.84</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Discount</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                    <input type="number" id="discount-input" name="discount" step="0.01" placeholder="Rs.0.00">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-top border-bottom">
                                                <td>
                                                    <div class="text-left">
                                                        <span class="font-weight-bold">Subtotal</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span class="font-weight-bold">Rs.1800</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-success" data-toggle="modal" data-target="#myModal" style="float:right;">Proceed Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-4 col-sm-4 col-xs-12" style="padding-top: 4.1%;">
        <div class="card">
  <div class="invoice p-3 m-1">
    <div id="qr-reader" style="width:100%"></div>
    <div id="qr-reader-results"></div>
    <div class="product border-bottom table-responsive">
      <table class="table table-borderless">
        <tbody id="product-list">
          <!-- Existing product rows -->
        </tbody>
      </table>
    </div>
    <div class="subtotal">
        <form action="{{ route('user.sales') }}" method="POST">
            @csrf
      <table class="table table-borderless">
        <tbody id="subtotal-list">
          <tr>
            <td width="80%">Subtotal:</td>
            <td width="20%" id="subtotal-amount">Rs. 0</td>
            <input type="hidden" name="total_amt" id="total_amt">
          </tr>
          <tr>
            <td width="80%">Discount:</td>
            <td width="20%" id="discount-amount">Rs. 0</td>
            <input type="hidden" name="disc_amt" id="disc_amt">
          </tr>
          <input type="hidden" name="product_ids" id="product_ids">
          <input type="hidden" name="product_price" id="product_price">
          <input type="hidden" name="product_quantity" id="product_quantity">
        </tbody>
      </table>
      <button class="btn btn-success" type="submit" id="proceed-next">Proceed Next</button>
        </form>
    </div>
  </div>
</div>



<script>

function updateSubtotal() {
  let subtotal = 0;
  document.getElementById('product_price').value = null;
  document.getElementById('product_quantity').value = null;
  document.getElementById('product_ids').value = null;
  // Iterate over each product row
  var productRows = document.querySelectorAll('#product-list tr');
  productRows.forEach(function (row) {
    var priceElement = row.querySelector('.price-amt');
    var priceText = priceElement.textContent;
    var price = parseFloat(priceText.replace('Rs. ', ''));
    var quantityInput = row.querySelector('input[name="number"]');
    var quantity = parseInt(quantityInput.value);
    var rowTotal = price * quantity;


    var curr_id = row.querySelector('.price-id').textContent;
    var ids = document.getElementById('product_ids').value;
    if(ids == null || ids == ''){
        ids = curr_id;
    }else{
        ids = ids+','+curr_id;
    }
    document.getElementById('product_ids').value = ids;

    var q = document.getElementById('product_quantity').value;
    if(q == null || q == ''){
        q = quantity;
    }else{
        q = q+','+quantity;
    }
    document.getElementById('product_quantity').value = q;

    var pr = document.getElementById('product_price').value;
    if(pr == null || pr == ''){
        pr = price;
    }else{
        pr = pr+','+price;
    }
    document.getElementById('product_price').value = pr;


    subtotal += rowTotal;



  });

  // Calculate discount if available
  var discount = 0;
  if (subtotal >= 1000) {
    discount = subtotal * 0.1; // 10% discount
  }

  // Update the subtotal and discount rows
  var subtotalAmount = document.getElementById('subtotal-amount');
  var discountAmount = document.getElementById('discount-amount');
  subtotalAmount.textContent = 'Rs. ' + subtotal.toFixed(2);
  document.getElementById('total_amt').value = subtotal.toFixed(2);
  document.getElementById('disc_amt').value = discount.toFixed(2);
  discountAmount.textContent = 'Rs. ' + discount.toFixed(2);
}


function addProduct(id,productName, price) {
  var productList = document.getElementById('product-list');

  var newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td width="20%">
      ITEM: <br> Quantity: <br> Item no:
    </td>
    <td width="60%">
      <div class="font-weight-bold" style="margin-left: 10px;">
        ${productName}
        <div class="product-qty">
          <span class="d-block">
            <input type="number" name="number" style="width:44px;padding: 4px 5px 5px 7px;font-size: 15px;" value="1">
          </span>
          <span>Item no:</span> <!-- Replace 'Item no:' with the actual item number -->
        </div>
      </div>
    </td>
    <td width="20%">
      <div class="text-right">
        <span class="font-weight-bold price-amt">Rs. ${price}</span>
        <span class="price-id d-none">${id}</span>
        <span class="d-flex">
          <li class="list-inline-item d-flex">
            <button class="btn btn-primary btn-sm rounded-0 plus-button" type="button" data-toggle="tooltip"
              data-placement="top" title="Add"><i class="fa fa-plus"></i></button>
          </li>
          <li class="list-inline-item d-flex">
            <button class="btn btn-danger btn-sm rounded-0 minus-button" type="button" data-toggle="tooltip"
              data-placement="top" title="Delete"><i class="fa fa-minus"></i></button>
          </li>
          <li class="list-inline-item">
            <button class="btn btn-danger btn-sm rounded-0 delete-button" type="button" data-toggle="tooltip"
              data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
          </li>
        </span>
      </div>
    </td>
  `;

  productList.appendChild(newRow);

  // Update subtotal when a product is added
  updateSubtotal();

  // Attach event listeners to the buttons in the new row
  var plusButton = newRow.querySelector('.plus-button');
  var minusButton = newRow.querySelector('.minus-button');
  var deleteButton = newRow.querySelector('.delete-button');

  plusButton.addEventListener('click', function () {
    // Handle increment logic
    var quantityInput = newRow.querySelector('input[name="number"]');
    var quantity = parseInt(quantityInput.value);
    quantity++;
    quantityInput.value = quantity;

    updateSubtotal();
  });

  minusButton.addEventListener('click', function () {
    // Handle decrement logic
    var quantityInput = newRow.querySelector('input[name="number"]');
    var quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
      quantity--;
      quantityInput.value = quantity;

      updateSubtotal();
    }
  });

  deleteButton.addEventListener('click', function () {
    // Handle deletion logic
    newRow.remove(); // Remove the row from the table

    updateSubtotal();
  });
}

// // Example usage:
// addProduct('Preston', 940);
// addProduct('Lara', 994);





</script>

        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Payment Options</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-secondary active" id="cash-btn">
                                <input type="radio" name="options" id="option1" checked> Cash
                            </label>
                            <label class="btn btn-secondary" id="debit_credit-btn">
                                <input type="radio" name="options" id="option2"> Debit/Credit
                            </label>
                            <label class="btn btn-secondary" id="mobile_payment-btn">
                                <input type="radio" name="options" id="option3"> Mobile Payment
                            </label>
                            <label class="btn btn-secondary" id="coupons-btn">
                                <input type="radio" name="options" id="option4"> Coupons
                            </label>
                        </div>

                        <!-- Cash form -->
                        <div class="form-group" id="cash-form">
                            <label for="total">Total:</label>
                            <input type="text" class="form-control" id="total">
                            <label for="cash">Cash:</label>
                            <input type="text" class="form-control" id="cash">
                            <label for="return">Return:</label>
                            <input type="text" class="form-control" id="return">
                        </div>
                        <!-- Debit/Credit form -->
                        <div class="form-group d-none" id="debit_credit-form">
                            <label for="total_dc">Total:</label>
                            <input type="text" class="form-control" id="total_dc">
                            <label for="card_no">Card Number:</label>
                            <input type="text" class="form-control" id="card_no">
                            <label for="expiry">Expiry:</label>
                            <input type="text" class="form-control" id="expiry">
                            <label for="cvv">CVV:</label>
                            <input type="text" class="form-control" id="cvv">
                        </div>

                        <!-- Mobile Payment form -->
                        <div class="form-group d-none" id="mobile_payment-form">
                            <h5>Scan/Tap</h5>
                            <img src="images/qr.PNG" alt="QR Code" class="img-fluid">
                        </div>
                    </div>

                    <!-- Coupons form -->
                    <div class="form-group d-none" id="coupons-form">
                        <label for="coupon_code">Coupon Code:</label>
                        <input type="text" class="form-control" id="coupon_code">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Pay</button>
                </div>
            </div>
        </div>

    </body>



    @include('user-layouts.scripts')

</html>
