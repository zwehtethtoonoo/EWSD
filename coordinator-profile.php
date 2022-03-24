<?php 
    include("inc/qac_header.php");


    if(isset($_SESSION['qacid'])) 
    {
        $coordinatorid=$_SESSION['qacid'];   
            $sql="SELECT *
                FROM tblcoordinator
                WHERE coordinatorid='$coordinatorid' ";
        $query=mysqli_query($connection,$sql);
        $count= mysqli_num_rows($query);
        $row=mysqli_fetch_array($query);


           if ($count < 1) 
    {
        echo "<script>window.alert('ERROR : Coordinator Profile Not Found.')</script>";
        echo "<script>window.location='login.php'</script>";
    }

 else
 {
    $coordinatorid="";
 }
}
                                               
                                                
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
                                    <form class="form-valide" action="#" method="POST">
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
                                                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">User Name                    
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-username" name="username" value="<?php echo $row['username']; ?>" disabled/>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">Password
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" id="val-password" name="password" value="<?php echo $row['password']; ?>" disabled/>
                                                    </div>
                                                </div>

                                                                                                                                           
                                                <!-- <div class="form-group row">
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
                                                </div> -->

                                                    <button type="submit" class="btn btn-primary"> <a style="color:white;" href="coordinator-edit.php?qacid=<?php echo  $row['coordinatorid']; ?>" >Edit</a></button>
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