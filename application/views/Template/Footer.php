<!-- end warper-->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>asset/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>

<!--<script src="<?php //echo base_url();                ?>asset/vendor/datatables-responsive/dataTables.responsive.js"></script>
 Custom Theme JavaScript -->
<!--<script src="<?php //echo base_url();                ?>asset/dist/js/sb-admin-2.js"></script>-->
<!-- bootstrap js select-->
<script src="<?php echo base_url(); ?>asset/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script>

    

    function allowText(index) {
        var checkbox = document.getElementById('fancy-checkbox-primary' + index);
        document.getElementById('inputText' + index).disabled = !checkbox.checked;
        if (checkbox.checked) {
            document.getElementById('inputText' + index).value = 1;
        } else {
            document.getElementById('inputText' + index).value = '';
        }
    }

    /* AJAX request to checker */
    $('#myCarousel').carousel({
        interval: false
    });
    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    function maxLengthCheck(object)
    {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)
    }
    function testMC(n) {
        var ansT1 = document.getElementById('ansT1');
        var ansT2 = document.getElementById('ansT2');
        var ansT3 = document.getElementById('ansT3');
        var ansT4 = document.getElementById('ansT4');
        var x1 = document.getElementById('C1');
        var x2 = document.getElementById('C2');
        var x3 = document.getElementById('C3');
        var x4 = document.getElementById('C4');

        if (n == 1) {
            document.getElementById('ans1').textContent = 'ถูก';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#98FB98';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ถูก';
            x2.value = 'ผิด';
            x3.value = 'ผิด';
            x4.value = 'ผิด';
        } else if (n == 2) {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ถูก';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#98FB98';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ผิด';
            x2.value = 'ถูก';
            x3.value = 'ผิด';
            x4.value = 'ผิด';
        } else if (n == 3) {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ถูก';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#98FB98';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ผิด';
            x2.value = 'ผิด';
            x3.value = 'ถูก';
            x4.value = 'ผิด';
        } else {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ถูก';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#98FB98';

            x1.value = 'ผิด';
            x2.value = 'ผิด';
            x3.value = 'ผิด';
            x4.value = 'ถูก';
        }
    }

    function goBack() {
        window.history.back();
    }

    function testTF(n) {
        var z = document.getElementById('btn1');
        var x = document.getElementById('btn2');
        var a = document.getElementById('TF1');
        var b = document.getElementById('TF2');
        if (n == 1) {
            z.style.background = '#98FB98';
            x.style.background = '#E4FDDD';
            a.value = 'ถูก';
            b.value = 'ผิด';
        } else {
            x.style.background = '#98FB98';
            z.style.background = '#E4FDDD';
            a.value = 'ผิด';
            b.value = 'ถูก';
        }

    }





// Page-Level Demo Scripts - Tables - Use for reference


</script>
</body>
</html>
