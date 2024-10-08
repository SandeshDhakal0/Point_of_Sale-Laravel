<!DOCTYPE html>
<html>

<head>
    @include('user-layouts.meta')
    <style>
        .payment-method {
            width: 100%;
            height: 50px;
            background: #afacacba;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            cursor: pointer;
            transition: 0.5s;
        }

        .payment-method.active {
            background-color: white;
            border: none;
            border-left: 4px solid red;
        }

        .total-amt {
            width: 100%;
            height: 50px;
            padding-left: 20px;
        }

        .total-amt h4 {
            margin: 0;
            width: 100%;
            display: flex;
            justify-content: end;
            color: red;
            font-weight: 700;
        }

        .total-amt p {
            margin: 0;
            display: flex;
            justify-content: end;
            margin-top: 3px;
            border-bottom: 1px solid #afacacba;
        }

        .calculator {
            height: 37.5px;
            /* background:#afacacba; */
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            cursor: pointer;
            transition: 0.5s;
        }

        .calculator:hover {
            background-color: #afacacba;
            color: white;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            color: red;
            padding: 6px 28px;
        }

        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .amt-div {
            width: 20%;
            height: 40px;
            background-color: #c5c2c2;
            border-radius: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .charge-amt {
            display: flex;
            justify-content: space-between;
            width: 15%;
            font-size: 18px;
        }

        .charge-amt p {
            color: yellowgreen;
        }

        #cc_card {
            position: absolute;
            bottom: 0;
            border: 0;
            border-bottom: 1px solid black;
            border-radius: 0;
            background: #04ff0087;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
        }

        input {
            cursor: pointer;
        }

            .payment-method {
                padding: 10px;
                border: 1px solid #ccc;
                cursor: pointer;
                text-align: center;
            }

            .payment-method.active {
                background-color: #f2f2f2;
            }

            .mobile-payment-details {
                text-align: center;
                margin-top: 20px;
            }

            .qr-code {
                max-width: 20%;
                height: auto;
            }
    </style>
</head>

