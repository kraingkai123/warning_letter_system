<?php
include("../include/header.php");
?>
<script src="../assets/file-upload/js/dropzone.js"></script>
<link href="../assets/file-upload/css/dropzone.css" rel="stylesheet" />

<?php
if ($_GET['LETTER_ID'] != "") {
    $dataLetter = Letter::getDataLetter($_GET['LETTER_ID']);
    $dataFrmTarget = Letter::getDataTarget($_GET['LETTER_ID']);
    $dataFrmWiness = Letter::getDataWiness($_GET['LETTER_ID']);
    $dataFile = FileAttach::listFile($_GET['LETTER_ID']);
    $dataletterRule = Rule::getruleLetter($_GET['LETTER_ID']);
    $target = $dataFrmTarget[0]['usr_id'];
}


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
                            <form method="POST" name="MainFrm" id="MainFrm" action="../save/LetterProc.php" enctype="multipart/form-data">
                                <input type="hidden" name="TEMP_FILE" id="TEMP_FILE" value="<?php echo date("Ymdhis") . $_SESSION['usr_id']; ?>">
                                <input type="hidden" name="PROC" id="PROC" value="<?php echo $_GET['LETTER_ID'] == "" ? 'add' : "edit"; ?>">
                                <input type="hidden" name="LETTER_ID" id="LETTER_ID" value="<?php echo $_GET['LETTER_ID']; ?>">
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark col-form-label-lg">ประเภทคำร้อง <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <select name="letter_type" id="letter_type" class="form-control selectbox" placeholder="โปรดเลือก" onchange="getDataLetterType(this.value)">
                                            <option value="">โปรดเลือก</option>
                                            <?php
                                            $responseType = LetterType::listLetterTypeActive();
                                            foreach ($responseType as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['lt_id']; ?>" <?php echo $dataLetter['letter_type'] == $value["lt_id"] ? "selected" : ""; ?>>
                                                    <?php echo $value['letter_type_name']; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <label for="letter_date" class="col-sm-1 col-form-label text-dark">วันที่เอกสาร</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" id="letter_date" name="letter_date" value="<?php echo $dataLetter['letter_date_do'] == "" ? date('Y-m-d')  : $dataLetter['letter_date']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark col-form-label-lg">เขียนที่ <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="letter_write_address" placeholder="เขียนที่" id="letter_write_address" value="<?php echo $dataLetter['letter_write_address'] == ""  ? "บริษัท เรียนจบนะ จำกัด" : $dataLetter['letter_write_address']; ?>">
                                    </div>
                                    <label for="letter_date" class="col-sm-1 col-form-label text-dark">วันที่กระทำผิด<span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" id="letter_date_do" name="letter_date_do" value="<?php echo $dataLetter['letter_date_do'] == "" ? "" : $dataLetter['letter_date_do']; ?>" onchange="getDateTemplate()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                    </div>
                                    <label for="letter_date" class="col-sm-1 col-form-label text-dark">เวลากระทำผิด<span class="text-danger">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="time" class="form-control" id="letter_time" name="letter_time" value="<?php echo $dataLetter['letter_time']; ?>" onchange="getDateTemplate()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">เรื่อง <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="letter_name" rows="3" name="letter_name"><?php echo $dataLetter['letter_name']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">ผู้กระทำความผิด <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <select name="letter_target[]" id="letter_target" class="form-control selectbox" onchange="getManager(this.value)">
                                            <option value="">โปรดเลือก</option>
                                            <?php
                                            $responseProfile = User::getUserAll($_SESSION['dep_id'], 0,'Y');
                                            foreach ($responseProfile as $key => $value) {
                                                $select = "";
                                                foreach ($dataFrmTarget as $key2 => $value2) {
                                                    if ($value2['usr_id'] == $value['usr_id']) {
                                                        $select = "selected";
                                                    }
                                                }
                                            ?>
                                                <option <?php echo $select; ?> value="<?php echo $value['usr_id']; ?>"><?php echo "รหัสพนักงาน : " . $value['usr_username'] . "  " . $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">รายละเอียด (1) <span class="text-danger">*</span></label>
                                    <div class="col-sm-11">

                                        <textarea class="form-control" name="type_detail_1" id="type_detail_1"><?php echo $dataLetter['type_detail_1']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">รายละเอียด <span class="text-danger">*</span></label>
                                    <div class="col-sm-11">
                                        <div id="editor"></div>
                                        <textarea name="letter_detail" id="letter_detail" style="display: none;"><?php echo $dataLetter['letter_detail']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">ข้อบังคับ <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <select name="rule_id[]" id="rule_id" class="form-control selectbox" multiple>
                                            <?php
                                            $responseRule = Rule::ListRule('Y');
                                            foreach ($responseRule as $key => $value) {
                                                $select = "";
                                                foreach ($dataletterRule as $key2 => $value2) {
                                                    if ($value2['rule_id'] == $value['rule_id']) {
                                                        $select = "selected";
                                                    }
                                                }
                                            ?>
                                                <option <?php echo $select; ?> value="<?php echo $value['rule_id']; ?>"><?php echo $value['rule_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">รายละเอียด (3) <span class="text-danger">*</span></label>
                                    <div class="col-sm-11">

                                        <textarea name="type_detail_3" id="type_detail_3" class="form-control"><?php echo $dataLetter['type_detail_3']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">รายละเอียด (2) <span class="text-danger">*</span></label>
                                    <div class="col-sm-11">

                                        <textarea name="type_detail_2" id="type_detail_2" class="form-control"><?php echo $dataLetter['type_detail_2']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">เอกสารแนบ</label>
                                    <div class="col-sm-6">
                                        <div id="file-dropzone" class="dropzone"></div>
                                    </div>
                                    <div class="col-sm-5">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <tr>
                                                <th>
                                                    <div align="center">ลำดับ</div>
                                                </th>
                                                <th>
                                                    <div align="center">เอกสารแนบ</div>
                                                </th>
                                                <th>
                                                    <div align="center">จัดการ</div>
                                                </th>
                                            </tr>
                                            <?php
                                            $indexFile = 1;
                                            foreach ($dataFile as $key => $value) {
                                            ?>
                                                <tr id="tr_<?php echo $value['file_id']; ?>">
                                                    <td align="center"><?php echo $indexFile; ?></td>
                                                    <td><a href="<?php echo $value['full_url']; ?>" target="_blank" download="<?php echo $value['file_name']; ?>"><?php echo $value['file_name']; ?></a></td>
                                                    <td align="center"><button type="button" class="btn btn-danger btn-mini" onclick="DeleteFile('<?php echo $value['file_id']; ?>')"><i class="nc-icon nc-simple-remove"></i>ลบ</button></td>
                                                </tr>
                                            <?php
                                                $indexFile++;
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">พยาน <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <select name="witness[]" id="witness" class="form-control selectbox" multiple>
                                            <?php
                                            $responseProfile = User::getUserAll($_SESSION['dep_id'], 1,'Y');
                                            foreach ($responseProfile as $key => $value) {
                                                $select = "";
                                                foreach ($dataFrmWiness as $key2 => $value2) {
                                                    if ($value2['usr_id'] == $value['usr_id']) {
                                                        $select = "selected";
                                                    }
                                                }
                                            ?>
                                                <option <?php echo $select; ?> value="<?php echo $value['usr_id']; ?>"><?php echo $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">ลงชื่อผู้จัดการ </label>
                                    <div class="col-sm-2">
                                        <a href="#!" class="btn btn-primary"
                                            onclick="window.open('letter_sign.php?ID=xxxx','sign','width=1000,height=600');"> <i class="icofont icofont-edit-alt"></i> เซ็นชื่อ</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <img id="view_pic" style="width: 500px;" />
                                    </div>
                                    <textarea id="img_create" name="img_create" rows="4" cols="50" readonly style="display: none;"><?php echo $dataLetter['img_create']; ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">ผู้บังคับบัญชา <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <select name="manager_id" id="manager_id" class="form-control selectbox">
                                            <option value="">โปรดเลือก</option>
                                            <?php
                                             $depId = db_getData("SELECT dep_id FROM VIEW_USER WHERE USR_ID='".$target."'",'dep_id');
                                            $responseProfile = User::getManager($target);

                                
                                            foreach ($responseProfile as $key => $value) {
                                                $select = "";
                                                if ($dataLetter['manager_id'] == $value['usr_id']) {
                                                    $select = "selected";
                                                }
                                            ?>
                                                <option <?php echo $select; ?> value="<?php echo $value['usr_id']; ?>"><?php echo $value['fullname']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">

                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <center> <button type="submit" class="btn btn-success">บันทึก</button></center>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <?php include("../include/footer.php"); ?>
    </div>
    </form>
</body>
<style>
    #editor {
        height: 300px;
    }
</style>

</html>
<script>
    $(document).ready(function() {
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.root.innerHTML = $("#letter_detail").val();
      
    });

    function saveData() {

        var invalidate = true;
        if ($('#letter_type').val() == "") {
            Swal.fire({
                title: "กรุณาเลือกประเภทคำร้อง",
                icon: "error"
            });
            invalidate = false;
        }
        if ($('#letter_date_do').val() == "") {
            Swal.fire({
                title: "กรุณากรอกวันที่กระทำผิด",
                icon: "error"
            });
            invalidate = false;
        }
        if ($('#letter_time').val() == "") {
            Swal.fire({
                title: "กรุณากรอกเวลาที่กระทำผิด",
                icon: "error"
            });
            invalidate = false;
        }
        if ($("#letter_write_address").val() == "") {
            Swal.fire({
                title: "กรุณากรอกสถานที่เขียน",
                icon: "error"
            });
            invalidate = false;
        }
        if ($("#letter_name").val() == "") {
            Swal.fire({
                title: "กรุณากรอกเรื่อง",
                icon: "error"
            });
            invalidate = false;
        }
        if ($("#letter_target").val() == "") {
            Swal.fire({
                title: "กรุณาเลือกผู้กระทำความผิด",
                icon: "error"
            });
            invalidate = false;
        }
        if ($("#rule_id").val() == "") {
            Swal.fire({
                title: "กรุณาเลือกข้อบังคับ",
                icon: "error"
            });
            invalidate = false;
        }
        if ($("#witness").val() == "") {
            Swal.fire({
                title: "กรุณาเลือกพยาน",
                icon: "error"
            });
            invalidate = false;
        } else {
           
            var check = $("#witness").val().length;
            if (check < 2) {
                Swal.fire({
                title: "กรุณาเลือกพยานอย่างน้อย 2 คน",
                icon: "error"
            });
            invalidate = false;
            }
        }
        if ($("#img_create").val() == "") {
            Swal.fire({
                title: "กรุณาเซ็นลายเซ็นผู้จัดการ",
                icon: "error"
            });
            invalidate = false;
        }

        if (invalidate == true) {
            var quill = new Quill('#editor', {
                theme: 'snow'
            });
            var delta = quill.getContents(); // Delta format (JSON-like)
            var html = quill.root.innerHTML;
            $('#letter_detail').val(html);
            $.ajax({
                type: "POST",
                url: '../save/LetterProc.php',
                data: $("#MainFrm").serialize(),
                //async: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    showLoadingPage()
                },
                success: function(response) {
                    if (response.status == 200) {
                        swal.close();
                        window.location.href = response.url;
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด Error 500",
                            text: "",
                            icon: "error"
                        });
                    }
                }
            });
        }

    }
    $('.selectbox').select2({
        placeholder: '',
    })
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function DeleteFile(fileId) {
        Swal.fire({
            title: "ต้องการลบเอกสารแนบใช่หรือไม่",
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
                        PROC: 'deleteFile',
                        fileId: fileId
                    }, // serializes the form's elements.
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            $('#tr_' + fileId).hide();
                        }
                    }
                });

            }
        });
    }

    function getDataLetterType(letterType) {
        $.ajax({
            type: "POST",
            url: "../save/setup_letter_type_proc.php",
            data: {
                proc: 'getData',
                lt_id: letterType,
            }, // serializes the form's elements.
            dataType: "json",
            success: function(response) {
                $("#type_detail_1").val(response.data.detail_1)
                $("#type_detail_3").val(response.data.detail_3)
                $("#type_detail_2").val(response.data.detail_2)
                $('#letter_name').val(response.data.letter_type_name)
            }
        });
    }

    function getDateTemplate() {
        var letterType = $("#letter_type").val()
        var date = $("#letter_date_do").val()
        var letter_time = $("#letter_time").val()
        $.ajax({
            type: "POST",
            url: "../save/setup_letter_type_proc.php",
            data: {
                proc: 'getDataTemplate',
                lt_id: letterType,
                date: date,
                letter_time: letter_time
            }, // serializes the form's elements.
            dataType: "json",
            success: function(response) {
                $("#type_detail_1").val(response.data.detail_1)
            }
        });
    }
    function getManager(usrId){
        $("#manager_id").empty()
        $.ajax({
            type: "POST",
            url: "../save/SaveUser.php",
            data: {
                proc: 'getManager',
                usrId: usrId,
            }, // serializes the form's elements.
            dataType: "json",
            success: function(response) {
                
                $.each(response.data, function(index, item) {
                    $("#manager_id").append("<option value='"+item.usr_id+"'>"+item.fullname+"</option>")
    });
            }
        });
    }
</script>
<script src="../assets/js/dorpZone.js"></script>