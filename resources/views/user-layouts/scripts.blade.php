<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    function updateSubtotal() {
        let subtotal = 0;
        document.getElementById('product_price').value = null;
        document.getElementById('product_quantity').value = null;
        document.getElementById('product_ids').value = null;
        // Iterate over each product row
        var productRows = document.querySelectorAll('#product-list tr');
        productRows.forEach(function(row) {
            var priceElement = row.querySelector('.price-amt');
            var priceText = priceElement.textContent;
            var price = parseFloat(priceText.replace('Rs. ', ''));
            var quantityInput = row.querySelector('input[name="number"]');
            var quantity = parseInt(quantityInput.value);
            var rowTotal = price * quantity;


            var curr_id = row.querySelector('.price-id').textContent;
            var ids = document.getElementById('product_ids').value;
            if (ids == null || ids == '') {
                ids = curr_id;
            } else {
                ids = ids + ',' + curr_id;
            }
            document.getElementById('product_ids').value = ids;

            var q = document.getElementById('product_quantity').value;
            if (q == null || q == '') {
                q = quantity;
            } else {
                q = q + ',' + quantity;
            }
            document.getElementById('product_quantity').value = q;

            var pr = document.getElementById('product_price').value;
            if (pr == null || pr == '') {
                pr = price;
            } else {
                pr = pr + ',' + price;
            }
            document.getElementById('product_price').value = pr;


            subtotal += rowTotal;



        });

        // Calculate discount if available
        var discount = 0;

        // Update the subtotal and discount rows
        var subtotalAmount = document.getElementById('subtotal-amount');
        var discountAmount = document.getElementById('discount-amount');
        subtotalAmount.textContent = 'Rs. ' + subtotal.toFixed(2);
        document.getElementById('total_amt').value = subtotal.toFixed(2);
        // document.getElementById('disc_amt').value = discount.toFixed(2);
        // discountAmount.textContent = 'Rs. ' + discount.toFixed(2);
        document.getElementById('payable-amount').textContent = 'Rs. ' + (subtotal-discount).toFixed(2);
    }

    if(document.getElementById('disc_amt') != undefined){
        document.getElementById('disc_amt').addEventListener('change',function(){
            let disc_amt = this.value;
            var subtotalAmount = document.getElementById('subtotal-amount');
            let st = subtotalAmount.textContent;
            let numericValue = st.match(/\d+(\.\d+)?/);
            let subtotal;
            if (numericValue) {
                subtotal =  numericValue[0]; // Output: 1500.00
            } else {
                subtotal = 0;
            }

            var discountAmount = document.getElementById('discount-amount');
            let disc_type = document.getElementById('disc_type');
            if(disc_type.value == 'percent'){
                disc_amt = disc_amt/100*subtotal;
            }
            document.getElementById('payable-amount').textContent = 'Rs. ' + (subtotal-disc_amt).toFixed(2);
        });
    }


    function addProduct(id, productName, price, unique_id) {
        var productList = document.getElementById('product-list');


        var already_cart = document.getElementById(unique_id);
        if (already_cart != undefined) {
            var quantity = already_cart.getElementsByClassName('product-amount')[0];

            let new_quantity = parseInt(quantity.value) + 1;
            quantity.value = new_quantity;

        } else {
            var newRow = document.createElement('tr');
            newRow.setAttribute('id', unique_id);
            newRow.innerHTML = `
            <td width="20%">
            ITEM: <br> Quantity: <br> Item no:
            </td>
            <td width="60%">
            <div class="font-weight-bold" style="margin-left: 10px;">
                ${productName}
                <div class="product-qty">
                <span class="d-block">
                    <input type="number" name="number" class="product-amount" style="width:44px;padding: 4px 5px 5px 7px;font-size: 15px;" value="1">
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
        }

        // Update subtotal when a product is added
        updateSubtotal();

        // Attach event listeners to the buttons in the new row
        var plusButton = newRow.querySelector('.plus-button');
        var minusButton = newRow.querySelector('.minus-button');
        var deleteButton = newRow.querySelector('.delete-button');

        plusButton.addEventListener('click', function() {
            // Handle increment logic
            var quantityInput = newRow.querySelector('input[name="number"]');
            var quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;

            updateSubtotal();
        });

        minusButton.addEventListener('click', function() {
            // Handle decrement logic
            var quantityInput = newRow.querySelector('input[name="number"]');
            var quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;

                updateSubtotal();
            }
        });

        deleteButton.addEventListener('click', function() {
            // Handle deletion logic
            newRow.remove(); // Remove the row from the table

            updateSubtotal();
        });
    }
</script>



<script>
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;

    function onScanSuccess(decodedText, decodedResult) {
        $.ajax({
            type: "GET",
            url: "{{route('user.productdata')}}",
            data: {
                prod_uniq: decodedText
            },
            success: function(data) {
                let res = JSON.parse(data);
                if (res.length == 0) {
                    alert('Invalid Bar Code');
                } else {
                    console.log(res);
                    addProduct(res.product_id, res.product_name, res.sales_price, res.prod_uniq)
                }
            }
        });

    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess);
</script>
