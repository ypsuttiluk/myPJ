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
    $numOfQues = count($rs);
    for ($i = 0; $i < count($rs); $i++) {
        $sql = 'select * from answerdim where quesKey = ' . $rs[$i];
        $ans[] = $this->ExamModel->getData($sql);
        $sql1 = 'select quesText from questiondim where quesKey = ' . $rs[$i];
        $ques[] = $this->ExamModel->getData($sql1);
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?php echo base_url(); ?>asset/image/pencil2.jpg" alt="First slide">
                            <div class="carousel-caption">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <?php echo $ques[0][0]['quesText']; ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <?php if (count($ans[0]) == 4) { ?>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">#1</span>
                                                    <input type="text" class="form-control" value="<?php echo $ans[0][0]['ansText']; ?>" readonly>
                                                    <span class="input-group-addon fa-fw">กด</span>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">#2</span>
                                                    <input type="text" class="form-control" value="<?php echo $ans[0][1]['ansText']; ?>" readonly>
                                                    <span class="input-group-addon fa-fw">กด</span>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">#3</span>
                                                    <input type="text" class="form-control" value="<?php echo $ans[0][2]['ansText']; ?>" readonly>
                                                    <span class="input-group-addon fa-fw">กด</span>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">#4</span>
                                                    <input type="text" class="form-control" value="<?php echo $ans[0][3]['ansText']; ?>" readonly>
                                                    <span class="input-group-addon fa-fw">กด</span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6 col-sm-6">
                                                    <button type="button" class="btn btn-block" disabled style="background:#98FB98; border:2px solid #7CC667">TRUE</button>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <button type="button" class="btn btn-block" disabled style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php for ($i = 1; $i < $numOfQues; $i++) { ?>
                            <div class="item">
                                <img src="<?php echo base_url(); ?>asset/image/pencil2.jpg" alt="First slide">
                                <div class="carousel-caption">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <?php echo $ques[$i][0]['quesText']; ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php if (count($ans[$i]) == 4) { ?>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">#1</span>
                                                        <input type="text" class="form-control" value="<?php echo $ans[$i][0]['ansText']; ?>" readonly>
                                                        <span class="input-group-addon fa-fw">กด</span>
                                                    </div>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">#2</span>
                                                        <input type="text" class="form-control" value="<?php echo $ans[$i][1]['ansText']; ?>" readonly>
                                                        <span class="input-group-addon fa-fw">กด</span>
                                                    </div>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">#3</span>
                                                        <input type="text" class="form-control" value="<?php echo $ans[$i][2]['ansText']; ?>" readonly>
                                                        <span class="input-group-addon fa-fw">กด</span>
                                                    </div>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">#4</span>
                                                        <input type="text" class="form-control" value="<?php echo $ans[$i][3]['ansText']; ?>" readonly>
                                                        <span class="input-group-addon fa-fw">กด</span>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-6 col-sm-6">
                                                        <button type="button" class="btn btn-block" disabled style="background:#98FB98; border:2px solid #7CC667">TRUE</button>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <button type="button" class="btn btn-block" disabled style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>



            <!-- /.container-fluid -->

            <!-- /#page-wrapper -->
        </div>
    </div>
</div>

</div>