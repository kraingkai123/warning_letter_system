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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="AddData('add')">
                                <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูล
                            </button>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="60%">หัวข้อกระทำผิด</th>
                                        <th class="text-center" width="10%">สถานะ</th>
                                        <th class="text-center" width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = MisTake::ListMistake();
                                    $i = 1;
                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td><?php echo $value['mistake_name']; ?></td>
                                            <td align="center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="mistake_status<?php echo $value['mistake_id']; ?>" <?php echo $value['mistake_status'] == 1 ? "checked" : ""; ?> onclick="UpdateStatus('<?php echo $value['mistake_id']; ?>','<?php echo $value['mistake_status']; ?>')">
                                                    <label class="custom-control-label" for="mistake_status<?php echo $value['mistake_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btnEdit<?php echo $value['mistake_id']; ?>" onclick="EditData('edit','<?php echo $value['mistake_id']; ?>')" data-name="<?php echo $value['mistake_name']; ?>" data-mistake_status="<?php echo $value['mistake_status']; ?>"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</button>
                                                <?php
                                                $count = db_getData("SELECT COUNT(1) as C FROM m_letter WHERE mistake_id='" . $value['mistake_id'] . "'", "C");
                                                if ($count == 0) {
                                                ?>
                                                    <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['mistake_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>
                                                <?php
                                                }
                                                ?>


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

        function UpdateStatus(mistake_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/mistakeProc.php",
                data: {
                    mistake_id: mistake_id,
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
                        location.reload()
                    }
                }
            });
        }

        function SaveData() {
            var proc = $("#proc").val();
            var mistake_id = $("#mistake_id").val()
            if (proc == 'add') {
                if ($("#mistake_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกการกระทำผิด",
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
                            $.ajax({
                                type: "POST",
                                url: "../save/mistakeProc.php",
                                data: {
                                    mistake_name: $('#mistake_name').val(),
                                    proc: proc,
                                }, // serializes the form's elements.
                                dataType: "json",
                                success: function(response) {
                                    if (response.Status == false) {
                                        Swal.fire({
                                            title: response.Message,
                                            icon: "error"
                                        });
                                    } else {
                                        location.reload();
                                    }
                                }
                            });
                        }
                    });
                }
            } else if (proc == 'edit') {

                if ($("#mistake_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกหัวข้อกระทผิด",
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
                            $.ajax({
                                type: "POST",
                                url: "../save/mistakeProc.php",
                                data: {
                                    mistake_name: $('#mistake_name').val(),
                                    proc: proc,
                                    mistake_id: mistake_id
                                }, // serializes the form's elements.
                                dataType: "json",
                                success: function(response) {
                                    if (response.Status == false) {
                                        Swal.fire({
                                            title: response.Message,
                                            icon: "error"
                                        });
                                    } else {
                                        location.reload();
                                    }
                                }
                            });
                        }
                    });
                }
            }

        }

        function AddData(proc) {
            $("#proc").val(proc)
            $(".form-control").each(function(index) {
                $(this).val("")
            });

        }

        function EditData(proc, mistake_id) {
            $("#proc").val(proc)
            $("#mistake_id").val(mistake_id)
            var mistake_name = $("#btnEdit" + mistake_id).data('name');
            var mistake_status = $("#btnEdit" + mistake_id).data('mistake_status');
            $('#mistake_name').val(mistake_name);
             if (mistake_status == 'Y') {
                $('#mistake_status').prop('checked', true)
            }else{
                 $('#mistake_status').prop('checked', false)
            }
        }

        function DeleteData(proc, mistake_id) {
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
                        url: "../save/mistakeProc.php",
                        data: {
                            proc: proc,
                            mistake_id: mistake_id
                        }, // serializes the form's elements.
                        dataType: "json",
                        success: function(response) {
                            if (response.Status == false) {
                                Swal.fire({
                                    title: response.Message,
                                    icon: "error"
                                });
                            } else {
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php
                                                                if (empty($_GET['menu_id'])) {
                                                                    $_GET['menu_id'] = 0;
                                                                }
                                                                echo $_SESSION['menu'][$_GET['menu_id']]['menu_name']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id='mistake_id' name="mistake_id">
                <input type="hidden" id='proc' name="proc">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">รายละเอียด<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mistake_name" name="mistake_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="SaveData()">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>