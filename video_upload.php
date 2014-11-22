<?php
ob_start();
require_once 'settings.php';

if (isset($_GET['video'])) {
	$webpath = 'test_uploads/converted/'.$_GET['video'];
}

if (isset($_FILES["uploadvideo"])) {
	$fileTmpLoc = $_FILES["uploadvideo"]["tmp_name"]; // File in the PHP tmp folder
	$fileType = $_FILES["uploadvideo"]["type"]; // The type of file it is
	$fileSize = $_FILES["uploadvideo"]["size"]; // File size in bytes
	$fileErrorMsg = $_FILES["uploadvideo"]["error"]; // 0 for false... and 1 for true
	$temp = explode(".", $_FILES["uploadvideo"]["name"]);
	$extension = end($temp);
	$name = md5(time());
	$fileName = $name.".".$extension; // The file name

	if(move_uploaded_file($fileTmpLoc, "test_uploads/".$fileName)){
		echo "$fileName upload is complete";
		//thumbnail from video

		$video = $dir_root.'test_uploads/'.$fileName;
		$converted_video = $dir_root.'test_uploads/converted/'.$name.$format;
		$thumb = $dir_root.'test_uploads/snaps/thumb_'.$name.'.jpg';
		$thumb2= $dir_root.'test_uploads/snaps/thumb2_'.$name.'.jpg';
		$interval = '00:00:03 -t 00:00:01 -r 1 -y';
		$webpath = 'video_upload.php?video='.$name.$format;

		//making 300 thumb
		$cmd2 = "$ffmpeg -i $video -an -ss $interval -s $size2 $thumb2";
		shell_exec($cmd2);

		//encode video
		$cmd3 = "$ffmpeg -i $video $converted_video";
		$result = exec($cmd3);

		//echo $result;
		//echo "<pre>", print_r($_FILES['uploadvideo']),"</pre>";
        header("Location: {$webpath}");
        exit();
	}else {
		echo "move_uploaded_file function failed";
	}
}
?>
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

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Video</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row text-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            	<video src="<?php echo $webpath;?>" controls>
	                your browser does not support video
	            </video>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
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
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>