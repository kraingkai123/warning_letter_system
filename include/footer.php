<!--   Core JS Files   -->
<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <div class="credits ml-auto">
                <span class="copyright">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                </span>
            </div>
        </div>
    </div>
</footer>
<script src="../assets/js/core/jquery.min.js"></script>
<!-- <script src="../assets/js/core/popper.min.js"></script> -->
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<!-- <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script> --><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>
<!-- dataTable -->
<!-- Datatables -->
<script src="../assets/js/plugins/datatables/datatables.min.js"></script>
<script src="../assets/js/plugins/sweetalert/sweetalert2.min.js"></script>
<script src="../assets/js/plugins/select2/select2.full.min.js"></script>
<script src="../assets/js/quill.js"></script>
<script>
    function LoadDatatable(table) {
        var t = $('#' + table).DataTable({
            "responsive": true,
            "lengthChange": false,
            "columnDefs": [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 1
                }
            ],

            "language": {
                "search": "ค้นหา:",
                "infoFiltered": "( คำที่ค้นหา จาก _MAX_ รายการ ทั้งหมด ) ",

            }
        });
        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }

    function showLoadingPage(showText = "") {
        let text = showText || "กำลังโหลดข้อมูล";
        Swal.fire({
            title: '',
            text: text,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Display loading spinner
            }
        });

    }
</script>