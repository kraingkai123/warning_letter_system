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
}
?>
<style>
    .card {

        /*  display: flex; */
        width: 100%;
        /* Full width */
        /* Full viewport height */


    }

    iframe {
        /*         display: flex; */
        align-items: center;
        /*         justify-content: center; */
        width: 100%;
        /* Full width */
        height: 100vh;
        /* Full viewport height */


    }
</style>

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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">หนังสือ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">เอกสารแนบ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#Process" type="button" role="tab" aria-controls="Process" aria-selected="false">ความคิดเห็น</button>
                                </li>
                                <?php
                                if ($_GET['proc'] != 'view') {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">การอนุมัติเอกสาร</button>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <iframe
                                                    src="viewLetter.php?LETTER_ID=<?php echo $_GET['LETTER_ID']; ?>"
                                                    width="600"
                                                    height="100%"
                                                    scrolling="auto"
                                                    style="border:none;">
                                                </iframe>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="Process" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <tr>
                                                    <th width="10%">
                                                        <div align="center">ลำดับ</div>
                                                    </th>
                                                    <th>
                                                        <div align="center">รายละเอียด</div>
                                                    </th>

                                                </tr>
                                                <?php
                                                $indexFile = 1;
                                                $listProcess = Process::ProcessList($_GET['LETTER_ID']);
                                                foreach ($listProcess as $key => $value) {
                                                ?>
                                                    <tr id="tr_<?php echo $value['bp_id']; ?>">
                                                        <td align="center"><?php echo $indexFile; ?></td>
                                                        <td>
                                                            <?php
                                                            $txtReceiveStatus = "รออนุมัติ";
                                                            $receiveName = "";
                                                            $receiveDatetime = "";
                                                            if ($value['receive_status'] != "") {
                                                                $receiveName = " ส่ง " . $value['receive_name'];
                                                                if (!empty($value['receive_date'])) {
                                                                    $receiveDatetime = "<span class='text-primary'>" . " (" . db2Date($value['receive_date']) . " " . $value['receive_time'] . ")" . "</span>";
                                                                }
                                                            }
                                                            if ($value['receive_status'] == 'N') {
                                                                $txtReceiveStatus = "ไม่อนุมัติ";
                                                            } else if ($value['receive_status'] == 'Y') {
                                                                $txtReceiveStatus = "อนุมัติ";
                                                            } else if ($value['receive_status'] == 'B') {
                                                                $txtReceiveStatus = "ส่งกลับแก้ไข";
                                                            } else   if ($value['receive_status'] == 'W') {
                                                                 $txtReceiveStatus = "รออนุมัติ";
                                                            }


                                                            echo $value['sender_name'] . "<span class='text-primary'>" . " (" . db2Date($value['sender_date']) . " " . $value['sender_time'] . ")" . "</span>" . $receiveName . " <span class='text-success'>" . $txtReceiveStatus . " " .  $receiveDatetime . "</span>" . " <span class='text-danger'>" . $value['comment'] . "</span>"; ?>
                                                        </td>

                                                    </tr>
                                                <?php
                                                    $indexFile++;
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        เอกสารแนบ
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                        <tr>
                                                            <th>
                                                                <div align="center">ลำดับ</div>
                                                            </th>
                                                            <th>
                                                                <div align="center">เอกสารแนบ</div>
                                                            </th>

                                                        </tr>
                                                        <?php
                                                        $indexFile = 1;
                                                        foreach ($dataFile as $key => $value) {
                                                        ?>
                                                            <tr id="tr_<?php echo $value['file_id']; ?>">
                                                                <td align="center"><?php echo $indexFile; ?></td>
                                                                <td><a href="<?php echo $value['full_url']; ?>" target="_blank" download="<?php echo $value['file_name']; ?>"><?php echo $value['file_name']; ?></a></td>

                                                            </tr>
                                                        <?php
                                                            $indexFile++;
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        พยาน
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                        <tr>
                                                            <th>
                                                                <div align="center">ลำดับ</div>
                                                            </th>
                                                            <th>
                                                                <div align="center">ชื่อ-สกุล</div>
                                                            </th>
                                                            <th>
                                                                <div align="center">ตำแหน่ง</div>
                                                            </th>
                                                            <th>
                                                                <div align="center">หน่วยงาน</div>
                                                            </th>

                                                        </tr>
                                                        <?php
                                                        $indexFile = 1;
                                                        foreach ($dataFrmWiness as $key => $value) {
                                                        ?>
                                                            <tr id="tr_<?php echo $value['f_id']; ?>">
                                                                <td align="center"><?php echo $indexFile; ?></td>
                                                                <td><?php echo $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname']; ?></td>
                                                                <td align="center"><?php echo $value['usr_pos_name']; ?></td>
                                                                <td align="center"><?php echo $value['usr_dep_name']; ?></td>

                                                            </tr>
                                                        <?php
                                                            $indexFile++;
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <form method="POST" name="MainFrm" id="MainFrm" action="../save/LetterProc.php" enctype="multipart/form-data">
                                        <input type="hidden" name="TEMP_FILE" id="TEMP_FILE" value="<?php echo date("Ymdhis") . $_SESSION['usr_id']; ?>">
                                        <input type="hidden" name="LETTER_ID" id="LETTER_ID" value="<?php echo $_GET['LETTER_ID']; ?>">
                                        <input type="hidden" name="PROC" id="PROC" value="<?php echo $_GET['proc']; ?>">
                                        <input type="hidden" name="bp_id" id="bp_id" value="<?php echo $_GET['bp_id']; ?>">
                                        <input type="hidden" name="step" id="step" value="<?php echo $_GET['STEP']; ?>">
                                        <?php if ($_GET['proc'] == 'Approve') {
                                            include("FrmSign.php");
                                        } else if ($_GET['proc'] == 'Receive') {
                                            include("FrmReceive.php");
                                        ?>
                                            <div class="form-group row">
                                                <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">เอกสารแนบ</label>
                                                <div class="col-sm-6">
                                                    <div id="file-dropzone" class="dropzone"></div>
                                                </div>
                                            </div>
                                        <?php
                                        } ?>
                                        <div class="row">
                                            <div class="col-sm-4">
                                            </div>
                                            <div class="col-sm-4">
                                                <center> <button type="submit" class="btn btn-success">บันทึก</button></center>
                                            </div>
                                            <div class="col-sm-4">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>

    </form>
</body>

</html>
<script>
    function HideSign(val) {
        if (val == 'Y') {
            $('#divSign').show();
        } else {
            $('#divSign').hide();
        }
    }
    $(document).ready(function() {
        HideSign('N');
    });

    function saveData() {

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
</script>
<script src="../assets/js/dorpZone.js"></script>