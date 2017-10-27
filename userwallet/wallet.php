<?php 

   $merchant_key = "dbf84458-212f-11e7-bf7c-f23c9170642f";
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 25; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION["deposit_invoice"] = $randomString;

?>
<html>
    <head>
        <title>(Type a title for your page here)</title>
        <script type="text/javascript">
            function setVisibility() {
                document.getElementById('iframe1').style.display = "block";
            }
            </script>
            <style type="text/css">
            #iframe1 {
                display:none;
            }
        </style>
        <noscript>
            <style type="text/css">
            #iframe1 {
                display:block;
            }
            </style>
        </noscript>
    </head>
    <body>
        <iframe src="about:blank" name="myFrame" width="600" height="350" scrolling="auto" frameborder="1" id="iframe1">
        </iframe>
            <form method="POST" action="https://community.ipaygh.com/gateway" target="myFrame">
            <input type="hidden" name="merchant_key" value="dbf84458-212f-11e7-bf7c-f23c9170642f" />
            <input type="hidden" name="success_url" value="" />
            <input type="hidden" name="cancelled_url" value="" />
            <input type="hidden" name="deferred_url" value="" />
            <input type="hidden" name="ipn_url" value="https://earlyfood.com/userwallet/paymentstatus.php" />
            Invoice ID <input type="text" name="invoice_id" value="<?php echo $_SESSION["deposit_invoice"];  ?>" />
            <table cellspacing="0px" cellpadding="0px" border="0">
                <tr >
                    <td align="right">
                        <b>GH&cent;</b>
                        <input name="total" type="text" size="10" />
                        <input type="submit" value="Deposit" name="type" onclick="setVisibility();"/>
                    </td>
                </tr>
            </table>
            </form>
       <!-- <form action="http://www.google.com/search" target="myFrame">
            Search: <input type="text" name="q"><br>
            <input type="submit" value="Go!" name="type" onclick="setVisibility();">
        </form> -->
    </body>
</html>