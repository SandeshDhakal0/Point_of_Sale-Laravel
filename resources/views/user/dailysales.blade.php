<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Styles for the search bar */
        .search-bar {
            /* position: relative; */
            display: inline-block;
            max-width: 300px;
        }

        .search-input {
            box-sizing: border-box;
            width: 100%;
            padding: 10px 30px 10px 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* background-image: url("search-icon.png"); */
            /* Path to your search icon image */
            background-repeat: no-repeat;
            background-position: 10px center;
            /* Adjust the position as needed */
            background-size: 20px;
            /* Adjust the size of the icon */
        }

        .list-item {
            text-decoration: none;
            display: block;

            display: flex;
            padding: 2% 4%;
            justify-content: space-between;


            list-style: none;
            display: inline-block;
            padding: 8px 12px;
            position: relative;
            border: 1px solid black;
        }

        .list {
            border: 1px solid black;
        }

        .grid-three-column {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            box-sizing: border-box;
            padding: 10px;
        }

        body {
            box-sizing: border-box;
        }



        .nav {
            display: flex;
            justify-content: left;
            align-items: center;

        }

        .nav-list {
            display: flex;
            text-decoration: none;
            list-style: none;
        }

        .list-list {
            border: 1px solid black;
            padding: 10px;

        }

        .order-list {
            box-sizing: border-box;
            padding: 20px;
        }

        .grid-three-column {
            display: grid;
            grid-template-columns: 3, 1fr;
            gap: 10px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }



        .order-details,
        .third {
            box-sizing: border-box;
            border: 0.5px solid rgb(201, 196, 196);
            padding: 20px;


        }

        .order-details {
            box-shadow: red;
            border: 1px solid rgb(168, 179, 168);
            padding: 10px;
            box-sizing: border-box;
        }

        .two {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .flex {
            display: flex;
        }

        .center {
            display: grid;
            justify-content: center;
            align-items: center;

        }

        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            border: 2px solid black;
            padding: 10px 18px;
            background: transparent;
            position: relative;
            cursor: pointer;
            font-size: 15px;
            background-color: #E05B76;
        }

        .add a {
            text-decoration: none;
            font-style: normal;
            color: black;
        }

        .order-detail {
            display: flex;
            gap: 50px;
            border: 1px solid black;
            padding: 10px;
        }
        .order-detail.active {
            background-color: #ccc;
        }
    </style>


    <link rel="stylesheet" href="style.css">
    <!-- <limk role="stylesheet" href="bootstrap.css"></limk> -->


</head>

