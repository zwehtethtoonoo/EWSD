<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Newsfeed </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">
<!-- add font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Add css  -->
    <link href="./css/style.css" rel="stylesheet">


<!-- Add script -->


<!-- add jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

    <?php 

    include("inc/header.php");
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
    $staffid="";
 }
}

// btn function 

if (isset($_POST['BtnPost'])) {

        $staffid=$_SESSION['staffid'];
        $ideaid=$_POST['ideaid'];
        $txttextarea=$_POST['txttextarea'];
        $rdovisibility=$_POST['rdovisibility'];
        $timestamp=date('Y-m-d H:i:s');
        $cate=$_POST['opCategory'];


 // finding path for filetype 

    $path = 'E:\xampp\htdocs\EWSD\ '.$filename1;
    $extension = pathinfo($path, PATHINFO_EXTENSION);

        // Copying inserted file to images\ideas

        $image1=$_FILES['filename1']['name'];
                
         $folder="images/ideas/";
        if ($image1) 
        {
            $filename1=$folder.$image1;
            $copied=copy($_FILES['filename1']['tmp_name'],$filename1);
             if (!$copied) 
            {
                exit("Problem occured and cannot upload image.");
            }
        }

      
   
 $result=mysqli_query($connection,"INSERT INTO tblidea (ideaid,idea_detail,staffid,categoryid,idea_date,file,filetype,visibility) VALUES ('$ideaid','$txttextarea','$staffid','$cate','$timestamp','$filename1','$extension','$rdovisibility')");

        if($result) //True
        {
        echo "<script>window.alert('Idea Successfully added!')</script>";
        echo "<script>window.location='news_feed.php'</script>";
        }
        else
        {
        echo "<p>Something went wrong in Idea entry!  " . mysqli_error($connection) . "</p>";
        }
        

}


if (isset($_POST['action'])) {
    $idea_id=$_POST['idea_id'];
    $action=$_POST['action'];
    $time=date('Y-m-d H:i:s');
    $staffid=$_SESSION['staffid'];



    switch ($action) {
        case 'like':
            $sql="INSERT INTO tblrating (ideaid,responderid,react_date,rating)
                    VALUES ('$idea_id','$staffid','$time','$action')
                    ON DUPLICATE KEY UPDATE rating='like'";
            break;

        case 'unlike':
            $sql="INSERT INTO tblrating (ideaid,responderid,react_date,rating)
                    VALUES ('$idea_id','$staffid','$time','$action')
                    ON DUPLICATE KEY UPDATE rating='unlike'";
            break;

        case 'dislike':
            $sql="DELETE FROM tblrating WHERE responderid='$staffid' AND ideaid='$idea_id'";
            break;

        case 'undislike':
            $sql="DELETE FROM tblrating WHERE responderid='$staffid' AND ideaid='$idea_id'";
            break;

        default:
            break;
    }
    //execute query
    mysqli_query($connection,$sql);
    exit();


} else {
        echo "<p>Something went wrong in addding rating!  " . mysqli_error($connection) . "</p>";
}


 ?>

</head>

<body>

<script type="text/javascript">

 

$(document).ready(function(){ 

    $('.like_btn').on('click',function(){
         
        var idea_id = $(this).data('id');

        clicked_btn = $(this);

        if (clicked_btn.hasClass('fa-thumbs-o-up')) {
            action = 'like';

        } else if (clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }

let formData =  new FormData()
formData.append('idea_id',idea_id)
formData.append('action', action)

    $.ajax({
        url: 'news_feed.php',
        type:  'POST',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,

        success: function(data){

        if (action == "like") {
            clicked_btn.removeClass('fa-thumbs-o-up');
            clicked_btn.addClass('fa-thumbs-up');
        } else if(action == "unlike") {
            clicked_btn.removeClass('fa-thumbs-up');
            clicked_btn.addClass('fa-thumbs-o-up');
        }


        },
        error: function(){
            alert('error')
        }

    })

})

})


     

</script>
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
                                    <li><a href="./news_feed.php">Newsfeed</a></li>
                          </li>


                        <?php   
                    } 

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


                        <?php   
                    } 
    
                            
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
        <div class="content-body">
            <div class="container-fluid">
                <div class="Hi, welcome back!">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                        </ol>
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
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link active show">Posts</a>
                                            </li>
                                            <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">About Me</a>
                                            </li>
                                            <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade active show">
                                                <div class="my-post-content pt-3">
                                                    <div class="tag-radio">
                                                        <div class="form-group">

