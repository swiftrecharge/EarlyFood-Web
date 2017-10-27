<style>
    /* The Modal (background) */
    .modal-wallet {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        -webkit-animation-name: fadeIn; /* Fade in the background */
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s
    }

    /* Modal Content */
    .modal-content-wallet {
        position: fixed;
        bottom: 0;
        background-color: #fefefe;
        width: 100%;
        min-height: 100px;
        -webkit-animation-name: slideIn;
        -webkit-animation-duration: 0.4s;
        animation-name: slideIn;
        animation-duration: 0.4s
    }

    /* The Close Button */
    .close-wallet {
        margin-top: 10px;
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-wallet:hover,
    .close-wallet:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header-wallet {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body-wallet {padding: 2px 16px;
        min-height: 100px;
    }

    .modal-footer-wallet {
        height: 10px;
        background-color: #5cb85c;
        color: white;
    }

    /* Add Animation */
    @-webkit-keyframes slideIn {
        from {bottom: -300px; opacity: 0} 
        to {bottom: 0; opacity: 1}
    }

    @keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @-webkit-keyframes fadeIn {
        from {opacity: 0} 
        to {opacity: 1}
    }

    @keyframes fadeIn {
        from {opacity: 0} 
        to {opacity: 1}
    }
</style>
<!-- Trigger/Open The Modal -->
<a href="#" id="myBtnWallet" class="wallet_button">EarlyFood Wallet</a>

<!-- The Modal -->
<div id="myModalWallet" class="modal-wallet">

  <!-- Modal content -->
  <div class="modal-content-wallet">
    <div class="modal-header-wallet">
      <span class="close-wallet">&times;</span>
      <h2>EarlyFood Wallet</h2>
    </div>
    <div class="modal-body-wallet" id="txtHint">
        <?php
                if(isset($_SESSION["logged_user_id"])){
                    $value_id = $_SESSION["logged_user_id"];
                    $balance = get_balance($value_id);
                    $tot = $overAllCost + $total_shipping_cost;
                    $var1 = "Current Amount in Your EarlyFood Wallet: Ghc" .$balance;
                    $var2 = "Total Cost of order: Ghc" . $tot;
                    echo $var1;
                    echo "<br />";
                    echo $var2;
                    echo "<br />";
                    $tot = strval($tot);
                    $balance = strval($balance);
                    echo "<br />";
                    $out = bccomp($balance, $tot);
                    if ($out !='-1') {
                        //good bablance
                        $remaining = $balance -$tot;
                        $var3 = "Remaining Amount in Your Wallet After Order: Ghc" . $remaining;
                        echo $var3;
                        //if (isset($_SESSION['checkout_method'])) {
                            //unset($_SESSION['checkout_method']);
                            $_SESSION['checkout_method'] = "w";
                        //}
                        echo "<br />";
                        echo "<a href=\"#\" class=\"mpower_button\" id=\"pay_via_wallet\">Make Payment</a>";
                        //isset($_SESSION['checkout_method']) ? unset($_SESSION['checkout_method']) : $_SESSION['checkout_method'] = "w";
                        //$_SESSION['checkout_method'] = "w"; 
                    }else{
                        echo "You do not have enough money in your wallet. Please top-up or pay on delivery.";
                         //if (isset($_SESSION['checkout_method'])) {
                            //unset($_SESSION['checkout_method']);
                            $_SESSION['checkout_method'] = "p";
                        //}
                        echo "<br />";
                        echo "<a href=\"#\" class=\"mpower_button\" id=\"pay_via_wallet\">Pay On Delivery</a>";
                        //isset($_SESSION['checkout_method']) ? unset($_SESSION['checkout_method']) : $_SESSION['checkout_method'] = "p";
                        //$_SESSION['checkout_method'] = "p";
                    }
                        //bad balance
                }
        ?>
    </div>
    <div class="modal-footer-wallet">
    </div>
  </div>

</div>


<script>
    // Get the modal
    var modal_wallet = document.getElementById('myModalWallet');

    var cd_nav = document.getElementById('cd-primary-nav');

    // Get the button that opens the modal
    var btn_wallet = document.getElementById("myBtnWallet");

    // Get the <span> element that closes the modal
    var span_wallet = document.getElementsByClassName("close-wallet")[0];

    //var order_buton = document.getElementById("check_order");
    var paid_for = document.getElementById("paid_notice");
    //paid_for.style.display="none";
    var order_buton = document.getElementById("check_order");
    //order_buton.style.display = "none";
    var wallet_pay = document.getElementById("wallet_pay");
    


    // When the user clicks the button, open the modal 
    btn_wallet.onclick = function() {
        modal_wallet.style.display = "block";
        var pay_via_wallet = document.getElementById("pay_via_wallet");
        pay_via_wallet.onclick = function() {
            cd_nav.style.display = "none";
            wallet_pay.style.display="none";
            //paid_for.style.display="block";
            order_buton.style.display = "block";
            //order_buton.style.display="block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    span_wallet.onclick = function() {
        modal_wallet.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal_wallet) {
            modal_wallet.style.display = "none";
        }
    }
</script>