<body>
    @include('user-layouts.header')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-4">
                <div class="payment-method active" data-Dclass="cash-payment">
                    Cash Payment
                </div>
                <div class="payment-method" data-Dclass="card-payment">
                    Debit/Credit Payment
                </div>
                <div class="payment-method" data-Dclass="split-payment">
                    Split Payment
                </div>
                <div class="payment-method" data-Dclass="mobile-payment">
                    Mobile Payment
                </div>
            </div>
            <div class="col-8 row cash-payment">
                <div class="col-6">
                    <div class="total-amt" id="given_amt">
                        <h4>{{ $payable }}</h4>
                        <p>Total</p>
                    </div>
                    <div class="total-amt" id="tendered_amt">
                        <h4>0</h4>
                        <p>Tendered</p>
                    </div>
                    <div class="total-amt" id="total_amt">
                        <h4>{{ $payable }}</h4>
                        <p>Charge</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row w-100 m-0">
                        <div class="col-4 calculator">1</div>
                        <div class="col-4 calculator">2</div>
                        <div class="col-4 calculator">3</div>
                        <div class="col-4 calculator">4</div>
                        <div class="col-4 calculator">5</div>
                        <div class="col-4 calculator">6</div>
                        <div class="col-4 calculator">7</div>
                        <div class="col-4 calculator">8</div>
                        <div class="col-4 calculator">9</div>
                        <div class="col-4 calculator">.</div>
                        <div class="col-4 calculator">0</div>
                        <div class="col-4 calculator">C</div>
                    </div>
                </div>
            </div>
            <div class="col-8 row card-payment d-none" style="padding-left: 20px;padding-right: 15px;">
                <div class="card w-100 p-0">
                    <div class="card-header">
                        <p>Total Payable</p>
                        <p>Rs. {{ $payable }}</p>
                    </div>
                    <div class="card-body">
                        <div class="amt-div">Rs. {{ $payable }}</div>
                        <div class="charge-amt">Charge <p>Rs. 0</p>
                        </div>
                    </div>
                </div>
                <div class="input-container mt-3">
                    <div class="form-group w-50">
                        <label class="form-label" for="selectBank">Select Label</label>
                        <select class="form-control" name="bank_name" id="selectBank">
                            <option value="RBB">Rastriya Banijya Bank</option>
                            <option value="GIB">Global IME Bank</option>
                            <option value="NIMB">Nepal Investment Mega Bank</option>
                        </select>
                    </div>
                    <div class="form-group" style="width: 9%;position: relative;">
                        <input type="text" class="form-control" name="card_cc" id="cc_card" placeholder="XXXX">
                    </div>
                </div>
            </div>
            <div class="col-8 row split-payment d-none" style="padding-left: 20px;padding-right: 15px;">
                <div class="card w-100 p-0">
                    <div class="card-header">
                        <p>Total Payable</p>
                        <p>Rs. {{ $payable }}</p>
                    </div>
                    <div class="card-body">
                        <div class="amt-div">Rs. {{ $payable }}</div>
                        <div class="charge-amt">Charge <p>Rs. 0</p>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin:0;margin-top: 20px;font-size: 18px;width:50%;">
                    <input class="form-conrol" type="checkbox" id="is_cash">
                    <label for="is_cash">Cash</label>
                </div>
                <div class="form-group d-none" id="half_cash" style="width:50%;margin-top:20px;display:flex;justify-content:end;">
                    <input type="text" name="cash" class="form-control" id="split_cash" style="width:50%;" placeholder="0">
                </div>
                <div class="form-group" style="margin-top: 10px;font-size: 18px;">
                    <input class="form-conrol" type="checkbox" id="is_credit">
                    <label for="is_credit">Credit</label>
                </div>
                <div class="input-container mt-3 d-none" id="half_credit">
                    <div class="form-group w-50">
                        <label class="form-label" for="selectBank">Select Label</label>
                        <select class="form-control" name="bank_name" id="selectBank">
                            <option value="RBB">Rastriya Banijya Bank</option>
                            <option value="GIB">Global IME Bank</option>
                            <option value="NIMB">Nepal Investment Mega Bank</option>
                        </select>
                    </div>
                    <div class="form-group" style="width: 9%;position: relative;">
                        <input type="text" class="form-control" name="card_cc" id="split_credit" placeholder="XXXX">
                    </div>
                </div>
            </div>

           

            <div class="col-8 row mobile-payment d-none">
            <div class="mobile-payment-details">
                <img class="qr-code" src="https://play-lh.googleusercontent.com/lomBq_jOClZ5skh0ELcMx4HMHAMW802kp9Z02_A84JevajkqD87P48--is1rEVPfzGVf" alt="Mobile Payment QR Code">
                <p>Scan the QR code above with your mobile payment app to complete the payment.</p>
            </div>
            </div>

            <div class="col-8"></div>
            <div class="col-4 mt-3" style="padding: 0;padding-right: 30px;">
                <textarea style="width:100%;height:70px;" placeholder="Add Order Note Here ...."></textarea>
                <button type="submit" class="btn btn-md btn-secondary float-end" id="confirm-payment"><i class="fa fa-money" aria-hidden="true"></i> Confirm Payment</button>
            </div>
        </div>
    </div>

</body>

