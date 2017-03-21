
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
        <link href="<?php echo base_url(); ?>asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>asset/dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>asset/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- DataTables CSS -->
        <link href="<?php echo base_url(); ?>asset/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="<?php echo base_url(); ?>asset/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
        <!-- Bootstrap select -->
        <link href="<?php echo base_url(); ?>asset/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

        <style>
            body, html{
                background: #222222;
                font-family: 'Lato', sans-serif;
            }

        </style>

    </head>

    <body>

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
        } else {

            redirect('index.php/MainController/login', 'refresh');
            exit();
        }
        ?>
        <div id ="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/MainController">WEB-EXAMINATION DEMO</a>
                </div>
                <!-- /.navbar-header -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="nav navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-top-links navbar-right">

                        <?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>
                            <!--<li>
                                <a href="<?php //echo base_url();        ?>index.php/MainController/roomDetail/<?php //echo $userKey;        ?>">ห้องเรียน</a>
                            </li> -->
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/MainController/roomDetail/<?php echo $userKey; ?>/<?php echo $userType; ?>">ห้องเรียน</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/MainController/manageChapter/<?php echo $userKey; ?>">บทเรียน</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/MainController/manageExam/<?php echo $userKey; ?>">แบบทดสอบ</a>
                            </li>
                        <?php } ?>
                        <?php if (isset($this->session->userdata['logged_in']) && $userType == 's') { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/MainController/roomDetail/<?php echo $userKey; ?>/<?php echo $userType; ?>">ห้องเรียน</a>
                            </li>
                        <?php } ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="<?php echo base_url(); ?>index.php/MainController"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
                                <li><a href="<?php echo base_url(); ?>index.php/MainController"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>index.php/MainController/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>

                    </ul>
                </div>
            </nav>

            <!-- /.navbar-collapse -->


            <!-- /.container-fluid -->


