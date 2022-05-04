<?php
include 'connect.php';
include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];
$name = $_POST["search"];

$sql = "select *
            FROM book b join bookcategory bc on  b.bc_id = bc.bc_id 
            inner join booklist bl on bl.b_id = b.b_id    WHERE bl.bl_status = 0 AND  (bl.bl_id LIKE '%$name%') OR (b.b_name LIKE '%$name%') AND (bl.bl_status = 0)";
$result = mysql_query($sql,$conn);
$count=mysql_num_rows($result);


?>
    <!DOCTYPE html>
    <html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
        <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>





    </head>

    <body id="page-top">

    <div id="wrapper">
        <?php
        include 'staff_menu.php'
        ?>
         <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">รายการหนังสือ</h1>
                        <form id="form1" name="form1" class="form-inline" method="post" action="searchbook.php">
                                <div class="form-group">
                                    <input name="search" type="text" id="search"  class="form-control" placeholder="กรุณาใส่ข้อมูล">&nbsp;&nbsp;
                                    <input type="submit"  value="ค้นหา" class="btn btn-primary">
                                   
                                    
                                </div>
                        </form>
                </div>
        </div>      
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                                <div class="row row-cols-4 ">
                                    <?php
                                       
                                        
                                        while ($row = mysql_fetch_object($result)) {
                                                    ?>
                                            <div class="grid_1_of_4 images_1_of_4">
                                                <div class="col">                                               
                                                    <div align="center">
                                                                <?php if($row->b_pic !=""){ 
                                                                    ?>
                                                                        <img src="./picture/<?php echo $row->b_pic; ?>" class="product-content" width="50%" >
                                                                    <?php
                                                                }
                                                                ?>
                                                    </div>
                                                    <div align="center"><?php echo"$row->bl_id";?></div>
                                                    <div align="center" ><?php echo"$row->b_name";?></div>
                                                    <div align="center">
                                                    <a class="btn btn-success"  href="cart.php?bl_id=<?php echo $row->bl_id;?>&amp;act=add">
                                                    <i class="fas fa-plus-circle"></i> </a></div>
                                                
                                                </div>
                                            </div>
                                     <?php
                                    }
                                    ?>
                                </div>                                  
                                </table>
                            </div>
                        </div>
                    </div>            
                </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ยันยืนการออกจากระบบ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณต้องการออกจากระบบใช่หรือไหม</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>



    <script>
        $(document).ready(function(){

            $('#country').typeahead({
                source: function(query, result)
                {
                    $.ajax({
                        url:"fetch.php",
                        method:"POST",
                        data:{query:query},
                        dataType:"json",
                        success:function(data)
                        {
                            result($.map(data, function(item){
                                return item;
                            }));
                        }
                    })
                }
            });

        });
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        function deleteLocation(b_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "deletebook.php?b_id="+b_id;
                }
            })
        };
    </script>


    </body>
    </html>

<?php
mysql_close($conn);