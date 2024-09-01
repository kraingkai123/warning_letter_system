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
                                        <th class="text-center" width="50%">ตำแหน่ง</th>
                                        <th class="text-center" width="10%">ผู้บริหาร</th>
                                        <th class="text-center" width="10%">สถานะ</th>
                                        <th class="text-center" width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = Position::ListPostion();
                                    $i = 1;
                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td><?php echo $value['pos_name']; ?></td>
                                            <td align="center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="is_manager<?php echo $value['pos_id']; ?>" <?php echo $value['is_manager'] == 'Y' ? "checked" : ""; ?> onclick="UpdateStatusIsManager('<?php echo $value['pos_id']; ?>','<?php echo $value['is_manager']; ?>')">
                                                    <label class="custom-control-label" for="is_manager<?php echo $value['pos_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="pos_status<?php echo $value['pos_id']; ?>" <?php echo $value['pos_status'] == 1 ? "checked" : ""; ?> onclick="UpdateStatus('<?php echo $value['pos_id']; ?>','<?php echo $value['pos_status']; ?>')">
                                                    <label class="custom-control-label" for="pos_status<?php echo $value['pos_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btnEdit<?php echo $value['pos_id']; ?>" onclick="EditData('edit','<?php echo $value['pos_id']; ?>')" data-name="<?php echo $value['pos_name']; ?>" data-is_manager="<?php echo $value['is_manager']; ?>"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['pos_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>
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

        function UpdateStatus(pos_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/setup_position_proc.php",
                data: {
                    pos_id: pos_id,
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

        function UpdateStatusIsManager(pos_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/setup_position_proc.php",
                data: {
                    pos_id: pos_id,
                    status: status,
                    proc: 'updateStatusManager'
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
            var pos_id = $("#pos_id").val()
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
                            $.ajax({
                                type: "POST",
                                url: "../save/setup_position_proc.php",
                                data: {
                                    pos_name: $('#pos_name').val(),
                                    proc: proc
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

                if ($("#pos_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกชื่อตำแหน่ง",
                        icon: "error"
                    });
                } else {
                    var is_manager = $('#btnEdit' + pos_id).data('is_manager');

                    if (is_manager != 'Y') {
                       is_manager='Y';
                    }else{
                        is_manager='N';
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
                            $.ajax({
                                type: "POST",
                                url: "../save/setup_position_proc.php",
                                data: {
                                    pos_name: $('#pos_name').val(),
                                    proc: proc,
                                    pos_id: pos_id,
                                    is_manager: is_manager
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
        }

        function EditData(proc, pos_id) {
            $("#proc").val(proc)
            $("#pos_id").val(pos_id)
            var pos_name = $("#btnEdit" + pos_id).data('name');
            $('#pos_name').val(pos_name);
            var is_manager = $('#btnEdit' + pos_id).data('is_manager');
            $('#is_manager').prop('checked', false)
            if (is_manager == 'Y') {
                $('#is_manager').prop('checked', true)
            }
        }

        function DeleteData(proc, pos_id) {
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
                        url: "../save/setup_position_proc.php",
                        data: {
                            proc: proc,
                            pos_id: pos_id
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
                <input type="hidden" id='pos_id' name="pos_id">
                <input type="hidden" id='proc' name="proc">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pos_name" name="pos_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">ผู้บริหาร</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_manager">
                            <label class="custom-control-label" for="is_manager"></label>
                        </div>
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