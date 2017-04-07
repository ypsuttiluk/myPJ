

<style>
    .funkyradio div {
        clear: both;
        /*margin: 0 50px;*/
        overflow: hidden;
    }
    .funkyradio label {
        /*min-width: 400px;*/
        width: 100%;
        border-radius: 3px;
        border: 1px solid #D1D3D4;
        font-weight: normal;
    }
    .funkyradio input[type="radio"]:empty, .funkyradio input[type="checkbox"]:empty {
        display: none;
    }
    .funkyradio input[type="radio"]:empty ~ label, .funkyradio input[type="checkbox"]:empty ~ label {
        position: relative;
        line-height: 2.5em;
        text-indent: 3.25em;
        margin-top: 2em;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .funkyradio input[type="radio"]:empty ~ label:before, .funkyradio input[type="checkbox"]:empty ~ label:before {
        position: absolute;
        display: block;
        top: 0;
        bottom: 0;
        left: 0;
        content:'';
        width: 2.5em;
        background: #D1D3D4;
        border-radius: 3px 0 0 3px;
    }
    .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before, .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
        content:'\2714';
        text-indent: .9em;
        color: #C2C2C2;
    }
    .funkyradio input[type="radio"]:hover:not(:checked) ~ label, .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
        color: #888;
    }
    .funkyradio input[type="radio"]:checked ~ label:before, .funkyradio input[type="checkbox"]:checked ~ label:before {
        content:'\2714';
        text-indent: .9em;
        color: #333;
        background-color: #ccc;
    }
    .funkyradio input[type="radio"]:checked ~ label, .funkyradio input[type="checkbox"]:checked ~ label {
        color: #777;
    }
    .funkyradio input[type="radio"]:focus ~ label:before, .funkyradio input[type="checkbox"]:focus ~ label:before {
        box-shadow: 0 0 0 3px #999;
    }
    .funkyradio-default input[type="radio"]:checked ~ label:before, .funkyradio-default input[type="checkbox"]:checked ~ label:before {
        color: #333;
        background-color: #ccc;
    }
    .funkyradio-primary input[type="radio"]:checked ~ label:before, .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #337ab7;
    }
    .funkyradio-success input[type="radio"]:checked ~ label:before, .funkyradio-success input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #5cb85c;
    }
    .funkyradio-danger input[type="radio"]:checked ~ label:before, .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #d9534f;
    }
    .funkyradio-warning input[type="radio"]:checked ~ label:before, .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #f0ad4e;
    }
    .funkyradio-info input[type="radio"]:checked ~ label:before, .funkyradio-info input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #5bc0de;
    }
</style>
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
<button id='begin' hidden></button>
<button id='autoButtonS' data-toggle="modal" data-target="#myModal" hidden data-backdrop="static" data-keyboard="false"></button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h3 class="modal-title" id="myModalLabel">รายละเอียดการทดสอบ</h3>
            </div>
            <?php //echo form_open("index.php/RoomController/createRoom/" . $rs[0]['rKey']);  ?>
            <div class="modal-body">
                <h4>ชื่อการทดสอบ : <?php echo $room[0]['nameOfExam']; ?></h4><hr>
                <h5>ระยะเวลาในการทดสอบ : <?php echo $room[0]['time']; ?></h5><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="goBack()">กลับ</button>
                <!--<a href="<?php //echo base_url();                  ?>index.php/MainController/createChapter"></a>-->
                <button type="button" class="btn btn-primary" onclick="begin(<?php echo $room[0]['rKey'] . ',' . $userKey; ?>)">เริ่มต้นทำแบบทดสอบ</button>
            </div>
            <?php //echo form_close();  ?>
        </div>
    </div>
