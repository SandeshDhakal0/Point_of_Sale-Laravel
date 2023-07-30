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
    </style>


    <link rel="stylesheet" href="style.css">
    <!-- <limk role="stylesheet" href="bootstrap.css"></limk> -->


</head>

<body>


    <div class="main">
        <div class="nav">
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


                    <input type="text" class="search-input" placeholder="Search">


                    <ul class="detail">
                        <?php $k = 0; ?>
                        @foreach($paids_invoices as $ps)
                        <li class="order-detail">
                            <div class="id"><?php $k++; echo $k; ?></div>
                            <div class="date"><?php echo $ps['created_at']; ?></div>
                            <div class="total"><?php echo $ps['invoice_id']; ?></div>
                            <div class="total"><?php echo $ps['amount']; ?></div>
                        </li>
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
                            <label for="customer_name">Name:</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control">
                            </p>

                            <p><span><ion-icon name="call-outline"></ion-icon></span>
                                <label for="customer_number">Number:</label>
                                <input type="text" name="customer_number" id="customer_number" class="form-control">
                            </p>
                        </div>
                        <div class="add">
                            <p><span><ion-icon name="mail-outline"></ion-icon></ion-icon></span>
                                <label for="customer_number">Email:</label>
                                <input type="text" name="customer_email" id="customer_email" class="form-control">
                            </p>
                        </div>
                        <hr>


                        <div class="butt">
                            <a href="#" class="button" id="but">Print Invoice</a>
                            <a href="#" class="button">Return</a>
                        </div>
                    </div>
                </div>


                <div class="third">
                    <div class="container-2">
                        <h2>Order Summery</h2>
                        @foreach($invoices as $inv)
                            <?php if(isset($product[$inv['product_id']])){ ?>
                                <div class="two">
                                    <p><?php echo $product[$inv['product_id']]['product_name']; ?></p>
                                    <h3>Rs. <?php echo $inv['sold_amount']; ?></h3>
                                </div>

                                <span><?php echo $inv['sold_quantity']; ?> unit(s)</span>
                                <br>
                            <?php } ?>
                        @endforeach
                        <div class="two">

                            <h4>Sub Total</h4>
                            <span id="subtotal-amount"> Rs. <?php echo (int) $inv['sold_amount'] * (int) $inv['sold_quantity']; ?></span>
                        </div>
                        <hr>
                        <div class="two">

                            <h4>discount: <select class="form-control" id="disc_type"><option value="amount">Amount(Rs.)</option><option value="percent">Percentage(%)</option></select></h4>
                            <span>Rs. <input type="number" name="disc_amt" id="disc_amt"></span>
                        </div>

                        <hr>
                        <div class="two">

                            <h4>Payable Amount</h4>
                            <span id="payable-amount">Rs 0.00</span>
                        </div>
                        <div class="two">
                            <h4>taxes: <select class="form-control" id="tax_type"><option value="amount">Amount(Rs.)</option><option value="percent">Percentage(%)</option></select></h4>
                            <span>Rs. <input type="number" name="disc_amt" id="tax_amt"></span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>total</h2>
                            <span id="total-amount">Rs 100.00</span>
                        </div>
                        <div class="two">

                            <p>online Payment</p>
                            <span id="op">$100.00</span>
                        </div>
                        <!-- <div class="two">

                            <h2>total refunded</h2>
                            <span>-$100.00</span>
                        </div> -->
                        <div class="two">

                            <h2>grand Total</h2>
                            <span id="gt">$0.00</span>
                        </div>
                        <hr>
                        <div class="two">

                            <h2>Balance</h2>
                            <span id="bal">$0.00</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>
<script>
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

        document.getElementById('tax_amt').addEventListener('change',function(){
            let disc_amt = parseFloat(this.value);
            var subtotalAmount = document.getElementById('payable-amount');
            let st = subtotalAmount.textContent;
            let numericValue = st.match(/\d+(\.\d+)?/);
            let subtotal;
            if (numericValue) {
                subtotal =  parseFloat(numericValue[0]); // Output: 1500.00
            } else {
                subtotal = 0;
            }
            var discountAmount = document.getElementById('tax-amount');
            let disc_type = document.getElementById('tax_type');
            if(disc_type.value == 'percent'){
                disc_amt = parseFloat(disc_amt/100*subtotal);
            }
            let totalAmt = subtotal + disc_amt;
            console.log(typeof disc_amt);console.log(disc_amt);
            document.getElementById('total-amount').textContent = 'Rs. ' + totalAmt;
            document.getElementById('op').textContent = 'Rs. ' + totalAmt;
            document.getElementById('gt').textContent = 'Rs. ' + totalAmt;
            document.getElementById('bal').textContent = 'Rs. ' + totalAmt;
        });

</script>
</html>
