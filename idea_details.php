<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Idea Details </title>
    <!-- Favicon icon -->
   
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png"> 

<!-- add font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Add css  -->
    <link href="./css/style.css" rel="stylesheet">


<!-- Add script -->


<!-- add jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>



    <?php 
    include('inc/header.php');
    include_once("inc/autoid.php");
        include_once("inc/connect.php");


if (!isset($_SESSION['staffid'])) // login first if no session 
{
    echo "<script>window.alert('Please Login first to continue.')</script>";
    echo "<script>window.location='login.php'</script>";
}


 if(isset($_SESSION['staffid'])) // login session
{
    $sid=$_SESSION['staffid'];

    $sql="SELECT * FROM tblstaff WHERE staffid='$sid'";
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
    $sid="";
 }
}


 ?>

</head>

<body>

<script type="text/javascript">

$(document).ready(function(){ 

    $('.like_btn').on('click',function(){

        var idea_id = $(this).data('id');
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
            action = 'like';

        } else if ($clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }

    })



})
     

</script>

    <?php

// if (isset($_POST['action'])) {
//     $idea_id=$_POST['ideaid'];
//     $action=$_POST['action'];
//     $time=date('Y-m-d H:i:s');


//     switch ($action) {
//         case 'like':
//             $sql="INSERT INTO tblrating (ideaid,responderid,react_date,rating)
//                     VALUES ('$idea_id','$staffid','$time','$action')
//                     ON DUPLICATE KEY UPDATE rating='like'";
//             break;

//         case 'unlike':
//             $sql="INSERT INTO tblrating (ideaid,responderid,react_date,rating)
//                     VALUES ('$idea_id','$staffid','$time','$action')
//                     ON DUPLICATE KEY UPDATE rating='unlike'";
//             break;

//         case 'dislike':
//             $sql="DELETE FROM tblrating WHERE responderid='$staffid' AND ideaid='$idea_id'";
//             break;

//         case 'undislike':
//             $sql="DELETE FROM tblrating WHERE responderid='$staffid' AND ideaid='$idea_id'";
//             break;

//         default:
//             break;
//     }
//     //execute query
//     mysqli_query($connection,$sql);
//     exit();


// } else {
//         echo "<p>Something went wrong in addding rating!  " . mysqli_error($connection) . "</p>";
// }

    ?>

    <!--*******************
        Preloader start
    ********************-->
