<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dropzone.js with Form Submit</title>
  <!-- Dropzone CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
  <!-- Bootstrap for button styling (optional) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h3>Upload Files with Dropzone.js and Form Submit</h3>

  <!-- Additional Form Data -->
  <form id="myForm" method="post" action="submit.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required>
    </div>

    <!-- Dropzone Form (Without Action URL, handled via myDropzone) -->
    <div id="file-dropzone" class="dropzone"></div>

    <!-- Submit Button -->
    <button type="submit" id="submit-all" class="btn btn-primary mt-3">Submit Form & Upload Files</button>
  </form>

</div>

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
  // Initialize Dropzone without automatic processing
  var myDropzone = new Dropzone("#file-dropzone", {
    url: "upload.php",  // URL to upload files
    autoProcessQueue: false,  // Prevent auto-upload of files
    parallelUploads: 10,      // Number of files to upload at the same time
    maxFilesize: 5,           // Maximum file size in MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif",  // Accepted file types

    init: function() {
      var dropzoneInstance = this;

      // Capture the form submit event
      document.getElementById("myForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent the form from submitting right away

        // If files are added to Dropzone
        if (dropzoneInstance.getQueuedFiles().length > 0) {
          // Add the form data to each upload request before processing the queue
          dropzoneInstance.on("sending", function(file, xhr, formData) {
            formData.append("username", document.getElementById("username").value);  // Add form data
          });

          // Process the file queue (upload files)
          dropzoneInstance.processQueue();
        } else {
          // If no files, submit the form data immediately
          document.getElementById("myForm").submit();
        }
      });

      // When all files are successfully uploaded, submit the form
      dropzoneInstance.on("queuecomplete", function() {
        // Now submit the form after all files are uploaded
        document.getElementById("myForm").submit();
      });
    }
  });
</script>

</body>
</html>