<form action="news_feed.php" method="POST" enctype="multipart/form-data">
                                                        <label><h4>Create Idea</h4></label>
                                                        <select name="opCategory" class="form-control" >

                                                <?php 
                                                   
                                                    $sqll="SELECT * FROM tblcategory WHERE enddate > now();";
                                                    $que=mysqli_query($connection,$sqll);
                                                    $now= date('Y-m-d');
                                                    $enddate=$row['enddate'];
                                                    $countt=mysqli_num_rows($que);


        if (empty($countt)) {
   // if category enddate for idea upload is over
                                            
                                                    echo "<option value=''>No New Category</option>";
                                                        
        }   

        // if enddate is not over
        elseif (!empty($countt)) {
                 
                for ($i=0; $i<$countt; $i++){
                                                    $roww=mysqli_fetch_array($que);
                                                    $cateid=$roww['categoryid'];
                                                    $name=$roww['name'];
                                                    echo "<option value='$cateid'>$cateid / $name</option>";

                                         
                                             
                                           
                                        
        }
    }


                                                    


                                                ?>
                                                         </select> 
                                        </div>
                                                    </div>
                                     <input type="hidden" name="ideaid" value="<?php echo AutoID('tblidea','ideaid','Idea-',5);?>">
                                                    <div class="post-input">
                                                        <textarea name="txttextarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please share any idea you have...." required></textarea> 


<!-- style for label-->

 <style type="text/css" scoped>
        label.label-radio {
    color: black;
    margin-left: 3px;
    margin-right: 25px;

       }
    </style>    

                         <input type="radio" name="rdovisibility" value="yes" checked /> <label class="label-radio">Public </label>
                        <input type="radio"  name="rdovisibility" value="no" /> <label class="label-radio">Anyonymous </label>
                                                    </div>                                      
                                                     <div class="post-input">
                                                        <input type="file" name="filename1" value="Upload File" required>
                                                    </div>
                                                        <style type="text/css"> .btnsub {
                                                            margin-bottom:10px ;
                                                        } </style>
                                                    <div class="btnsub">
                                                    <input class="btn btn-primary" type="submit"  name="BtnPost">

                                                    </div>

  <!-- close form of idea upload -->    </form> 


                                                                    <hr>

                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <label><h1>Newsfeed</h1></label>
