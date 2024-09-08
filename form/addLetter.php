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
                        <div id="editor"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <button onclick="save()">dddd</button>
        <?php include("../include/footer.php"); ?>
    </div>
    </div>
</body>
<style>
        #editor {
            height: 300px;
        }
    </style>
</html>
<script>
     $(document).ready(function () {
        var quill = new Quill('#editor', {
        theme: 'snow'
    });
            });
            function save(){
                console.log($('#editor').text())
            }
</script>