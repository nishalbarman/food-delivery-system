<?php
include '../config/db.php';
$serial = $_GET['id'];
$userid = $_GET['userid'];
$txnid = '';

$sql = "select * from fooditems where id = '$serial'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
  $food_title = $row['title'];
  $amount = $row['amount'];
}

$sql = "select * from users where phone = '$userid'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
  $fname = $row['fname'];
  $address = $row['address'];
}


$MERCHANT_KEY = "CY4YAH";
$SALT = "72toOcfuXCBizlYLEGqvVYeIUnXLOGsY";

$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$formError = 0;

if (empty($txnid)) {
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
}

$hash = '';
$hashSequence = $MERCHANT_KEY . "|" . $txnid . "|" . $amount . "|" . $food_title . "|" . $fname . "||" . $serial . "||||||||||" . $SALT;

$hash = strtolower(hash('sha512', $hashSequence));

$action = $PAYU_BASE_URL . '/_payment';

?>

<html>

<head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if (hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
</head>

<body onload="submitPayuForm()">
  <?php if ($formError) { ?>

  <span style="color:red">Please fill all mandatory fields.</span>
  <br />
  <br />
  <?php } ?>
  <form action="<?php echo $action; ?>" method="post" name="payuForm">
    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>" />
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $fname; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo ''; ?>" />
    <input type="hidden" name="phone" value="<?php echo $userid; ?>" />
    <input type="hidden" name="address1" value="<?php echo $address; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $food_title; ?>" />
    <input type="hidden" name="udf1" value="<?php echo $serial; ?>" />

    <input type="hidden" name="surl" value="http://localhost/food/payu/success.php" size="64" />
    <input type="hidden" name="furl" value="http://localhost/food/payu/success.php" size="64" />

    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    <?php if (1 == 0) { ?>
    <td colspan="4"><input type="submit" value="Submit" /></td>
    <?php } ?>

  </form>
</body>

</html>