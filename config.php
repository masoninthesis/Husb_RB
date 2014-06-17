<?php
require_once('./lib/Stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_m4hA3TGvzaDAUIXxATc55Maw",
  "publishable_key" => "pk_test_JAHe4dJj0fL5atoVqjTH6r0Q"
);

Stripe::setApiKey($stripe['secret_key']);
?>