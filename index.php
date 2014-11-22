<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Encoder</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Video</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--<li><a href="#">About</a></li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Video Converter</h1>
            <p>
            <form method="POST" enctype="multipart/form-data" action="video_upload.php" class="form-inline">
                 <div class="form-group">
                    <input type="file" class="form-control" name="uploadvideo" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Upload Video" name="uploadButton"/>
                </div>
            </form>
            </p>
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-lg-12">
                <h3 class="page-header">Related Video</h3>
            </div>

            

            <?php
                if ($handle = opendir('test_uploads/converted/')) {
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != ". " && $entry != "..") {
                            $pieces = explode('.', $entry);
                            $name = $pieces['0'];
                            //echo "$entry\n";
                            echo '<div class="col-sm-3 col-xs-6">
                                    <a href="video_upload.php?video='.$entry.'">
                                        <img class="img-responsive portfolio-item" src="test_uploads/snaps/thumb2_'.$name.'.jpg" alt="">
                                    </a>
                                </div>';
                        }
                    }
                    closedir($handle);
                }
            ?>

        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
