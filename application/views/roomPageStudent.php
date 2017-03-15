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
        $studentID = $this->session->userdata['logged_in']['studentID'];
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
<br>
<div class="container">
    <?php
    $string = $rs[0]['questionKey'];
    $quesID = explode(',', $string);
    print_r($quesID);
    die();
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?php echo base_url(); ?>asset/image/pencil2.jpg" alt="First slide">
                            <div class="carousel-caption">
                                <h3>
                                    First slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>asset/image/pencil2.jpg" alt="Second slide">
                            <div class="carousel-caption">
                                <h3>
                                    Second slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>asset/image/pencil2.jpg" alt="Third slide">
                            <div class="carousel-caption">
                                <h3>
                                    Third slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control"href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>



                <!-- /.container-fluid -->

                <!-- /#page-wrapper -->
            </div>
        </div>
    </div>

</div>