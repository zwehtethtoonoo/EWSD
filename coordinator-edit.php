<?php 
    include("inc/header.php");             

    $qacid=$_GET['qacid'];

    if (isset($_POST['BtnUpd'])) {

        $cooridinatorid=$_POST["cooridinatorid"];
        $email=$_POST["email"];
        $name=$_POST["name"];
        $username=$_POST["username"];
        $password=$_POST["password"];
        
        $updatesql="UPDATE tblcoordinator
                SET email='$email',
                    name='$name',
                    username='$username',
                    password='$password'            
                WHERE coordinatorid='$cooridinatorid'";

            $updatequery=mysqli_query($connection,$updatesql);



            if ($updatequery) { //true
                echo '<script type="text/javascript"> alert ("QAC Profile is successfully edited!!");
                        window.location.href="coordinator-profile.php";</script>';
            }
            else {
                echo "<script>alert('Error on editing qac profile!')</script>";
            }
    }

      $sql="SELECT *
                FROM tblcoordinator
                WHERE coordinatorid='$qacid' ";
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
                                <h4 class="card-title">Cooridinator Profile</h4>
                            </div>
                            <div class="card-body">
                           <div class="form-validation">
                                    <form class="form-valide" action="coordinator-edit.php" method="POST">

                                        <input type="hidden" name="cooridinatorid" value="<?php echo $row['coordinatorid'];?>"/>
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
                                                    <label class="col-lg-4 col-form-label" for="">QAC Email Address
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">User Name                    
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

                                                                                                                                           
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label"><a
                                                            >Terms &amp; Conditions</a>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                                            <input type="checkbox" class="css-control-input mr-2"
                                                                id="val-terms" name="val-terms" value="1">
                                                            <span class="css-control-indicator"></span> I agree to the
                                                            terms</label>
                                                    </div>
                                                </div>

                                                    <button type="submit" class="btn btn-primary" name="BtnUpd">Save</button>

                                                    <button type="reset" class="btn btn-warning"> <a style="color:white;" href="coordinator-profile.php">Back</a></button>
                                            </div>
                                        </div>
                                    </form>
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