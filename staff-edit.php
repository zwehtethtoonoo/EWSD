<?php 
    include("inc/header.php");             

    $staffid=$_GET['staffid'];

    if (isset($_POST['BtnUpd'])) {

        $staffid=$_POST["staffid"];
        $email=$_POST["email"];
        $name=$_POST["name"];
        $username=$_POST["username"];
        $password=$_POST["password"];
        
        $updatesql="UPDATE tblstaff
                SET email='$email',
                    name='$name',
                    username='$username',
                    password='$password'            
                WHERE staffid='$staffid'";

            $updatequery=mysqli_query($connection,$updatesql);



            if ($updatequery) { //true
                echo '<script type="text/javascript"> alert ("Staff Profile is successfully edited!!");
                        window.location.href="staff-profile.php";</script>';
            }
            else {
                echo "<script>alert('Error on editing staff profile!')</script>";
            }
    }

      $sql="SELECT *
                FROM tblstaff
                WHERE staffid='$staffid' ";
        $query=mysqli_query($connection,$sql);
        $count= mysqli_num_rows($query);
        $row=mysqli_fetch_array($query);                                               
                                                
 ?>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Staff Profile</h4>
                            </div>
                            <div class="card-body">
                           <div class="form-validation">
                                    <form class="form-valide" action="#" method="POST">
                                        <input type="hidden" name="staffid" value="<?php echo $staffid;?>"/>
                                        <div class="row">
                                            <div class="col-xl-6">

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">Name                    
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">Staff Email Address
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">UserName                    
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-username" name="username" value="<?php echo $row['username']; ?>" required />
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">Password
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" id="val-password" name="password" value="<?php echo $row['password']; ?>" required />
                                                    </div>
                                                </div>

                                                    <button type="submit" class="btn btn-primary" name="BtnUpd">Save</button>
                                                    <button type="reset" class="btn btn-warning"> <a style="color:white;" href="staff-profile.php">Back</a></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<?php 
    include("inc/footer.php");
?>