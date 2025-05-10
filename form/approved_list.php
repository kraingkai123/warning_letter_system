<?php
include("../include/header.php");
?>

<body class="">
    <div class="wrapper ">
        <?php include("../include/sidebar.php");
        include("../include/navbar.php");
        ?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body ">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="10%">เลขคำร้อง</th>
                                        <th class="text-center" width="30%">เรื่อง</th>
                                        <th class="text-center" width="20%">ผู้กระทำความผิด</th>
                                        <th class="text-center" width="20%">วันที่</th>
                                        <th class="text-center" width="20%">สถานะ</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = Letter::ListLetterHr();
                                    $i = 1;

                                    foreach ($ressponse as $key => $value) {
                                        $color="";
                                        if ($value['letter_status'] == 1) {
                                           $color="#F7CAAC";
                                        } else if ($value['letter_status'] == 5) {
                                            $color="#F7CAAC";
                                        } else if ($value['letter_status'] == 3) {
                                            $color="#FFAFAF";
                                        } else if ($value['letter_status'] == 2) {
                                            $color="#B3C6E7";
                                        } else if ($value['letter_status'] == 4) {
                                            $color="#C4E0B2";
                                        } else if ($value['letter_status'] == 6) {
                                            $color="#FFAFAF";
                                        }
                                    ?>
                                        <tr style="background-color:<?php echo $color;?>">
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="center">
                                                <?php echo $value['letter_number']; ?>
                                            </td>
                                            <td><?php echo $value['letter_name']; ?></td>
                                            <td><?php echo $value['letter_target']; ?></td>
                                            <td><?php echo db2Date($value['letter_date']); ?></td>
                                            <td><?php
                                                if ($value['letter_status'] == 1) {
                                                    $textStatus = "รอตรวจสอบ";
                                                } else if ($value['letter_status'] == 5) {
                                                    $textStatus = "ส่งกลับแก้ไข";
                                                } else if ($value['letter_status'] == 3) {
                                                    $textStatus = "ยกเลิก";
                                                } else if ($value['letter_status'] == 2) {
                                                    $textStatus = "อนุมัติ";
                                                } else if ($value['letter_status'] == 4) {
                                                    $textStatus = "ดำเนินการเสร็จสิ้น";
                                                } else if ($value['letter_status'] == 6) {
                                                    $textStatus = "พนักงานไม่ยินยอมรับทราบ";
                                                }
                                                echo $textStatus;
                                                ?></td>
                                            <td>
                                                <?php
                                                $proc = "view";
                                                if ($value['letter_status'] == 1) {
                                                    $proc = "Approve";
                                                } ?>
                                                <a class="btn btn-primary" href="../view/LetterDetail.php?LETTER_ID=<?php echo $value['letter_id']; ?>&proc=<?php echo $proc; ?>" role="button"><i class="nc-icon nc-email-85"></i> รายละเอียด</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include("../include/footer.php"); ?>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            /*   $("#example").DataTable({}); */
            LoadDatatable('example');
        });

        function UpdateStatus(usr_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/SaveUser.php",
                data: {
                    usr_id: usr_id,
                    status: status,
                    proc: 'updateStatus'
                }, // serializes the form's elements.
                dataType: "json",
                success: function(response) {
                    if (response.Status == false) {
                        Swal.fire({
                            title: response.Message,
                            icon: "error"
                        });
                    } else {
                        Swal.fire({
                            title: response.Message,
                            icon: "success"
                        });
                    }
                }
            });
        }


        function SaveData() {
            var proc = $("#proc").val();
            var pos_id = $("#usr_id").val()
            if (proc == 'add') {
                if ($("#pos_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกชื่อตำแหน่ง",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "คุณต้องการบันทึกข้อมูลใช่หรือไม่",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ปิด",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $("#frmUser");
                            var actionUrl = form.attr('action');
                            const formData = new FormData($("#frmUser")[0]);
                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                // data: form.serialize(), // serializes the form's elements.
                                data: formData, // serializes the form's elements.
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    Swal.showLoading();
                                },
                                success: function(response) {
                                    swal.close();
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            } else if (proc == 'edit') {

                if ($("#pos_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกชื่อตำแหน่ง",
                        icon: "error"
                    });
                } else {
                    var is_manager = $('#btnEdit' + pos_id).data('is_manager');

                    if (is_manager != 'Y') {
                        is_manager = 'Y';
                    } else {
                        is_manager = 'N';
                    }
                    Swal.fire({
                        title: "คุณต้องการบันทึกข้อมูลใช่หรือไม่",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ปิด",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $("#frmUser");
                            var actionUrl = form.attr('action');
                            const formData = new FormData($("#frmUser")[0]);
                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                // data: form.serialize(), // serializes the form's elements.
                                data: formData, // serializes the form's elements.
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    Swal.showLoading();
                                },
                                success: function(response) {
                                    swal.close();
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            }

        }

        function AddData(proc) {
            $("#proc").val(proc)
            $.ajax({
                type: "POST",
                url: "../view/show_frm_user.php",
                data: {
                    proc: proc,
                }, // serializes the form's elements.
                dataType: "html",
                success: function(response) {
                    $('#modal_content').html(response)
                }
            });
        }

        function EditData(proc, usr_id) {
            $.ajax({
                type: "POST",
                url: "../view/show_frm_user.php",
                data: {
                    proc: proc,
                    usr_id: usr_id
                }, // serializes the form's elements.
                //dataType: "html",
                success: function(response) {
                    $('#modal_content').html(response)
                    $("#proc").val(proc)
                    $("#usr_id").val(usr_id)
                }
            });



        }

        function DeleteData(proc, letterId) {
            Swal.fire({
                title: "ต้องการลบใช่หรือไม่",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ปิด",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../save/LetterProc.php",
                        data: {
                            PROC: proc,
                            LETTER_ID: letterId
                        }, // serializes the form's elements.
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                location.reload();
                            }
                        }
                    });

                }
            });

        }
    </script>
</body>

</html>