<body>


    <div class="main">
        <div class="nav" style="display: none;">
            <ul class="nav-list">
                <li class="list-list"> Sale History</li>
                <li class="list-list"> Hold Sail</li>
                <li class="list-list"> Offline Sail</li>
            </ul>
        </div>


        <!-- <div class="sec-main"> -->
        <div class="main-container">

            <div class="grid-three-column">

                <!-- <div class="first"> -->
                <div class="order-list">


                    <input type="hidden" class="search-input" placeholder="Search">


                    <ul class="detail">
                        <?php $k = 0; ?>
                        @foreach($paids_invoices as $ps)
                        <a href="{{ route('user.dailysales')}}?invoice_id={{ $ps['id'] }}" style="text-decoration: none;">
                        <li class="order-detail <?php if(@$curr_inv['id'] == $ps['id']){ echo 'active'; } ?>">

                            <div class="id"><?php $k++; echo $k; ?></div>
                            <div class="date"><?php echo $ps['created_at']; ?></div>
                            <div class="total"><?php echo $ps['invoice_id']; ?></div>
                            <div class="total"><?php echo $ps['amount']; ?></div>

                        </li>
                        </a>
                        @endforeach

                    </ul>

                </div>



                <div class="order-details">
                    <div class="container">
                        <h2>Order ID</h2>
                        <h2><span id="invoice_id"><?php echo $invoice_id; ?></span></h2>
                        <!-- <h2><span>#N/A</span></h2> -->
                        <hr>
                        <h2>Order Date</h2>
                        <div class="add">
                            <p><span><ion-icon name="calendar-number-outline"></ion-icon></span>
                                <a><?php echo $created_at; ?>
                                </a>
                            </p>
                        </div>
                        <hr>
                        <h2>Costomer Detail</h2>
                        <div class="add">

                            <p>
                            {{ @$curr_inv['customer_name'] }}
                            </p>

                            <p><span><ion-icon name="call-outline"></ion-icon></span>
                            {{ @$curr_inv['customer_number'] }}
                            </p>
                        </div>
                        <div class="add">
                            <p><span><ion-icon name="mail-outline"></ion-icon></ion-icon></span>
                            {{ @$curr_inv['customer_email'] }}
                            </p>
                        </div>
                        <hr>


                        <div class="butt">
                            <a href="#" class="button" id="but" onclick="printPaymentSlip()">Print Invoice</a>
                            <a href="javascript:void(0);" class="button" id="return_button">Return</a>
                        </div>
                    </div>
                </div>


                <div class="third">
                    <div class="container-2">
                        <h2>Order Summery</h2>
                        <?php $amount = 0;?>
                        @foreach($invoices as $inv)
                            <?php if(isset($product[$inv['product_id']])){ ?>
                                <div class="two">
                                    <p><?php echo $product[$inv['product_id']]['product_name']; ?></p>
                                    <h3>Rs. <?php echo $inv['sold_amount']; ?></h3>
                                </div>

                                <span><?php echo $inv['sold_quantity']; ?> unit(s)</span>
                                <?php $amount = $amount + ((int) $inv['sold_amount'] * (int) $inv['sold_quantity']);  ?>
                                <br>
                            <?php } ?>
                        @endforeach
                        <div class="two">

                            <h4>Sub Total</h4>
                            <span id="subtotal-amount"> Rs. <?php echo $amount; ?></span>
                        </div>
                        <hr>
                        <div class="two">
                            <h4>discount:</h4>
                            <span>Rs. {{ @$curr_inv['discount'] }}</span>
                        </div>

                        <hr>
                        <div class="two">
                            <h4>taxes: </h4>
                            <span>Rs. {{ @$curr_inv['vat'] }}</span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>total</h2>
                            <span id="total-amount">Rs. {{ @$curr_inv['amount'] }}</span>
                        </div>
                        <div class="two">

                            <p>online Payment</p>
                            <span id="op">Rs. 0</span>
                        </div>
                        <!-- <div class="two">

                            <h2>total refunded</h2>
                            <span>-$100.00</span>
                        </div> -->
                        <div class="two">

                            <h2>grand Total</h2>
                            <span id="gt">Rs. {{ @$curr_inv['amount'] }}</span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>Balance</h2>
                            <span id="bal">Rs. {{ @$curr_inv['amount'] }}</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>