</div>
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
   
   function btnFinish(n) {
        if(n==0){
            r = confirm('ต้องการส่งแบบทดสอบ ?');
            if(r==true){
                $.ajax({
                    url:'<?php echo base_url();?>index.php/TempController/finishDoExam/<?php echo $userKey;?>/<?php echo $userType;?>/<?php echo $room[0]['rKey'];?>',
                    success: function(){
                        alert('ส่งแบบทดสอบแล้ว');
                        window.location = "<?php echo base_url(); ?>index.php/MainController"
                    }
                })
            }
        }
    }
   
    function doTF(n, qKey) {
        
        
        userKey = <?php echo $userKey;?>;
        rKey = <?php echo $room[0]['rKey']; ?>   
        var z = document.getElementById('btn1');
        var x = document.getElementById('btn2');

        if (n == 1) {
            z.style.background = '#98FB98';
            x.style.background = '#E4FDDD';
       
            ansKey = document.getElementById('TF1').value;
         


        } else {
            x.style.background = '#98FB98';
            z.style.background = '#E4FDDD';
  
            ansKey = document.getElementById('TF2').value;
    

        }
        $.ajax({
            type:'post',
            url: '<?php echo base_url(); ?>index.php/TempController/whileDoExam/'+qKey+'/'+userKey+'/'+ansKey+'/'+rKey,
        });


    }

    function doMC(ansKey,qKey){
        userKey = <?php echo $userKey;?>;
        rKey = <?php echo $room[0]['rKey']; ?>;
        $.ajax({
            type:'post',
            url: '<?php echo base_url(); ?>index.php/TempController/whileDoExam/'+qKey+'/'+userKey+'/'+ansKey+'/'+rKey,
        });
    }
    function begin(rKey, userKey) {
        window.location = "<?php echo base_url(); ?>index.php/RoomController/addStudentToRoom/" + rKey + "/" + userKey + "";
    }
$(document).ready(function(){
    jQuery(function () {
        <?php if (count($temp) == 0 && $result[0]['rKey'] == NULL && $result[0]['inRoom'] == 0) { ?>
            //alert('ห้องเรียนอยู่ในสถานะออฟไลน์ กรุณาตั้งค่าห้องเรียน');
            jQuery('#autoButtonS').click();
             //jQuery('#autoButton').click();
        <?php } else if (count($temp) == 0 && $result[0]['rKey'] != NULL && $result[0]['rKey'] == $room[0]['rKey'] && $result[0]['inRoom'] == 1) { ?>
            jQuery('#begin').click();
        <?php } else if ($result[0]['rKey'] != $room[0]['rKey']) { ?>
            alert('คุณอยู่ในห้องเรียนอื่นอยู่');
            window.location = '<?php echo base_url(); ?>index.php/RoomController/roomDetail/<?php echo $userKey; ?>/s';
        <?php } else if (count($temp) != 0 && $result[0]['rKey'] != NULL && $result[0]['rKey'] == $room[0]['rKey'] && $result[0]['inRoom'] == 1) { ?>
           jQuery('#begin').click();
        <?php } else if (count($temp) != 0 && $result[0]['rKey'] != NULL && $result[0]['rKey'] == $room[0]['rKey'] && $result[0]['inRoom'] == 0) {?>
            alert('คุณทำการทดสอบเสร็จสิ้นแล้ว กรุณารอฟังคำแนะนำจากอาจารย์ผู้สอน');
            window.location = '<?php echo base_url(); ?>index.php/RoomController/roomDetail/<?php echo $userKey; ?>/s';
        <?php }else if (count($temp) == 0 && $result[0]['rKey'] != NULL && $result[0]['rKey'] == $room[0]['rKey'] && $result[0]['inRoom'] == 0) {?>
            alert('คุณทำการทดสอบเสร็จสิ้นแล้ว กรุณารอฟังคำแนะนำจากอาจารย์ผู้สอน');
            window.location = '<?php echo base_url(); ?>index.php/RoomController/roomDetail/<?php echo $userKey; ?>/s';
        <?php }?>
    });
    });

    $('#begin').click(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/<?php echo $rs[0]; ?>/<?php echo $result[0]['rKey']; ?>/<?php echo $userKey;?>',
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
        var idArr = [<?php
            for ($i = 0; $i < $numOfQues; $i++) {
                if ($i != $numOfQues - 1) {
                    echo $rs[$i] . ',';
                } else {
                    echo $rs[$i];
                }
            }
        ?>]
        document.getElementById('test').value = b.value;
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/' + idArr[b.value] + '/<?php echo $result[0]['rKey']; ?>/<?php echo $userKey;?>',
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
        var idArr = [<?php
            for ($i = 0; $i < $numOfQues; $i++) {
                if ($i != $numOfQues - 1) {
                    echo $rs[$i] . ',';
                } else {
                    echo $rs[$i];
                }
            }
        ?>]
        document.getElementById('test').value = b.value;
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/AjaxController/testSelect/' + idArr[b.value] + '/<?php echo $result[0]['rKey']; ?>/<?php echo $userKey;?>',
            success: function (Result) {
                $('#result').html(Result);
            }
        });
    });

 

</script>