<?php
include '../../config.php';

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$serial = $_POST["address1"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt= "72toOcfuXCBizlYLEGqvVYeIUnXLOGsY";

$part1 = $_POST['udf1'];
$part2 = $_POST['udf2'];
$part3 = $_POST['udf3'];
$part4 = $_POST['udf4'];
$udf5 = $_POST['udf5'];

$url = "http://healthkind.is-great.net/create/".base64_decode($part1).base64_decode($part2).base64_decode($part3).base64_decode($part4);
$link_encode = base64_encode($url);

// $txnfile = fopen('../txnids/'.$txnid.'.txt', "w") or die("Unable to open file!");
// fwrite($txnfile, $link_encode);
// fclose($txnfile);

date_default_timezone_set("Asia/Calcutta");
$date =  'Not Available ('.$date = date('d/m/Y h:i:s a', time()).')';

$sql = "INSERT INTO `payments` (`serial`, `name`, `status`, `amount`, `transaction_id`, `encoded_value`, `pdf_created`, `pdf_onserver`) VALUES ('$serial', '$firstname', '$status', '$amount', '$txnid', '$link_encode', 0, '$date');";
$res = mysqli_query($link, $sql);

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        // $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||'.$part4.'|'.$part3.'|'.$part2.'|'.$part1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {

// "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|||||"

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  
    //    if ($hash != $posted_hash) {
	    //    echo "Invalid Transaction. Please try again";
		//    } else {
        //  echo "<h3>Your transaction is failed"."</h3>";
        //  echo "<h4>Your transaction id is ".$txnid.".</h4>";
		//  }
         
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

    #clock {
	    width: 80px;
	    height: 80px;
	    border-radius: 50%;
	    background-color: lightgrey;
	    margin: auto;
    }   

    span {
	    display: block;
	width: 100%;
	margin: auto;
	padding-top: 17px;
	text-align: center;
	font-size: 40px;
    }

.button {
  background-color: #4CAF50; /* Green */
  border: 1px;
  border-radius: 3px;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}



.button:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

</style>
<script>

var hash = '<?php echo $part1 ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
function gotoLink() {
    document.location = "http://healthkind.is-great.net/";
}

timeLeft = 3;

function countdown() {
	timeLeft--;
	document.getElementById("seconds").innerHTML = String( timeLeft );

	if (timeLeft > 1) {
        if(timeLeft == 7) {
            document.getElementById("button").style.display = "block";
        }
		setTimeout(countdown, 1000);
	} else {
        var payuForm = document.forms.payuForm;
        document.location = "http://healthkind.is-great.net/";
    }
};

setTimeout(countdown, 1000);

</script>

</head>
<body >

<h2>Transaction Failed</h2>
<p>Your Transaction ID for this transaction is&nbsp;<span style='color:green;font-size: 20px; font-weight:bold'><?php echo $txnid; ?></span></p>
<label style="color:red;">Redirecting to Report...</label>
<center>
<br>
    <div id="clock">
	    <span id="seconds">3</span>
    </div>
    <br>
    <br>
    <button id="button" class="button" onclick="gotoLink()" style="display: none">Go Home</button>
    </center>

    <!--<label style="color:red;">Redirecting to home page</label>
    <center>
<br>
    <div id="clock">
	    <span id="seconds">4</span>
    </div>
    <br>
    <br>
    <button href="http://healthkind.is-great.net/create/" class="button" >Goto Home</button>
    </center>
-->
</body>
</html>