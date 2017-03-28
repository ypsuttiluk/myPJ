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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <input type='hidden' id='test' value="0">
                <div class="panel panel-success" id="result">


                    <!-- /.panel-heading -->

                    <!-- /.row -->
                </div>

                <button class="btn-success" id='pre' value="">ก่อนหน้า</button> 
                <button class="btn-primary" id="next" value="">ถัดไป</button>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/<?php echo $rs[0]; ?>',
            success: function (Result) {
                $('#result').html(Result);

            }
        });
    });
    
    $('#next').click(function (event) {
        a = document.getElementById('test').value
        b = document.getElementById('next');
        if (document.getElementById('test').value == <?php echo $numOfQues - 1; ?>) {
            b.value = <?php echo $numOfQues - 1; ?>;
        } else {
            b.value = parseInt(a) + 1;
        }
        var idArr = [
                <?php 
                for ($i = 0; $i < $numOfQues; $i++) {
                             if ($i != $numOfQues - 1) {
                                 echo $rs[$i] . ',';
                             } else {
                                 echo $rs[$i];
                             }
                 } 
                 ?>
            ]
        document.getElementById('test').value = b.value;
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/' + idArr[b.value],
            success: function (Result) {
                $('#result').html(Result);
            }
        });
    });
    
    $('#pre').click(function (event) {
        a = document.getElementById('test').value;
        b = document.getElementById('next');
        if (document.getElementById('test').value == 0) {
            b.value = 0;
        } else {
            b.value = parseInt(a) - 1;
        }
        var idArr = [
                <?php
                for ($i = 0; $i < $numOfQues; $i++) {
                    if ($i != $numOfQues - 1) {
                        echo $rs[$i] . ',';
                    } else {
                        echo $rs[$i];
                    }
                }
                ?>
            ]
        document.getElementById('test').value = b.value;
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/' + idArr[b.value],
            success: function (Result) {
                $('#result').html(Result);
            }
        });

    });
    
</script>