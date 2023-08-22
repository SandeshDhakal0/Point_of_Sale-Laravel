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
                            {{ @$customer['firstname'] }}&nbsp;{{ @$customer['middlename'] }}&nbsp;{{ @$customer['lastname'] }}
                            </p>

                            <p><span><ion-icon name="call-outline"></ion-icon></span>
                            {{ @$customer['mobilenumber'] }}
                            </p>
                        </div>
                        <div class="add">
                            <p><span><ion-icon name="mail-outline"></ion-icon></ion-icon></span>
                            {{ @$customer['email'] }}
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


       var paymentSlipContent = `<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            display: grid;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .main {
            width: 595px;
            height: 842px;
            background: #FFF;
            box-shadow: 0px 10px 50px 0px rgba(51, 38, 60, 0.15), 0px 3px 10px 0px rgba(0, 0, 0, 0.07);
            padding: 30px;
        }

        .image {
            margin-left: 101px;
            margin-bottom: 23px;
        }

        .table {
            display: inline-block;
            width: 100%;
        }

        ul {
            list-style: none;
        }

        .list {
            display: flex;
            height: auto;
            width: 100%;
            padding: 2px;
            border-bottom: 1px solid #E0E0E0;
        }

        .sec-company-detail {
            text-align: right;
        }

        .sec-company-detail h1 {
            color: #6F6F84;
            text-align: right;
            font-family: sans-serif;
            font-size: 36px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 1.8px;
            margin-bottom: 16px;
        }

        #h3-head {
            margin-top: 10px;
            margin-bottom: 69px;

            color: #222234;
            font-family: sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        #sub-header {
            color: #222234;
            font-family: sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;

            margin-top: 5px;
            margin-bottom: 20px;
        }

        p {
            color: #222234;
            font-family: sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            width: 396px;
        }

        span {
            color: #6F6F84;
            font-family: sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        h3 {
            color: #222234;
            font-family: sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        h2 {
            color: #8D19E2;
            font-family: sans-serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            /* width: 323px; */
        }

        .i-detail {
            margin-bottom: 40px;
            width: 120px;

        }

        .invoice-detail {
            width: 102px;
        }

        .inv-table {
            width: 396px;
        }

        .detail {
            width: 396px;
        }


        /* Table */
        .table {
            width: 396px;
            height: 195px;
            flex-shrink: 0;
            border-radius: 8px;
            border: 1px solid #BCB0C4;
            background: #FAFAFC;
            margin-bottom: 20px;
        }

        .qty,
        .item,
        .price,
        .total {
            color: #6F6F84;
            text-align: center;
            font-family: sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            padding: 10px;
            width: 25%;
        }



        .qty-no,
        .item-name,
        .amount,
        .t-total {
            color: #222234;
            font-family:sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            text-align: center;
            padding: 10px;
            width: 25%;
        }

        .total-sub {
            color: #6F6F84;
            font-family: sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 0.6px;
            text-align: center;
        }

        .total-amount {
            color: #222234;
            text-align: center;
            font-family: sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }

        .added-total {
            color: #222234;
            font-family: sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 0.6px;
            padding: 12px 10px;


                width: 50%;
                text-align: left;


        }

        .added-total span {
            color: #6F6F84;
            font-family: sans-serif;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 0.6px;
        }

        .final {
            color: #8D19E2;
            font-family: sans-serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            width: 50%;
            text-align: right;
            padding: 5px;
        }

        .t-row {
            width: 100%;
            border-bottom: 2px solid #BCB0C4;
            display: inline-block;
        }

        .t-row-value {
            width: 100%;
            display: inline-flex;
        }

        .qty,
        .qty-no {
            width: 20%;
            text-align: left;
        }

        .item,
        .item-name {
            width: 45%;
            text-align: left;
        }

        .price,
        .amount {
            width: 20%;
            text-align: right;
        }

        .total,
        .t-total {
            width: 20%;
            text-align: right;
        }

        .total-sub {
            width: 50%;
            text-align: left;
        }

        .total-amount {
            width: 50%;
            text-align: right;
        }

        .t-row-value-2 {
            /* padding-left: 10px;
            padding-right: 10px; */
            padding: 5px 10px;
        }

        .pay-method {
            margin-top: 88px;
            margin-bottom: 20px;
        }
        .footer {
            margin: 30px;
            text-align: center;
        }

        .f-footer {
            color: #6F6F84;
            font-family: sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .f-footer a{
            color: #222234;
        font-family: sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        text-decoration: none;
        }

        .link {
            color: #8D19E2;
            font-family: sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="main">
        <div class="main-content" style="display: flex; gap:100px;">
            <!-- <div class="two-1"> -->
            <div class="company-detail">
            <svg width="50" class="image" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="Group 12">
<g id="Vector">
<path d="M25 0C11.215 0 0 11.2147 0 24.9994C0 38.7841 11.215 49.9988 25 49.9988C38.785 49.9988 50 38.7841 50 24.9994C50 11.2147 38.785 0 25 0ZM25 48.3322C12.1339 48.3322 1.66666 37.8652 1.66666 24.9994C1.66666 12.1336 12.1339 1.66663 25 1.66663C37.8661 1.66663 48.3333 12.1336 48.3333 24.9994C48.3333 37.8652 37.8661 48.3322 25 48.3322Z" fill="#7A0FC8"/>
<path d="M25.5555 3.33334C13.6083 3.33334 3.88886 13.0526 3.88886 24.9995C3.88886 36.9464 13.6083 46.6657 25.5555 46.6657C37.5028 46.6657 47.2222 36.9464 47.2222 24.9995C47.2222 13.0526 37.5028 3.33334 25.5555 3.33334ZM25.5555 44.999C14.5272 44.999 5.55555 36.0276 5.55555 24.9995C5.55555 13.9714 14.5272 4.99997 25.5555 4.99997C36.5839 4.99997 45.5555 13.9714 45.5555 24.9995C45.5555 36.0276 36.5839 44.999 25.5555 44.999Z" fill="#7A0FC8"/>
<path d="M24.4444 6.66645C14.3355 6.66645 6.11112 14.8907 6.11112 24.9994C6.11112 35.108 14.3355 43.3323 24.4444 43.3323C34.5533 43.3323 42.7778 35.108 42.7778 24.9994C42.7778 14.8907 34.5533 6.66645 24.4444 6.66645ZM24.4444 41.6656C15.2544 41.6656 7.77778 34.1891 7.77778 24.9994C7.77778 15.8096 15.2544 8.33308 24.4444 8.33308C33.6344 8.33308 41.1111 15.8096 41.1111 24.9994C41.1111 34.1891 33.6344 41.6656 24.4444 41.6656Z" fill="#7A0FC8"/>
<path d="M25.5556 9.9999C17.2845 9.9999 10.5556 16.7286 10.5556 24.9996C10.5556 33.2705 17.2845 39.9992 25.5556 39.9992C33.8267 39.9992 40.5556 33.2705 40.5556 24.9996C40.5556 16.7286 33.8267 9.9999 25.5556 9.9999ZM25.5556 38.3326C18.2039 38.3326 12.2222 32.3511 12.2222 24.9996C12.2222 17.6481 18.2039 11.6665 25.5556 11.6665C32.9072 11.6665 38.8889 17.6481 38.8889 24.9996C38.8889 32.3511 32.9072 38.3326 25.5556 38.3326Z" fill="#7A0FC8"/>
<path d="M24.4444 13.333C18.0111 13.333 12.7778 18.5662 12.7778 24.9994C12.7778 31.4326 18.0111 36.6658 24.4444 36.6658C30.8778 36.6658 36.1111 31.4326 36.1111 24.9994C36.1111 18.5662 30.8778 13.333 24.4444 13.333ZM24.4444 34.9992C18.9305 34.9992 14.4445 30.5132 14.4445 24.9994C14.4445 19.4857 18.9305 14.9996 24.4444 14.9996C29.9583 14.9996 34.4444 19.4857 34.4444 24.9994C34.4444 30.5132 29.9583 34.9992 24.4444 34.9992Z" fill="#7A0FC8"/>
<path d="M25.5556 16.6664C20.9606 16.6664 17.2222 20.4046 17.2222 24.9995C17.2222 29.5944 20.9606 33.3326 25.5556 33.3326C30.1506 33.3326 33.8889 29.5944 33.8889 24.9995C33.8889 20.4046 30.1506 16.6664 25.5556 16.6664ZM25.5556 31.666C21.8795 31.666 18.8889 28.6755 18.8889 24.9995C18.8889 21.3235 21.8795 18.333 25.5556 18.333C29.2317 18.333 32.2222 21.3235 32.2222 24.9995C32.2222 28.6755 29.2317 31.666 25.5556 31.666Z" fill="#7A0FC8"/>
<path d="M24.4444 19.9995C21.6878 19.9995 19.4444 22.2428 19.4444 24.9994C19.4444 27.756 21.6878 29.9992 24.4444 29.9992C27.2011 29.9992 29.4444 27.756 29.4444 24.9994C29.4444 22.2428 27.2011 19.9995 24.4444 19.9995ZM24.4444 28.3326C22.6061 28.3326 21.1111 26.8376 21.1111 24.9994C21.1111 23.1611 22.6061 21.6661 24.4444 21.6661C26.2828 21.6661 27.7778 23.1611 27.7778 24.9994C27.7778 26.8376 26.2828 28.3326 24.4444 28.3326Z" fill="#7A0FC8"/>
</g>
<path id="Vector_2" d="M25 50C11.215 50 0 38.6873 0 24.7823C0 24.7823 4.4611 28.9354 8.01887 30.3348C16.8935 33.8258 22.3887 23.3595 31.8396 24.7823C36.3165 25.4563 38.3293 29.1556 42.8066 28.484C45.9424 28.0137 50 24.7823 50 24.7823C50 38.6873 38.785 50 25 50Z" fill="url(#paint0_linear_1_7)"/>
</g>
<defs>
<linearGradient id="paint0_linear_1_7" x1="21.6087" y1="24.1256" x2="38.2047" y2="49.8435" gradientUnits="userSpaceOnUse">
<stop stop-color="#AE3EFF"/>
<stop offset="1" stop-color="#3E006A"/>
</linearGradient>
</defs>
</svg>
                <h2>Machhapuchre Furneshing Center</h2>
                <span>Samakhhushi Kathmandu, Nepal</span><br>
                <span>10004, United State</span>
                <h3 id="h3-head"> 27 March, 2020</h3>
            </div>
            <!-- <div class="two-2" style="text-align: right;"> -->
            <div class="sec-company-detail" style="text-align: right;">
                <h1>Invoice</h1>
                <span>Billed to,</span>
                <h3><?php echo @$customer['firstname'].' '.@$customer['middlename'].' '.@$customer['lastname']; ?></h3>
                <span><?php echo  @$customer['email']; ?></span><br>
                <span><?php echo @$customer['mobilenumber']; ?></span><br>

            </div>
        </div>
        <!-- <div class="three"> -->
        <div class="subject">
            <span>Subject</span>
            <h3 id="sub-header"></h3>
        </div>
        <!-- <div class="four" style="display: flex; gap: 80px;"> -->
        <div class="invoice" style="display: flex; gap: 95px;">
            <!-- <div class="four-1"> -->
            <div class="invoice-detail">
                <div class="i-detail">
                    <span>Invoice number</span>
                    <h3><?php echo $invoice_id; ?></h3>
                </div>
            </div>
            <!-- <div class="four-2"> -->
                <div class="detail">
                <!-- <div class="four-2-1"> -->
                    <div class="inv-table">

                    <div class="table">
                        <div class="t-row">
                            <div class="t-row-value" style="display: flex;">
                                <div class="qty">QTY</div>
                                <div class="item">ITEM DESCRIPTION</div>
                                <div class="price">RATE</div>
                                <div class="total">AMOUNT</div>
                            </div>
                        </div>
                        <?php foreach($invoices as $inv){ if(isset($product[$inv['product_id']])){ ?>
                        <div class="t-row">
                            <div class="t-row-value" style="display: flex;">
                                <div class="qty-no"><?php echo $inv['sold_quantity']; ?></div>
                                <div class="item-name"><?php echo $product[$inv['product_id']]['product_name']; ?></div>
                                <div class="amount">Rs. <?php echo $product[$inv['product_id']]['sales_price']; ?></div>
                                <div class="t-total">Rs. <?php echo  $inv['sold_amount']; ?></div>
                            </div>
                        </div>
                        <?php }} ?>
                        <div class="t-row" style="border-bottom: none; margin: 0px; padding-bottom: 0px;">
                            <div class="t-row-value-2" style="display: flex;">
                                <div class="total-sub">Sub Total</div>
                                <div class="total-amount">Rs. <?php echo $amount; ?></div>
                            </div>
                        </div>
                        <div class="t-row">
                            <div class="t-row-value-2" style="display: flex;">
                                <div class="total-sub">Discount</div>
                                <div class="total-amount">Rs. <?php echo @$curr_inv['discount']; ?></div>
                            </div>
                        </div>
                        <div class="t-row-last">
                            <div class="t-row-value" style="display: flex; border-bottom: none; margin: 0px; padding-bottom: 0px; border-collapse: collapse;">
                                <div class="added-total">Total <span>(Rs.)</span></div>
                                <div class="final">Rs. <?php echo @$curr_inv['amount']; ?></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <div class="four-2-2"> -->
                    <div class="terms">
                    <span>Terms & Condition</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, rerum.
                    </p>
                </div>
            </div>
        </div>

        <!-- <div class="five"> -->
        <div class="pay-method">
            <span>Payment Details</span><br>
            <!-- <span style="display: flex;">Paypal: <h4>example@email.com</h4> </span>
            <span style="display: flex;">UPI: <h4>userid@okbank</h4> </span> -->
            <span class="f-footer"> paypal:<a href=""> example@gmail.com</a></span><br>
            <span class="f-footer"> UPI:<a href=""> userid@bank</a></span>

        </div>
        <hr>
        <!-- <div class="sixx"> -->
        <div class="footer">
            <a href="" class="link"> www.google.com</a>
        </div>




</body>

</html>`;


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
