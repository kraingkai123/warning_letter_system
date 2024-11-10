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
                            <form action="" method="post" id="frmMain">
                                <div class="text-center">
                                    <h4>รายงานการลงโทษทางวินัย</h4>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input id="startDate" name="startDate" class="form-control" type="date" value="<?php echo $_POST['startDate']; ?>" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="endDate" name="endDate" class="form-control" type="date" value="<?php echo $_POST['endDate']; ?>" />
                                    </div>
                                </div>
                                <input type="hidden" id="typeExport" name="typeExport">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success"><span class="nc-icon nc-zoom-split"></span> ค้นหา</button>
                                </div>
                            </form>
                            <?php
                            unset($req);
                            if (!empty($_POST['startDate'])) {
                                $req['startDate'] = $_POST['startDate'];
                            }
                            if (!empty($_POST['endDate'])) {
                                $req['endDate'] = $_POST['endDate'];
                            }

                            $req['dep_id'] = $_SESSION['dep_id'];
                            $respone = Report::ListRule($req);
                            ?>
                            <div class="text-right">
                                <button type="button" class="btn btn-success" onclick="exportData('excel')">ส่งออก Excal</button>
                                <button type="button" class="btn btn-danger" onclick="exportData('pdf')">ส่งออก PDF</button>
                            </div>
                            <div id='divExport'>
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" width="10%">ลำดับ</th>
                                            <th class="text-center" width="10%">ชื่อ-สกุล</th>
                                            <th class="text-center" width="30%">หน่วยงาน</th>
                                            <th class="text-center" width="20%">ตำแหน่ง</th>
                                            <th class="text-center" width="20%">ข้อบังคับ</th>
                                            <th class="text-center" width="10%">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 1;
                                        if (count($respone) > 0) {
                                            foreach ($respone as $key => $value) {
                                                $ltterId = $value['letter_id'];
                                                $usrId =  $value['usr_id'];
                                                unset($req);
                                                $req['usrId'] = $usrId;
                                                $req['letterId'] = $ltterId;
                                                if (!empty($_POST['startDate'])) {
                                                    $req['startDate'] = $_POST['startDate'];
                                                }
                                                if (!empty($_POST['endDate'])) {
                                                    $req['endDate'] = $_POST['endDate'];
                                                }

                                                $req['dep_id'] = $_SESSION['dep_id'];
                                                $responseRule = Report::getruleList($req);
                                                $contRule = count($responseRule);
                                                if ($contRule == 0) {
                                                    $contRule = 1;
                                                } else {

                                                    $contRule++;
                                                }

                                        ?>
                                                <tr>
                                                    <td rowspan="<?php echo $contRule; ?>" class="text-center"><?php echo $index; ?></td>
                                                    <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['fullname']; ?></td>
                                                    <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['usr_dep_name']; ?></td>
                                                    <td rowspan="<?php echo $contRule; ?>"><?php echo  $value['usr_pos_name']; ?></td>

                                                    <?php
                                                    if ($contRule  > 1) {
                                                        foreach ($responseRule as $key2 => $valuerule) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo  $valuerule['rule_name']; ?></td>
                                                    <td  class="text-center"><?php echo  $valuerule['countrule']; ?></td>
                                                </tr>
                                            <?php
                                                        }
                                                    } else {
                                            ?>

                                            <td class="text-center">-</td>
                                            <td class="text-center">0</td>

                                        <?php
                                                    }
                                        ?>
                                        </tr>
                                    <?php
                                                $index++;
                                            }
                                        } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">ไม่พบข้อมูล</td>
                                    </tr>
                                <?php
                                        }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function exportData(type) {
                $("#typeExport").val(type)
                $("#frmMain").attr("action",'../save/export.php')
                $("#frmMain").attr("target",'_blank')
                $("#frmMain").submit();
                $("#frmMain").attr("action",'')
            }
        </script>
        <?php include("../include/footer.php"); ?>
    </div>


</body>

</html>