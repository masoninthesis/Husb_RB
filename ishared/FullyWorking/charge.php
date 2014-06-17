<?php

require_once(dirname(__FILE__) . '/config.php');

if (isset($_POST['stripeToken'])) {

	$token = $_POST['stripeToken'];

	$customer = Stripe_Customer::create(array(
		'email' => 'customer@example.com',
		'card'  => $token
	));

	$charge = Stripe_Charge::create(array(
		'customer' => $customer->id,
		'amount'   => 1000,
		'currency' => 'usd'
	));

	if ($charge['paid']) {

		$resDB = mysql_connect("localhost", "jackuksf_ross", "Cd!12asaw");
		mysql_select_db("jackuksf_rosstest", $resDB);

		function createKey() {
			$strKey = md5(microtime());
			$resCheck = mysql_query("SELECT count(*) FROM downloads WHERE downloadkey = '{$strKey}' LIMIT 1");
			$arrCheck = mysql_fetch_assoc($resCheck);
			if ($arrCheck['count(*)']) {
				return createKey();
			} else {
				return $strKey;
			}
		}

		$strKey = createKey();
		mysql_query("INSERT INTO downloads (downloadkey, file, expires) VALUES ('{$strKey}', 'onetimedownload.zip', '".(time()+(60*60*24*7))."')");

	} else {
		// unsuccessful payment with stripe
	}

} else {
	// did not even try to pay with stripe
}

?>
<!DOCTYPE html>
<html class="no-js">
<head>
</head>
<body>
<?php if (isset($strKey)): ?>
	<h1>Successfully charged $10.00!</h1>
	<p>Your unique download URL is:</p>
	<a href="download.php?key=<?= $strKey ?>">download.php?key=<?= $strKey ?></a>
	<p>This link will allow you to download the source code a single time within the next 7 days.</p>
<?php else: ?>
	Fail!
<?php endif; ?>
</body>
</html>