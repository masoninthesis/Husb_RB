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

        <div class="col-sm-6">

          <?php require_once('./config.php'); ?>

          <h2>Download the Album</h2>
          <form action="charge.php" method="POST">
          <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_JAHe4dJj0fL5atoVqjTH6r0Q"
            data-image="/square-image.png"
            data-name="Digital Download"
            data-description="2 widgets ($20.00)"
            data-amount="500">
          </script>
          </form>
        </div>

        <div class="col-sm-6">
          <h2>Buy a Physical Copy</h2>
          <form action="ship.php" method="POST">
          <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_JAHe4dJj0fL5atoVqjTH6r0Q"
            data-image="/square-image.png"
            data-name="Demo Site"
            data-description="One Physical Copy"
            data-amount="1000"
            data-shipping-address="true">
          </script>
          </form>
        </div>

        <h1 style="padding-top: 175px;">Head Up Shoulders Back</h1>

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