<!--     <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
   

        <!--**********************************
            Nav header start
        ***********************************-->
    
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a  href="index.php" aria-expanded="false">
                        <i></i><span class="nav-text">Dashboard</span></a>
                     
                    </li>

              <!--       <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.php">Profile</a></li>
                            <li><a href="./news_feed.php">News Feed</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="./email-compose.php">Compose</a></li>
                                    <li><a href="./email-inbox.php">Inbox</a></li>
                                    <li><a href="./email-read.php">Read</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-label">Admin</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-copy-06"></i><span class="nav-text">Admin</span></a>
                        <ul aria-expanded="false">
                            
                            <li><a href="./page-login.php">Login</a></li>
                        </ul>
                    </li>
                   
                    <li class="nav-label">category</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">category</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./category-register.php">Register - category</a></li>
                            <li><a href="./category-listing.php">category - Listing</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Forms</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./register-academic-year.php">Register - Academic Year</a></li>
                            <li><a href="./register-department.php">Register - Department</a></li>
                            <li><a href="./register-staff.php">Register - Staff</a></li>
                            <li><a href="register-qac.php">Register - QAC</a></li>
                            <li><a href="register-qam.php">Register - QAM</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Listing</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-layout-25"></i><span class="nav-text">Listing</span></a>
                        <ul aria-expanded="false">
                            <li><a href="listing-academic-year.php">Academic Year</a></li>
                            <li><a href="listing-department.php">Department</a></li>
                            <li><a href="listing-staff.php">Staff</a></li>
                            <li><a href="listing-qac.php">Quanlity Assurance Coordinator</a></li>
                            <li><a href="listing-qam.php">Quanlity Assurance Manager</a></li>
                        </ul>
                    </li>                  
                </ul>
            </div>


        </div> -->

                    <?php 
                    if(isset($_SESSION["admid"]))

                            {   ?>
                           

                            <li class="nav-label">Admin Logout Form</li>
                             <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                          class="icon icon-single-copy-06"></i><span class="nav-text">Admin</span></a>
                                <ul aria-expanded="false">
                                    <!-- <li><a href="./page-register.php">Register</a></li> -->
                                   <!--  <li><a href="./admin-login.php">Login</a></li> -->
                                   <li><a href="./page-logout.php">Logout</a></li>
                                </ul>
                               </li>

                               <li class="nav-label">Register Forms</li>
                                   <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                                    <ul aria-expanded="false">
                                      <li><a href="./register-academic-year.php">Register - Academic Year</a></li>
                                      <li><a href="./register-department.php">Register - Department</a></li>
                                      <li><a href="./register-staff.php">Register - Staff</a></li>
                                      <li><a href="register-qac.php">Register - QAC</a></li>
                                      <li><a href="register-qam.php">Register - QAM</a></li>
                                    </ul>
                                   </li>

                            <li class="nav-label">Listing</li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-layout-25"></i><span class="nav-text">Listing</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="listing-academic-year.php">Academic Year</a></li>
                                    <li><a href="listing-department.php">Department</a></li>
                                    <li><a href="listing-staff.php">Staff</a></li>
                                    <li><a href="listing-qac.php">Quanlity Assurance Coordinator</a></li>
                                    <li><a href="listing-qam.php">Quanlity Assurance Manager</a></li>
                                </ul>
                            </li>   

                        <?php 

                            }

                            else if(isset($_SESSION["mgrid"]))

                            {   ?>

                            <li class="nav-label">category</li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">category</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./category-register.php">Register - category</a></li>
                                    <li><a href="./category-listing.php">category - Listing</a></li>
                                    <li><a href="./page-logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php 

                            }  else if(isset($_SESSION["staffid"]))

                                {    ?>

                           <li class="nav-label">Staff Logout Form</li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-single-copy-06"></i><span class="nav-text">Staff</span></a>
                                <ul aria-expanded="false">
                                   <li><a href="./staff-profile.php">Staff Profile</a></li>
                                   <li><a href="./page-logout.php">Logout</a></li>
                                </ul>
                            </li>

                          <li class="nav-label">Newsfeed</li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Ideas</span></a>
                                <ul aria-expanded="false">
                                    <li><a href="./news_feed.php?ft=LI">Newsfeed</a></li>
                          </li>


                        <?php   } 

                            else if(isset($_SESSION["qacid"]))

                                {   ?>

                            <li class="nav-label">Coordinator</li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                        class="icon icon-form"></i><span class="nav-text">Pages</span></a>
                                <ul aria-expanded="false">
                                   <li><a href="./coordinator-profile.php">Coordinator Profile</a></li>
                                   <li><a href="./page-logout.php">Logout</a></li>
                                </ul>
                            </li>


                        <?php   } 
    
                            
                            else 

                                {   ?>

                               <li class="nav-label">Login Forms</li>
                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="login.php">Login</a></li>
                                    </ul>
                                </li>

                         <?php  
                                }  ?>  
                    </ul>
            </div>


        </div>




        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
             Content body start
        ***********************************-->
    <?php 
            $ideaid=$_GET['ideaid'];
            $sqll="SELECT * FROM tbldepartment";
            $que=mysqli_query($connection,$sqll);
            $deprow=mysqli_fetch_array($que);

    $idea_select="SELECT i.*,s.name
                    FROM tblidea i,tblstaff s 
                    WHERE '$ideaid'=i.ideaid
                    AND i.staffid=s.staffid
                    ORDER BY i.idea_date 
                    LIMIT 1";
    $idea_ret=mysqli_query($connection,$idea_select);
    $idea_count=mysqli_num_rows($idea_ret);

    for($i=0; $i < $idea_count; $i++)  { 
// poster connection   
    $idea_row=mysqli_fetch_array($idea_ret);

    $posterid=$idea_row['staffid'];
    $postername=$idea_row['name'];

    $postdate=$idea_row['idea_date'];
    $ideaPost=$idea_row['idea_detail'];
    $ideaPost=$idea_row['idea_detail'];
    $ideavisibility=$idea_row['visibility'];
    
    $comres=mysqli_query($connection,"SELECT * FROM tblcomment WHERE ideaid='$ideaid'");
                                                        
    
?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="Hi, welcome back!">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                           
                        </div>
                    </div>

                </div>
                <!-- row -->
                <div class="row">

                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">

                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade active show">
                                                <div class="my-post-content pt-3">
                                                    <div class="tag-radio">
                                                        <div class="form-group">


                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <label><strong>Idea</strong></label>


<!--           image                                       <img src="images/profile/8.jpg" alt="" class="img-fluid"> -->                                                        

<?php

// rating and staff count connection to a idea

   // $rti_select="  SELECT i.*,r.*,s.* 
   //                  FROM tblrating r,tblstaff s 
   //                  WHERE r.responderid=s.staffid
   //                  AND r.ideaid=i.ideaid;
   //                  ";  
   //      $rq=mysqli_query($connection,$rti_select);
   //      $rtrow=mysqli_fetch_array($rq);
                                        switch ($ideavisibility){  

                                        case "yes":
    ?>

                                                        <a class="post-title" > 
                                                            <h3><?php echo $deprow['name'];?> Department</h3>
                                                            <h4><?php echo $posterid ;
                                                                    echo " - ";
                                                                    echo $postername; 
                                                                    echo "  posted at  ";
                                                                    echo $postdate;    

                                                      ?> </h4>
                                                        </a>

    <?php 
                                        break;

                                        case "no":
    echo    "<a class='post-title'>
                <h4> Anonymous   </h3>
            </a>";
                                        break;
                                        }
    ?>
                                                        <h4>
<?php 
                           

// category htae ya ml ******************** 

    $display_cat=mysqli_query($connection,"SELECT i.*,c.*
                                            FROM tblidea i,tblcategory c 
                                            WHERE '$ideaid'=i.ideaid
                                            AND i.categoryid=c.categoryid;");

    $display_cat_row=mysqli_fetch_array($display_cat);
    echo "Idea's Category - ".$display_cat_row['name'];


                                                              ?>
                                                        </h4>
                                                        <h5>
                                                            <style type="text/css">  #textarea{
                                                                font-size: 20px;
                                                            }</style>
                                                            <textarea  id="textarea" class="form-control bg-transparent" placeholder=" <?php   echo $ideaPost; ?>" disabled></textarea> 
                                                               
                                                        </h5>
                                                       
    <?php        

//like count with function


    // $ratfind="SELECT i.ideaid,i.categoryid,sum(r.voting) AS 'Votes' 
    //         FROM tblidea i, tblrating r 
    //         WHERE i.ideaid=$ideaid AND i.ideaid=r.ideaid;";
    // $rating_q=mysqli_query($connection,$ratfind); 

    // $r_row=mysqli_fetch_array($rating_q);
    // $votes=$r_row['Votes'];
    //  echo $votes ."Likes";

    ?>                                                   

<style type="text/css">
        a.acolor {
            color: white;
        }        


</style>
<?php 
    $res=mysqli_query($connection,"SELECT *
                                        FROM tblidea
                                        WHERE '$ideaid'=ideaid;");
                                $react=mysqli_fetch_array($res);
?>
                                      <input type="hidden" name="ratingid" value="<?php echo AutoID('tblrating','ratingid','RT-',5);?>">
<style type="text/css">
    i.like_btn{
        margin-left: 10px; margin-right: 10px;  font-size: 25px;
    }

    i.dislike_btn {
        margin-left: 10px; margin-right: 10px;  font-size: 25px;
    }
</style>                                      
                                        <i class="fa fa-thumbs-o-up like_btn" data-id="<?php echo $react['ideaid'] ?>"></i>
                                        <i class="fa fa-thumbs-o-down dislike_btn" data-id="<?php echo $react['ideaid'] ?>"></i>
                
                                                                                
                                                                        <hr>                     
                                                                        <?php 

// Comment Count 
        $ideaaaid=$display_cat_row['ideaid'];
        $comres=mysqli_query($connection,"SELECT * FROM tblcomment c WHERE c.ideaid='$ideaid'");

        $comrow=mysqli_fetch_array($comres);

   // If condition for no comment or multiple comments 
        if (empty($comrow)) {
     ?> 
                                                                        <div class="container">
                                                                            <div class="row" style="margin-top: 10px;">
                                                                                <div class="col-7">
                                                                                    <h4 style="color: black;"> <?php echo $ideaid. " No comments!" ; ?></h4>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        
                                                                        </div>
                                                                </div>
    <?php 
        }
        else if ($comrow >= '1') {

        // Displaying comments
                        $display_cmt=mysqli_query($connection,"SELECT c.*, s.*
                                        FROM tblcomment c, tblstaff s
                                        WHERE '$ideaid'=c.ideaid
                                        AND c.commenterid=s.staffid;");
                                $display_cmt_count=mysqli_num_rows($display_cmt);

                                 
    ?>

                                                                    
    <?php 
        // Loop for multiple comments

            for ($c=0; $c < $display_cmt_count ; $c++) { 

                $display_cmt_row=mysqli_fetch_array($display_cmt);
                $commenter=$display_cmt_row['name'];
                $staffid=$_SESSION['staffid'];



            

    ?>                                                <div class="container">
                                                                        <div class="row" style="margin-top: 10px;">
                                                                            <div class="col-7">
                                                                                <h4 style="color: black;" ><?php echo $commenter ; ?></h4>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <h5><?php echo $display_cmt_row['commentdate']; ?></h5>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <h5><?php echo $display_cmt_row['comment']; ?></h3>
                                                                            </div>

                                                                        </div>
                                                                    </div>
<?php 

                }
            }


            

?>


                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-8">

 <?php 

 // if comment button submit

        if (isset($_POST['BtnPost'])) {
                
            $commentid=$_POST['commentid'];
            $txtcmt=$_POST['txtarea'];            
            $timestamp=date('Y-m-d H:i:s');
            $upideaid=$_POST['upideaid'];
            $commenterid=$_POST['commenterid'];
            $comment_result=mysqli_query($connection,"INSERT INTO tblcomment (commentid,ideaid,commenterid,commentdate,comment) VALUES ('$commentid','$upideaid','$commenterid','$timestamp','$txtcmt');");

            if($comment_result) //True
        {
        echo "<script>window.alert('Comment Successfully added!')</script>";
        echo "<script>window.location='idea_details.php?ideaid=$ideaid'</script>";
        }
        else
        {
        echo "<p>Something went wrong in comment entry!  " . mysqli_error($connection) . "</p>";
        }

    }

?>                                                                                             
                                                                              
<form action="#" method="POST" enctype="multipart/form-data">
                                                                            <div class="post-input">          
                            <input type="hidden" name="commentid" value="<?php echo AutoID('tblcomment','commentid','CId-',5);?>">
                            <input type="hidden" name="upideaid" value="<?php echo $ideaid ?>">
                            <input type="hidden" name="commenterid" value="<?php echo $staffid ?>">

<?php
    


?>                            
             
                         <textarea name="txtarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...." required></textarea>
                                                                            </div>
                                                                        </div>
                                                                     

                                                                        <div class="col-4" style="margin-top: 12px;">
                                                    <input class="btn btn-primary" type="submit" value="Add Comment" name="BtnPost">

                                                                        </div>
                                                                    </div>

                                                    </div>
                                                    <hr>  

<?php   

    } //end of idea count condition
?>


                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
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


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Designed &amp; Developed by <a href="#" target="_blank">STA/TPH/ZHHO</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    

</body>

</html>