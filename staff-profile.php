<?php 
    include("inc/header.php");
    include_once("inc/autoid.php");
    include_once("inc/connect.php");

if (!isset($_SESSION['staffid'])) 
{
    echo "<script>window.alert('Please Login first to continue.')</script>";
    echo "<script>window.location='login.php'</script>";
}


 if(isset($_SESSION['staffid'])) 
{
    $staffid=$_SESSION['staffid'];

    $sql="SELECT * FROM tblstaff WHERE staffid='$staffid'";
    $query=mysqli_query($connection,$sql);
    $count=mysqli_num_rows($query);
    $row=mysqli_fetch_array($query);
    if ($count < 1) 
    {
        echo "<script>window.alert('ERROR : Staff Profile Not Found.')</script>";
        echo "<script>window.location='login.php'</script>";
    }

 else
 {
    $staffid="";
 }
}
 ?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Staff Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Staff ID</th>
                                                <th>Staff Name</th>
                                                <th>Department ID</th>
                                                <th>Email</th>
                                                <th>User Name</th>
                                                <th>Password</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                                    <tr>
                                                        <td><?php echo $row['staffid'];?></td>
                                                        <td><?php echo $row['name'];?></td>
                                                        <td><?php echo $row['departmentid'];?></td>
                                                        <td><?php echo $row['email'];?></td>
                                                        <td><?php echo $row['username'];?></td>
                                                        <td><?php echo $row['password'];?></td>
                                                        <td>
                                                            <span>

                                                                <a href="update-staff.php?stid=<?php echo  $row['staffid']; ?>" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="fa fa-pencil color-muted"></i> 
                                                                </a>

                                                                <a href="delete-staff.php?stid=<?php echo  $row['staffid']; ?>" data-toggle="tooltip" data-placement="top" title="Close">
                                                                    <i class="fa fa-close color-danger"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                
                                            
                                        </tbody>

                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<?php 
    include("inc/footer.php");
?>