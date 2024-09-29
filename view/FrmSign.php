<div class="row">
    <div class="col-md-1">อนุมัติหนังสือ</div>
    <div class="col-md-11">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rdoStatus" id="rdoStatus" value="Y" onclick="HideSign(this.value)">
            อนุมัติ
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rdoStatus" id="rdoStatus" value="N" onclick="HideSign(this.value)">
            ไม่อนุมัติ
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rdoStatus" id="rdoStatus" value="B" onclick="HideSign(this.value)">
            ส่งกลับแก้ไข
        </div>
    </div>
</div>
<br>
<div class="form-group row" id="divSign">
    <div class="col-sm-2">
        <a href="#!" class="btn btn-primary"
            onclick="window.open('../form/letter_sign.php?ID=xxxx','sign','width=1000,height=600');"> <i class="icofont icofont-edit-alt"></i> เซ็นชื่อ</a>
    </div>
    <div class="col-sm-6">
        <img id="view_pic" src="" style="width: 500px;" />
    </div>
    <textarea id="img_create" name="img_create" rows="4" cols="50" readonly></textarea>
</div>
<br>
<div class="row">
    <div class="col-md-1">หมายเหตุ</div>
    <div class="col-md-6">
        <textarea class="form-control" id="hr_reson" name="hr_reson" rows="3"></textarea>
    </div>
</div>
<br>
<div class="form-group row">
    <label for="letter_write_address" class="col-sm-1 col-form-label text-dark">เอกสารแนบ</label>
    <div class="col-sm-6">
        <div id="file-dropzone" class="dropzone"></div>
    </div>
</div>