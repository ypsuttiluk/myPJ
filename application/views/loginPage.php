<html>
    <head>
        <meta charset="UTF-8">
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

        <style>
            body, html{
                background: #222222;
                font-family: 'Lato', sans-serif;
            }

        </style>
    </head>

    <body>

        <div id ='wrapper'>
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/MainController">WEB-EXAMINATION DEMO</a>
                </div>

            </nav>
            <!-- /.navbar-collapse -->


            <!-- /.container-fluid -->


            <?php echo form_open('index.php/MainController/chkLogin'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Please Sign In</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="username" id="name" placeholder="Username" autofocus required/>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required/>
                                        </div>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" value=" Login " name="submit"/>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- jQuery -->
            <script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>
            <!-- Custom Theme JavaScript -->
            <script src="<?php echo base_url(); ?>asset/dist/js/sb-admin-2.js"></script>
        </div>
    </body>
</html>