@include('user-layouts.scripts')
<script>
    let paymentmethod = $('.payment-method');
    paymentmethod.each(function() {
        $(this).on('click', function() {
            paymentmethod.removeClass('active');
            if (!$('.cash-payment').hasClass('d-none')) {
                $('.cash-payment').addClass('d-none')
            }
            if (!$('.card-payment').hasClass('d-none')) {
                $('.card-payment').addClass('d-none')
            }
            if (!$('.split-payment').hasClass('d-none')) {
                $('.split-payment').addClass('d-none')
            }
            if (!$('.mobile-payment').hasClass('d-none')) {
                $('.mobile-payment').addClass('d-none')
            }
            $(this).addClass('active');
            dataclass = $(this).attr('data-Dclass');
            $('.' + dataclass).removeClass('d-none');
        });
    });
    $('#is_credit').on('change', function() {
        if ($(this).is(':checked')) {
            $('#half_credit').removeClass('d-none');
        } else {
            $('#half_credit').addClass('d-none');
        }
    });
    $('#is_cash').on('change', function() {
        if ($(this).is(':checked')) {
            $('#half_cash').removeClass('d-none');
        } else {
            $('#half_cash').addClass('d-none');
        }
    });

    $('.calculator').on('click', function() {
        var val = $(this).html();

        var curr = $('#tendered_amt h4').html();
        var total_amt = $('#total_amt h4').html();
        var given_amt = $('#given_amt h4').html();
        if (val == 'C') {
            if (curr > 9) {
                var curr_amt = curr.slice(0, -1);
                $('#tendered_amt h4').html(curr_amt);
                let final_amt = parseFloat(given_amt) + parseFloat(curr_amt);
                $('#total_amt h4').html(final_amt);

            } else {
                $('#tendered_amt h4').html('0');
                $('#total_amt h4').html(given_amt);
            }

        } else {
            if (curr == 0) {
                $('#tendered_amt h4').html(val);
                $('#total_amt h4').html(parseFloat(given_amt) + parseFloat(val));
            } else {
                $('#tendered_amt h4').html(curr + val);
                $('#total_amt h4').html(parseFloat(given_amt) + parseFloat(curr + val));

            }
        }

    });
    $('#confirm-payment').on('click', function() {
        let paymentclass = $('.payment-method.active').attr('data-Dclass');
        let data = $('.' + paymentclass);
        if (paymentclass == 'cash-payment') {
            payable = $('#total_amt h4').html();
        }else if(paymentclass == 'card-payment'){
            payable = $('#total_amt h4').html();
            cc_val = $('#cc_card').val();
            if(!isValidCVV(cc_val)){
                alert('Invalid CVV');
                exit;
            }
        }else{
            payable = $('#total_amt h4').html();
            if($('#is_cash').is(':checked') && ($('#split_cash').val() == null || $('#split_cash').val() == '')){
                alert('Enter the amount of cash ');
                exit;
            }
            if($('#is_credit').is(':checked') && (!isValidCVV($('#split_credit').val()))){
                alert('Enter Valid CVV');
                exit;
            }
            if(!$('#is_cash').is(':checked') && !$('#is_credit').is(':checked')){
                alert('Choose a Payment Method.');
                exit;
            }
        }

            // Example usage
        var paymentDetails = {
            amount: payable,
            invoiceId: 'INV-'+generateRandom4DigitNumber(),
            date: new Date()
        };
        printPaymentSlip(paymentDetails);
        window.location.href = '{{ route("user.index") }}';
    });
    function isValidCVV(cvv) {
        var cvvPattern = /^[0-9]{3,4}$/;
        return cvvPattern.test(cvv);
    }
    function generateRandom4DigitNumber() {
        var min = 1000; // Minimum 4-digit number (inclusive)
        var max = 9999; // Maximum 4-digit number (inclusive)
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function printPaymentSlip(paymentDetails) {
        // Create a new window to hold the payment slip content
        var printWindow = window.open('', '_blank');

        // Generate the HTML content for the payment slip
        var paymentSlipContent = `
    <html>
      <head>
        <title>Payment Slip</title>
        <style>
          /* Add your custom styles for the payment slip here */
          /* For example: */
          body {
            font-family: Arial, sans-serif;
          }
          .header {
            text-align: center;
            margin-bottom: 20px;
          }
          .amount {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
          }
          .details {
            margin-bottom: 10px;
          }
        </style>
      </head>
      <body>
        <div class="header">
          <h1>Payment Slip</h1>
        </div>
        <div class="amount">
          Amount: ${paymentDetails.amount}
        </div>
        <div class="details">
          <strong>Invoice ID:</strong> ${paymentDetails.invoiceId}
        </div>
        <div class="details">
          <strong>Date:</strong> ${paymentDetails.date}
        </div>
        <!-- Add more payment details as needed -->
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
</script>

</html>
