<?php
include("../include/header.php");
?>
<script src="../assets/js/atrament.min.js"></script>
<script defer src="../assets/js/sign.js"></script>
<style>
	canvas {
		width: 900px;
		height: 300px;
		border: 3px solid black !important;
		top: 0;
		left: 0;
		z-index: 2;
	}

	#clear {
		display: none;
	}
</style>

<!-- Row Starts -->
<div class="row">
	<div class="col-sm-12">
		<div class="main-header">
			<h4><i class="icofont icofont-edit-alt"></i> เซ็นลายมือ</h4>
		</div>
	</div>
</div>
<!-- Row end -->
<div id="my-node-parent2">
	<div id="my-node2">
		<!-- Row Starts -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-block">
						<div class="form-group row">
							<div class="col-md-12 text-center">
								<canvas id="sketcher"></canvas>
							</div>
						</div>
						<form method="post" id="form_wf" name="form_wf" action="letter_sign_online_function.php">
							<div class="form-group row">
								<div class="col-md-12">
									<center>
										<button class="btn btn-success" type="button" id="Save" onclick="save_sign();"> <i class="icofont icofont-save"></i> ยืนยัน</button>
										<button type="button" class="btn btn-warning" id="clear" onclick="atrament.clear();$('#clear').hide();"> <i class="icofont icofont-eraser-alt"></i> Clear </button>
										
									</center>
									
									<input type="hidden" name="data" id="data">
									<input type="hidden" name="Flag" value="Sign">
									<input type="hidden" name="WFR" value="">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
	</div>
</div>
<script>
	function save_sign() {
		document.getElementById("data").value = document.getElementById("sketcher").toDataURL("image/png").replace('data:image/png;base64,', '');
        window.opener.document.getElementById('img_create'+'_<?php echo $_GET['proc'];?>'+'<?php echo $_GET['ID'];?>').value = document.getElementById("sketcher").toDataURL("image/png").replace('data:image/png;base64,', '');
        window.opener.document.getElementById('view_pic'+'_<?php echo $_GET['proc'];?>'+'<?php echo $_GET['ID'];?>').src = document.getElementById("sketcher").toDataURL("image/png");
        window.close();
	}
</script>
<pre id="events"></pre>
<?php // } db::db_close(); 
?>
