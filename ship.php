<?php

require_once(dirname(__FILE__) . '/config.php');

if (isset($_POST['stripeEmail']) && isset($_POST['stripeToken'])) {

  $email = $_POST['stripeEmail'];
  $token = $_POST['stripeToken'];

  $customer = Stripe_Customer::create(array(
    'email' => $email,
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Thanks for Sharing!</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Jackalope CSS -->
    <link href="css/jackalope.css" rel="stylesheet">
    <link href="plugin/css/style.css" rel="stylesheet">
    <!-- <link href="css/demo.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="plugin/jquery-jplayer/jquery.jplayer.js"></script>
    <script type="text/javascript" src="plugin/ttw-music-player-min.js"></script>
    <script type="text/javascript" src="js/myplaylist.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var description = "Hey, thanks for sharing my album. Here it is, I've spent a long time on it so I hope you enjoy! ";

            $('.player').ttwMusicPlayer(myPlaylist, {
                autoPlay:false,
                description:description,
                jPlayer:{
                    swfPath:'../plugin/jquery-jplayer' //You need to override the default swf path any time the directory structure changes
                }
            });
        });
    </script>

  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1>Thanks for sharing!</h1>
        <p class="lead">Enjoy the album. If you'd like to download the tracks or buy a physical copy, use the links below to do so.</p>
      </div>

      <div class="main-content">

      <?php if (isset($strKey)): ?>
        <h2>Successfully charged $10.00!</h2>
        <p>Here is your unique download link:</p>
        <a href="download.php?key=<?= $strKey ?>"><h2>Click to Download Music</h2></a>
        <p>This link will allow you to download the source code a single time within the next 7 days.</p>
      <?php else: ?>
        <font color="#ff0000">If you'd like to download, pay with Card, Paypal or BitCoin.</font>
      <?php endif; ?>

        <h1>Head Up Shoulders Back</h1>

        <div class="player"></div>

        <ul>
          <li><a href="#">RossOwenBrown.com</a></li>
          <li><a href="#">Buy Merchandise</a></li>
          <li><a href="#">Some Other Link</a></li>
        </ul>

      </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>