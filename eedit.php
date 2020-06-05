<?php
session_start();
include "header.php";
include "include/conn.inc.php";

if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true &&$_SESSION['role']==1) {
    
} else {
    echo ("<script> alert('Sorry !!Panda say you are not allowed! '); </script>");
    echo ("<script> window.location.replace('sad.php');</script>");}
if(isset($_POST['edit'])){
 
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="css/style-emp-panel.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php cssAndBootstrap(); ?>
    <title>Employee Profile | Home Furniture</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link href="css/style-cprofile.css" rel="stylesheet" type="text/css" />
    <title>Profile | Home Furniture</title>
    <script type="text/javascript">
        // When the user clicks on div, open the popup
        function myFunction1() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
        // Get the modal
        var modal = document.getElementById('id001');

        var modal = document.getElementById('id002');

        var modal = document.getElementById('id003');


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <?php

    include "include/conn.inc.php";

    $id = mysqli_real_escape_string($conn,$_POST['eid']);

    $sql = "SELECT * FROM employee WHERE emp_id = '$id' ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        
        $name = $row['emp_name'];
        $phone = $row['emp_phone'];
        $email = $row['emp_email'];
        $address = $row['emp_address'];
        $gender = $row['emp_gender'];
        $photo = $row['emp_img'];
        $position=$row['emp_position'];
        $img='eimg/'.$photo;
    }

    ?>


    <h2 class="profile-title">my profile</h2>
    <center>
        <div class="ctn">
            <div class="card">
                <img src="<?php echo $img; ?>" style="width:94%;max-height:400px;margin:8px 8px 0px 8px" alt="" />
                <h1><?php echo $name; ?></h1>
                <h1><?php echo $position; ?></h1>
                
                <a onclick="document.getElementById('id001').style.display='block'"><button>Edit password</button></a>
              
            </div>

            <div id="id001" class="modal">
                <form method="post" action="echange.php" class="modal-content pro-form" style="text-align:left;">
                    <span onclick="document.getElementById('id001').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <div class="content">
                        <br />
                        <input type="number" name="id" id="id" value="<?php echo $id?>"  hidden/>
                        <h3>CHANGE PASSWORD</h3><br />
                        New Password:<br />
                        <input type="password" name="newPassword" required /><br />

                        Confirm Password:<br />
                        <input type="password" name="confirmPassword" required /><br /><br />

                        <input type="submit" value="Change Password" name="submit1"/>
                    </div>
                </form>
            </div>


            <div class="detail">
                <center>
                    <form class="pro-form">
                        <table style="text-align:left;margin-left:20px">
                            <tr>
                                <th width="200px">ID</th>
                                <td>
                                    <input type="text" value="<?php echo $id; ?>" name="id" readonly="readonly" />
                                </td>
                            </tr>

                            <tr>
                                <th>Name:</th>
                                <td width="300px">
                                    <input type="text" name="name" value="<?php echo $name ?>" readonly />
                                </td>
                            </tr>

                            <tr>
                                <th>Phone Number:</th>
                                <td>
                                    <input type="text" name="phone" value="<?php echo $phone ?>" readonly />
                                </td>
                            </tr>

                            <tr>
                                <th>Email Address:</th>
                                <td>
                                    <input type="email" name="email" value="<?php echo $email ?>" readonly />
                                </td>
                            </tr>

                            <tr>
                                <th>Home Address:</th>
                                <td>
                                    <textarea name="home_address" readonly class="wt-resize"><?php echo $address ?></textarea>
                                </td>
                            </tr>


                            <tr>
                                <th>Gender:</th>
                                <td>
                                    <input type="text" name="gender" value="<?php echo $gender ?>" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <br />
                                    <center></center>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <a onclick="document.getElementById('id003').style.display='block'"><button>Edit information</button></a>

                    <div id="id003" class="modal">
                        <form method="post" action="include/employee.inc.php" class="pro-form">
                            <span onclick="document.getElementById('id003').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <p hidden><input type="text" value="<?php echo $id; ?>" name="id" /></p>
                            <table style="text-align:left">
                                <tr>
                                    <th>Name:</th>
                                    <td width="300px">
                                        <input type="text" name="name" value="<?php echo $name ?>" required />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Phone Number:</th>
                                    <td>
                                        <input type="text" name="phone" value="<?php echo $phone ?>" required />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Email Address:</th>
                                    <td>
                                        <input type="email" name="email" value="<?php echo $email ?>" required />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Home Address:</th>
                                    <td>
                                        <textarea name="address" required class="wt-resize"><?php echo $address ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Position:</th>
                                    <td>
                                        <select name="position"><option value="manager">Manager</option><option value="employee">Employee</option></select>
                                    </td>
                                </tr>

                               
                                <tr>
                                    <td colspan="2">
                                        <br />
                                        <center>
                                            <input type="submit" value="Change" name="update" id="update"/>&nbsp; &nbsp;
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </center>
</body>

</html>

<?php
}

if (isset($_POST['delete'])) {
    $eid = mysqli_real_escape_string($conn, $_POST['eid']);
    $ename = mysqli_real_escape_string($conn, $_POST['ename']);
    $sql = "DELETE FROM employee WHERE emp_id= '$eid' ";
    if (mysqli_query($conn, $sql)) {
        echo ("<script> alert('$ename Deleted!'); </script>");
        echo ("<script> window.location.replace('nemployee.php');</script>");
    } else {
        echo ("<script> alert('Sorry this employee cannot be deleted!'); </script>");
        echo ("<script> window.location.replace('nemployee.php');</script>");
    }
}

?>