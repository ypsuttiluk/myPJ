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
<?php if (isset($this->session->userdata['logged_in']) && $userType == 's') { ?>
    <?php //echo form_open("index.php/MainController/editExam/" . $examKey);                                                  ?>
    <!-- Page Content -->
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-right" style="cursor: pointer">
                                <span onclick="goBack()"><i class="glyphicon glyphicon-circle-arrow-left fa-fw"></i>กลับ</span>

                            </div>


                            <i class="fa fa-file-text fa-fw"></i> รายชื่อห้องเรียน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php foreach ($rs as $r) { ?>
                                    
                                        <!--<a href="<?php //echo base_url();  ?>index.php/RoomController/joinToRoom/<?php //echo $r['rKey'];  ?>/<?php //echo $userKey;  ?>" class="list-group-item">-->
                                        <button class="list-group-item" id='test' onclick="checkStatus(<?php echo $r['rStatus'].','.$r['rKey'].','.$userKey;?>)">    
                                            <i class="glyphicon glyphicon-blackboard fa-fw"></i> <?php echo $r['rName']; ?>
                                            <?php if ($r['rStatus'] == 0) { ?>
                                                <span class="pull-right text-muted small"><em>Offline</em></span>
                                            <?php } else { ?>
                                                <span class="pull-right text-muted small"><em>Online</em></span>
                                            <?php } ?>
                                            <!--</a>-->
                                        </button>
                                
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
        </div>
    </div>
    <?php //echo form_close(); ?>
<?php } ?>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
<script>
    function checkStatus(status,rKey,userKey){
   
        if(status == 0){
          alert('ขออภัย ห้องเรียนอยู่ในสถานะไม่พร้อมใช้งาน');
        }else{
             window.location = "<?php echo base_url(); ?>index.php/RoomController/joinToRoom/"+rKey+"/"+userKey;
        }
    }
    
      
   
</script>