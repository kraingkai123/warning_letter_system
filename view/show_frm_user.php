<?php
include("../include/include.php");
$rUser = User::getDataUser($_POST['usr_id']);
?>
<form action="../save/SaveUser.php" method="post" id="frmUser" name="frmUser">
    <input type="hidden" id="proc" name="proc" value="<?php echo $_POST['proc']; ?>">
    <input type="hidden" id="usr_id" name="usr_id" value="<?php echo $_POST['usr_id']; ?>">
    <div class="row">
        <div class="col-md-2 pr-1">

            <label>คำนำหน้า</label><br>
            <select class=" select2 form-control" style="width: 100%;" id="prefix_id" name="prefix_id">
                <option value="">โปรดเลือก</option>
                <?php
                $resposnePrefix = User::getPrefix();
                foreach ($resposnePrefix as $key => $value) {
                ?>
                    <option value="<?php echo $value['prefix_id']; ?>" <?php echo $value['prefix_id'] == $rUser['prefix_id'] ? "selected" : ""; ?>><?php echo $value['prefix_name']; ?></option>
                <?php
                }
                ?>
            </select>

        </div>
        <div class="col-md-5 px-1">
            <div class="form-group">
                <label>ชื่อ</label>
                <input type="text" class="form-control" placeholder="ชื่อ" value="<?php echo $rUser['usr_fname']; ?>" name="usr_fname" id="usr_fname">
            </div>
        </div>
        <div class="col-md-5 pl-1">
            <div class="form-group">
                <label for="exampleInputEmail1">นามสกุล</label>
                <input type="text" class="form-control" placeholder="นามสกุล" value="<?php echo $rUser['usr_lname']; ?>" name="usr_lname" id="usr_lname">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pr-1">
            <label>เพศ</label><br>
            <select class=" form-control" id="usr_gender" name="usr_gender">
                <option value="1" <?php echo $rUser['usr_gender'] == 1 ? 'selected' : ""; ?>>ชาย</option>
                <option value="2" <?php echo $rUser['usr_gender'] == 2 ? 'selected' : ""; ?>>หญิง</option>
            </select>

        </div>
        <div class="col-md-5 px-1">
            <div class="form-group">
                <label>เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $rUser['usr_tel']; ?>" name="usr_tel" id="usr_tel">
            </div>
        </div>
        <div class="col-md-5 pl-1">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" placeholder="Email" value="<?php echo $rUser['usr_email']; ?>" name="usr_email" id="usr_email">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 pr-1">
            <div class="form-group">
                <label>เลขประจำตัวบัตรประชาชน</label>
                <input type="text" class="form-control" maxlength="13" placeholder="เลขประจำตัวบัตรประชาชน" value="<?php echo $rUser['usr_idcard']; ?>" name="usr_idcard" id="usr_idcard">
            </div>
        </div>
        <div class="col-md-5 pl-1">
            <div class="form-group">
                <label for="inputPassword" class="col-sm-4 col-form-label">ผู้ดูแลระบบ</label>
                <div class="col-sm-10">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="usr_type" name="usr_type" <?php echo $rUser['usr_type'] == 1? 'checked' : '' ;?>>
                        <label class="custom-control-label" for="usr_type"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pr-1">
            <label>หน่วยงาน/ฝ่าย</label><br>
            <select class=" form-control" style="width: 100%;" id="dep_id" name="dep_id">
                <option value="">โปรดเลือก</option>
                <?php
                $resposnePrefix = Department::ListDepartment();
                foreach ($resposnePrefix as $key => $value) {
                ?>
                    <option value="<?php echo $value['dep_id']; ?>" <?php echo $value['dep_id'] == $rUser['dep_id'] ? "selected" : ""; ?>><?php echo $value['dep_name']; ?></option>
                <?php
                }
                ?>
            </select>

        </div>
        <div class="col-md-5 px-1">
            <label>ตำแหน่ง</label><br>
            <select class=" form-control" style="width: 100%;" id="usr_position" name="usr_position">
                <option value="">โปรดเลือก</option>
                <?php
                $resposnePrefix = Position::ListPostion();
                foreach ($resposnePrefix as $key => $value) {
                ?>
                    <option value="<?php echo $value['pos_id']; ?>" <?php echo $value['pos_id'] == $rUser['usr_position'] ? "selected" : ""; ?>><?php echo $value['pos_name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        /* $('#prefix_id').select2({
            placeholder: 'คำขึ้นต้น',
            maximumSelectionLength: 1,
            language: {
                maximumSelected: function() {
                    return 'คุณสามารถเลือกได้เพียง ' + 1 + ' รายการเท่านั้น';
                }
            },
        })
        $('#dep_id').select2({
            placeholder: 'คำขึ้นต้น',
            maximumSelectionLength: 1,
            language: {
                maximumSelected: function() {
                    return 'คุณสามารถเลือกได้เพียง ' + 1 + ' รายการเท่านั้น';
                }
            },
        })
        $('#usr_position').select2({
            placeholder: 'คำขึ้นต้น',
            maximumSelectionLength: 1,
            language: {
                maximumSelected: function() {
                    return 'คุณสามารถเลือกได้เพียง ' + 1 + ' รายการเท่านั้น';
                }
            },
        }) */
    });
</script>