<script>



        function printPaymentSlip() {
        // Create a new window to hold the payment slip content
        var printWindow = window.open('', '_blank');

        // Generate the HTML content for the payment slip
        var paymentSlipContent = `
    <html>
      <head>
        <title>Payment Slip</title>
        <style>
        /* Styles for the search bar */
        .search-bar {
            /* position: relative; */
            display: inline-block;
            max-width: 300px;
        }

        .search-input {
            box-sizing: border-box;
            width: 100%;
            padding: 10px 30px 10px 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* background-image: url("search-icon.png"); */
            /* Path to your search icon image */
            background-repeat: no-repeat;
            background-position: 10px center;
            /* Adjust the position as needed */
            background-size: 20px;
            /* Adjust the size of the icon */
        }

        .list-item {
            text-decoration: none;
            display: block;

            display: flex;
            padding: 2% 4%;
            justify-content: space-between;


            list-style: none;
            display: inline-block;
            padding: 8px 12px;
            position: relative;
            border: 1px solid black;
        }

        .list {
            border: 1px solid black;
        }

        .grid-three-column {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            box-sizing: border-box;
            padding: 10px;
        }

        body {
            box-sizing: border-box;
        }



        .nav {
            display: flex;
            justify-content: left;
            align-items: center;

        }

        .nav-list {
            display: flex;
            text-decoration: none;
            list-style: none;
        }

        .list-list {
            border: 1px solid black;
            padding: 10px;

        }

        .order-list {
            box-sizing: border-box;
            padding: 20px;
        }

        .grid-three-column {
            display: grid;
            grid-template-columns: 3, 1fr;
            gap: 10px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }



        .order-details,
        .third {
            box-sizing: border-box;
            border: 0.5px solid rgb(201, 196, 196);
            padding: 20px;


        }

        .order-details {
            box-shadow: red;
            border: 1px solid rgb(168, 179, 168);
            padding: 10px;
            box-sizing: border-box;
        }

        .two {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .flex {
            display: flex;
        }

        .center {
            display: grid;
            justify-content: center;
            align-items: center;

        }

        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            border: 2px solid black;
            padding: 10px 18px;
            background: transparent;
            position: relative;
            cursor: pointer;
            font-size: 15px;
            background-color: #E05B76;
        }

        .add a {
            text-decoration: none;
            font-style: normal;
            color: black;
        }

        .order-detail {
            display: flex;
            gap: 50px;
            border: 1px solid black;
            padding: 10px;
        }
        .order-detail.active {
            background-color: #ccc;
        }
        </style>
      </head>
      <body>
      <div class="order-details">
                    <div class="container">
                        <h2>Order ID</h2>
                        <h2><span id="invoice_id"><?php echo $invoice_id; ?></span></h2>
                        <!-- <h2><span>#N/A</span></h2> -->
                        <hr>
                        <h2>Order Date</h2>
                        <div class="add">
                            <p><span><ion-icon name="calendar-number-outline"></ion-icon></span>
                                <a><?php echo $created_at; ?>
                                </a>
                            </p>
                        </div>
                        <hr>
                        <h2>Costomer Detail</h2>
                        <div class="add">

                            <p>
                            <?php echo @$curr_inv['customer_name']; ?>
                            </p>

                            <p><span><ion-icon name="call-outline"></ion-icon></span>
                            <?php echo @$curr_inv['customer_number']; ?>
                            </p>
                        </div>
                        <div class="add">
                            <p><span><ion-icon name="mail-outline"></ion-icon></ion-icon></span>
                            <?php echo @$curr_inv['customer_email']; ?>
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>


                <div class="third">
                    <div class="container-2">
                        <h2>Order Summery</h2>

                            <?php foreach($invoices as $inv){ if(isset($product[$inv['product_id']])){ ?>
                                <div class="two">
                                    <p><?php echo $product[$inv['product_id']]['product_name']; ?></p>
                                    <h3>Rs. <?php echo $inv['sold_amount']; ?></h3>
                                </div>

                                <span><?php echo $inv['sold_quantity']; ?> unit(s)</span>
                                <br>
                            <?php } }?>

                        <div class="two">

                            <h4>Sub Total</h4>
                            <span id="subtotal-amount"> Rs. <?php echo $amount; ?></span>
                        </div>
                        <hr>
                        <div class="two">

                            <h4>discount:</h4>
                            <span>Rs. <?php echo @$curr_inv['discount']; ?></span>
                        </div>

                        <hr>
                        <div class="two">
                            <h4>taxes: </h4>
                            <span>Rs. <?php echo @$curr_inv['vat']; ?></span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>total</h2>
                            <span id="total-amount">Rs. <?php echo @$curr_inv['amount']; ?></span>
                        </div>
                        <div class="two">

                            <p>online Payment</p>
                            <span id="op">Rs. 0</span>
                        </div>
                        <div class="two">

                            <h2>grand Total</h2>
                            <span id="gt">Rs. <?php echo @$curr_inv['amount']; ?></span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>Balance</h2>
                            <span id="bal">Rs. <?php echo @$curr_inv['amount']; ?></span>
                        </div>
                    </div>


                </div>
      </body>
    </html>
  `;

        // Set the content of the print window to the payment slip content
        printWindow.document.open();
        printWindow.document.write(paymentSlipContent);
        printWindow.document.close();

        // Print the payment slip
        printWindow.print();
    }

    $('#return_button').on('click',function(e){
        e.preventDefault();
        let data = [{name:'id',value:'<?php echo @$curr_inv['id']; ?>'}];
        $.ajax({
            url: '{{ route("user.return") }}',
            type: 'GET',
            data:data,
            success:function(res){
                res = JSON.parse(res);
                if(res.status == 200 ){
                    alert('Successfully returned the product.');
                    window.location.reload();
                }else{
                    alert('Something went wrong.');
                    // window.location.reload();
                }
            }
        });
    });

</script>
</html>
