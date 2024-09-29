const elementUploadFiles = `UPLOAD_DOCUMENT_FILES`;
const elementPreviesFiles = `#upload-document`;
const fileSize = 10;
var myDropzone = new Dropzone("#file-dropzone", {
    url: "../save/document-process.php",  // URL to upload files
    autoProcessQueue: false,  // Prevent auto-upload of files
    parallelUploads: 10,      // Number of files to upload at the same time
    maxFilesize: 5,           // Maximum file size in MB
    addRemoveLinks: true,
    dictRemoveFile: "ลบ",
    dictDefaultMessage: `วางเอกสารที่นี่เพื่ออัพโหลด<br><i class="nc-icon nc-cloud-upload-94" style='font-size: 5em;color: #5c98ff;'></i><br>คลิกเพื่อเรียกดูไฟล์`,
    init: function () {
        var dropzoneInstance = this;

        // Capture the form submit event
        document.getElementById("MainFrm").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent the form from submitting right away
            var status = $('input[name="rdoStatus"]:checked').val();
            var proc = $("#PROC").val();

            if (proc == 'Approve') {
                if (status == undefined) {
                    Swal.fire({
                        title: "กรุณาเลือกสถานะ",
                        text: "",
                        icon: "error"
                    });
                    return false;
                } else if (status == "B" || status == 'N') {
                    if ($("#hr_reson").val() == "") {
                        Swal.fire({
                            title: "กรุณากรอกหมายเหตุ",
                            text: "",
                            icon: "error"
                        });
                        return false;
                    }
                }else{
                    if($("#img_create").val()==""){
                        Swal.fire({
                            title: "กรุณเขียนภาพลายเซ็น",
                            text: "",
                            icon: "error"
                        });
                        return false;
                    }
                }
            }
            // If files are added to Dropzone
            if (dropzoneInstance.getQueuedFiles().length > 0) {
                // Add the form data to each upload request before processing the queue
                dropzoneInstance.on("sending", function (file, xhr, formData) {
                    formData.append("TEMP_FILE", document.getElementById("TEMP_FILE").value);  // Add form data
                });

                // Process the file queue (upload files)
                dropzoneInstance.processQueue();
            } else {
                // If no files, submit the form data immediately
                //document.getElementById("MainFrm").submit();
                saveData()
            }
        });

        // When all files are successfully uploaded, submit the form
        dropzoneInstance.on("queuecomplete", function () {
            // Now submit the form after all files are uploaded
            //document.getElementById("MainFrm").submit();
            saveData()
        });
    }
});