<style type="text/css">
/* Dropdown Button */
.dropbtn {
  background-color: #132495;
  border-radius: 5px;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: absolute;
  right: 10px;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

</style>

<script type="text/javascript">
    /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>                                                        
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Filter</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="news_feed.php?ft=MP">Most Popular</a>
    <a href="news_feed.php?ft=MCM">Most Comment</a>
    <a href="news_feed.php?ft=LI">Latest Idea</a>
    <a href="news_feed.php?ft=LCM">Latest Comment</a>
  </div>
</div>
                                                        



<!--           image                                       <img src="images/profile/8.jpg" alt="" class="img-fluid"> -->                                                        

    <?php 



            $sqll="SELECT * FROM tbldepartment";
            $que=mysqli_query($connection,$sqll);
            $deprow=mysqli_fetch_array($que);
                                                $idea_select="SELECT i.*,s.name
                                            FROM tblidea i,tblstaff s 
                                            WHERE i.staffid=s.staffid
                                            ORDER BY i.idea_date DESC
                                            LIMIT 5";

    if($_GET['ft']) {
                

                        switch ($_GET['ft']) {
                            case 'MP':
                            
                            // Count the idea react not yet

                                $idea_select="SELECT i.*,s.name
                                            FROM tblidea i,tblstaff s 
                                            WHERE i.staffid=s.staffid
                                            ORDER BY i.idea_date DESC
                                            LIMIT 5";

                                    break;

                            case 'MCM':

                            // Count the comments of idea Done

                                $idea_select="SELECT i.*,s.name, c.*, COUNT(*) 
                                FROM tblidea i, tblcomment c, tblstaff s
                                WHERE i.ideaid=c.ideaid
                                AND i.staffid=s.staffid 
                                GROUP BY c.ideaid HAVING COUNT(*) > 0 
                                ORDER BY COUNT(*) DESC
                                LIMIT 5;
                                            ";

                                    break;  

                            case 'LI':

                            // Latest idea Done

                                $idea_select="SELECT i.*,s.name
                                            FROM tblidea i,tblstaff s 
                                            WHERE i.staffid=s.staffid
                                            ORDER BY i.idea_date DESC
                                            LIMIT 5";
                                    break;    
                            
                            case 'LCM':
                            
                            // latest comment of idea Not

                                $idea_select="SELECT i.*,s.name, c.commentdate
                                FROM tblidea i, tblcomment c, tblstaff s
                                WHERE i.ideaid=c.ideaid
                                AND i.staffid=s.staffid 
                                GROUP BY c.ideaid 
                                ORDER BY c.commentdate DESC
                                LIMIT 5;
                        ";
                                    break;    
                            

                        }
                }         

    
    $idea_ret=mysqli_query($connection,$idea_select);
    $idea_count=mysqli_num_rows($idea_ret);

    for($i=0; $i < $idea_count; $i++)  { 
// poster connection   
    $idea_row=mysqli_fetch_array($idea_ret);

    $posterid=$idea_row['staffid'];
    $ideaid=$idea_row['ideaid'];
    $postername=$idea_row['name'];

    $postdate=$idea_row['idea_date'];
    $ideaPost=$idea_row['idea_detail'];
    $ideavisibility=$idea_row['visibility'];
    
    $comres=mysqli_query($connection,"SELECT * FROM tblcomment WHERE ideaid='$ideaid'");
                                                        
    

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
                                                            <h3 style="padding-top:10px; "><?php echo $deprow['name'];?> Department</h3>
                                                            <h4 style="padding-top:5px; padding-bottom:5px;"><?php echo $posterid ;
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
                                                        <p>

    <?php        

//like count with function


    // $ratfind="SELECT i.ideaid,i.categoryid,sum(r.voting) AS 'Votes' 
    //         FROM tblidea i, tblrating r 
    //         WHERE i.ideaid=$ideaid AND i.ideaid=r.ideaid;";
    // $rating_q=mysqli_query($connection,$ratfind); 

    // $r_row=mysqli_fetch_array($rating_q);
    // $votes=$r_row['Votes'];
    //  echo $votes ."Likes";

    ?>                                                  </p>

<style type="text/css">
        a.acolor {
            color: white;
        }                                                            


    i.like_btn{
        margin-left: 10px; margin-right: 10px;  font-size: 25px;
    }

    i.dislike_btn {
        margin-left: 10px; margin-right: 10px;  font-size: 25px;
    }


</style>




                                        <i class="fa fa-thumbs-o-up like_btn" data-id="<?php echo $idea_row['ideaid'] ?>"></i>
                                        <i class="fa fa-thumbs-o-down dislike_btn" data-id="<?php echo $idea_row['ideaid'] ?>"></i>


<?php 
        $finalq=mysqli_query($connection,"SELECT finalenddate
                                FROM tblcategory c, tblidea i 
                                WHERE i.ideaid='$ideaid'
                                AND i.categoryid=c.categoryid
                                AND c.finalenddate > now();");
        $finalROW=mysqli_num_rows($finalq);
        if (empty($finalROW)) {

       echo" <hr>";


    }   elseif (!empty($finalROW)) {

?>
     <button class="btn btn-secondary" id="Btncmt"><a href="idea_details.php?ideaid=<?php echo  $ideaid; ?>" class="mr-4 acolor" title="LINK" >
                                                        Give comment             
                                                        </a></button>
                                                                      <hr>

<?php 
        }   // end of elseif


?>






                                       
                                                  
    <?php 

// Comment Count 
        $ideaid=$idea_row['ideaid'];
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


                                                                   
                                                                         
                                                    </div>
                                                    <hr>  

<?php   

    } //end of idea count condition
?>


<!--                                                     <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <img src="images/profile/10.jpg" alt="" class="img-fluid">
                                                        <a class="post-title" href="javascript:void()">
                                                            <h4>History Department</h4>
                                                        </a>
                                                        <p>Feed back for History Department.</p>
                                                        <button class="btn btn-primary mr-3"><span class="mr-3"><i
                                                                    class="fa fa-like"></i></span>Like</button>
                                                        <button class="btn btn-secondary"><span class="mr-3"><i
                                                                    class="fa fa-reply"></i></span>Comment</button>
                                                    </div>
                                                    <hr>
                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-8">
                                                                            <div class="post-input">
                                                                                <textarea name="textarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4" style="margin-top: 12px;">
                                                                            <button class="btn btn-secondary"><span class="mr-3"></span>Add Comment</button>
                                                                        </div>
                                                                    </div>
                                                
                                                                
                                                                    <div class="container">
                                                                        <div class="row" style="margin-top: 10px;">
                                                
                                                                            <div class="col-7">
                                                                                <h4 style="color: black;">Commenter</h4>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <h5>5 hours ago</h5>
                                                                            </div>
                                                                        </div>
                                                
                                                                        <p>
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat quam aut sequi, dolore,
                                                                            sapiente quo sit voluptatem fuga ab magni soluta cumque odit impedit atque asperiores quod
                                                                            natus iure. Vero.
                                                                        </p>
                                                                    </div>            
                                                    </div>
                                                    <hr>  
                                                    <div class="profile-uoloaded-post pb-5">
                                                        <img src="images/profile/11.jpg" alt="" class="img-fluid">
                                                        <a class="post-title" href="javascript:void()">
                                                            <h4>Law Department</h4>
                                                        </a>
                                                        <p>Feed back for Law Department.</p>
                                                        <button class="btn btn-primary mr-3"><span class="mr-3"><i
                                                                    class="fa fa-like"></i></span>Like</button>
                                                        <button class="btn btn-secondary"><span class="mr-3"><i
                                                                    class="fa fa-reply"></i></span>Comment</button>
                                                                    <hr>
                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-8">
                                                                            <div class="post-input">
                                                                                <textarea name="textarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4" style="margin-top: 12px;">
                                                                            <button class="btn btn-secondary"><span class="mr-3"></span>Add Comment</button>
                                                                        </div>
                                                                    </div>
                                                
                                                                
                                                                    <div class="container">
                                                                        <div class="row" style="margin-top: 10px;">
                                                
                                                                            <div class="col-7">
                                                                                <h4 style="color: black;">Commenter</h4>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <h5>5 hours ago</h5>
                                                                            </div>
                                                                        </div>
                                                
                                                                        <p>
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat quam aut sequi, dolore,
                                                                            sapiente quo sit voluptatem fuga ab magni soluta cumque odit impedit atque asperiores quod
                                                                            natus iure. Vero.
                                                                        </p>
                                                                    </div>            
                                                    </div>
                                                    <hr>               
                                                    </div>
                                                    
                                                    <div class="text-center mb-2"><a href="javascript:void()" class="btn btn-primary">Load More</a>
                                                    </div> -->
                                       <!--      </div>

                                            <div id="about-me" class="tab-pane fade">
                                                <div class="profile-about-me">
                                                    <div class="pt-4 border-bottom-1 pb-4">
                                                        <h4 class="text-primary">About Me</h4>
                                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the
                                                            bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                                                        <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed
                                                            in a nice, gilded frame.</p>
                                                    </div>
                                                </div>
                                                <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                                    <h4 class="text-primary mb-4">Skills</h4>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Admin</a>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Dashboard</a>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Photoshop</a>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Bootstrap</a>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Responsive</a>
                                                    <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Crypto</a>
                                                </div>
                                                <div class="profile-lang pt-5 border-bottom-1 pb-5">
                                                    <h4 class="text-primary mb-4">Language</h4><a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                            class="flag-icon flag-icon-us"></i> English</a> <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                            class="flag-icon flag-icon-fr"></i> French</a>
                                                    <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                            class="flag-icon flag-icon-bd"></i> Bangla</a>
                                                </div>
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-9"><span>Mitchell C.Shay</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-9"><span>example@examplel.com</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Availability <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-9"><span>Full Time (Free Lancer)</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Age <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-9"><span>27</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Location <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-9"><span>Rosemont Avenue Melbourne,
                                                                Florida</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <h5 class="f-w-500">Year Experience <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-9"><span>07 Year Experiences</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="profile-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Account Setting</h4>
                                                        <form>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email" placeholder="Email" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Password</label>
                                                                    <input type="password" placeholder="Password" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" placeholder="1234 Main St" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address 2</label>
                                                                <input type="text" placeholder="Apartment, studio, or floor" class="form-control">
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>City</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label>State</label>
                                                                    <select class="form-control" id="inputState">
                                                                        <option selected="">Choose...</option>
                                                                        <option>Option 1</option>
                                                                        <option>Option 2</option>
                                                                        <option>Option 3</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label>Zip</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="gridCheck">
                                                                    <label for="gridCheck" class="form-check-label">Check me out</label>
                                                                </div>
                                                            </div>
                                                             <button class="btn btn-primary" >Sign
                                                                in</button>
 -->
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