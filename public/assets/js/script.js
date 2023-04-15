
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("mySidenav").style.padding = "10px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }
    
    function closeNav() {
        document.getElementById("mySidenav").style.padding = "0";
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }

////payment

    $(document).ready(function() {
      // Show the cash form by default
      $('#cash-form').removeClass('d-none');

      // Toggle the forms when the corresponding button is clicked
      $('#cash-btn').click(function() {
        $('#cash-form').removeClass('d-none');
        $('#debit_credit-form').addClass('d-none');
        $('#mobile_payment-form').addClass('d-none');
        $('#coupons-form').addClass('d-none');
      });
      $('#debit_credit-btn').click(function() {
        $('#cash-form').addClass('d-none');
        $('#debit_credit-form').removeClass('d-none');
        $('#mobile_payment-form').addClass('d-none');
        $('#coupons-form').addClass('d-none');
      });
      $('#mobile_payment-btn').click(function() {
        $('#cash-form').addClass('d-none');
        $('#debit_credit-form').addClass('d-none');
        $('#mobile_payment-form').removeClass('d-none');
        $('#coupons-form').addClass('d-none');
      });
      $('#coupons-btn').click(function() {
        $('#cash-form').addClass('d-none');
        $('#debit_credit-form').addClass('d-none');
        $('#mobile_payment-form').addClass('d-none');
        $('#coupons-form').removeClass('d-none');
      });
    });
