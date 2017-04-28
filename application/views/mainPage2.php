
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Website for Examination</title>

        <!-- Bootstrap Core CSS -->
        <link href="https://blackrockdigital.github.io/startbootstrap-creative/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://blackrockdigital.github.io/startbootstrap-creative/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link href="https://blackrockdigital.github.io/startbootstrap-creative/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="https://blackrockdigital.github.io/startbootstrap-creative/css/creative.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="page-top">

        <?php
        if (isset($this->session->userdata['logged_in'])) {
            if ($this->session->userdata['logged_in']['userType'] == 't') {
                $userType = $this->session->userdata['logged_in']['userType'];
                $userKey = $this->session->userdata['logged_in']['userKey'];
                $userID = $this->session->userdata['logged_in']['userID'];
                $userName = $this->session->userdata['logged_in']['userName'];
                $userPhone = $this->session->userdata['logged_in']['userPhone'];
                $userRoom = $this->session->userdata['logged_in']['userRoom'];
            }
            if ($this->session->userdata['logged_in']['userType'] == 's') {
                $userType = $this->session->userdata['logged_in']['userType'];
                $userKey = $this->session->userdata['logged_in']['userKey'];
                $userID = $this->session->userdata['logged_in']['userID'];
                $userName = $this->session->userdata['logged_in']['userName'];
                $userPhone = $this->session->userdata['logged_in']['userPhone'];
                $userYear = $this->session->userdata['logged_in']['userYear'];
                $userDegree = $this->session->userdata['logged_in']['userDegree'];
            }
            if ($this->session->userdata['logged_in']['userType'] == 'a') {
                $userType = $this->session->userdata['logged_in']['userType'];
                $userName = $this->session->userdata['logged_in']['userName'];
            }
        } else {

            redirect('index.php/MainController/login', 'refresh');
            exit();
        }
        ?>


        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">WEB-EXAMINATION</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#about">เกี่ยวกับเว็บไซต์</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">เริ่มต้นใช้งานเว็บไซต์</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="<?php echo base_url(); ?>index.php/MainController/userDetail"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
<!--                                <li><a href="<?php echo base_url(); ?>index.php/MainController/userDetail"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                </li>-->
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>index.php/MainController/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
                
                
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Website for Examination Management</h1>
                    <hr>
                    <p>เว็บไซต์เพื่อจัดการทดสอบสำหรับนักศึกษา มหาวิทยาลัยเชียงใหม่</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">เกี่ยวกับเว็บไซต์</a>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">About Website</h2>
                        <hr class="light">
                        <p class="text-faded">เว็บไซต์เพื่อจัดการสอบสำหรับนักศึกษาคณะแพทยศาสตร์ มหาวิทยาลัยเชียงใหม่
                        จัดทำขึ้นเพื่อลดความยุ่งยากและข้อจำกัดในด้านต่าง ๆ ของระบบงานเดิม ซึ่งจะช่วยให้ผู้ใช้งานรู้สึกสะดวกสบายไปกับการใช้งานเว็บไซต์ !</p>
                        <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">เริ่มต้นใช้งานเว็บไซต์ !</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">เริ่มต้นใช้งานเว็บไซต์</h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="service-box">
                                <a href="<?php echo base_url(); ?>index.php/ChapterController/manageChapter/<?php echo $userKey; ?>">
                                    <i class="fa fa-4x fa-book text-primary sr-icons"></i>
                                </a>
                                <h3>Chapter</h3>
                                <p class="text-muted">สร้างคำถามและบทเรียนของคุณ !</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="service-box">
                                <a href="<?php echo base_url(); ?>index.php/ExamController/manageExam/<?php echo $userKey; ?>">
                                    <i class="fa fa-4x fa-files-o text-primary sr-icons"></i>
                                </a>
                                <h3>Exam</h3>
                                <p class="text-muted">สร้างแบบทดสอบของคุณ !</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="service-box">
                                <a href="<?php echo base_url(); ?>index.php/MainController/resultDetail">
                                    <i class="fa fa-4x fa-file-text text-primary sr-icons"></i>
                                </a>
                                <h3>Report</h3>
                                <p class="text-muted">แสดงผลลัพธ์การทดสอบย้อนหลัง !</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="service-box">
                                <div class="service-box">
                                    <a href="<?php echo base_url(); ?>index.php/RoomController/roomDetail/<?php echo $userKey; ?>/<?php echo $userType; ?>">
                                        <i class="glyphicon fa-4x glyphicon-blackboard text-primary sr-icons"></i>
                                    </a>
                                    <h3>Room</h3>
                                    <p class="text-muted">สร้างห้องเรียนสำหรับการทดสอบ !</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($this->session->userdata['logged_in']) && $userType == 's') { ?>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="service-box">
                                <a href="<?php echo base_url(); ?>index.php/RoomController/roomDetail/<?php echo $userKey; ?>/<?php echo $userType; ?>">
                                    <i class="glyphicon fa-4x glyphicon-blackboard text-primary sr-icons"></i>
                                </a>
                                <h3>Room</h3>
                                <p class="text-muted">เข้าร่วมห้องเรียนเพื่อทำการทดสอบ !</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="https://blackrockdigital.github.io/startbootstrap-creative/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://blackrockdigital.github.io/startbootstrap-creative/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="https://blackrockdigital.github.io/startbootstrap-creative/vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="https://blackrockdigital.github.io/startbootstrap-creative/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="https://blackrockdigital.github.io/startbootstrap-creative/js/creative.min.js"></script>

    </body>

</html>
