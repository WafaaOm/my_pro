<?php
include('partials/menu.php');
?>
    <!--Main Content Sections Starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
            if(isset($_SESSION['change-bwd'])){
                echo $_SESSION['change-bwd'];
                unset($_SESSION['change-bwd']);
            }
            ?>
            <br><br><br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql="SELECT * FROM tbl_admin";
                $res=mysqli_query($conn,$sql);
                if($res==TRUE){
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $fullname=$rows['fullname'];
                            $username=$rows['username'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php  echo $fullname; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITURAL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary" >Change Password</a>
                                    <a href="<?php echo SITURAL; ?>admin/updat-admin.php?id=<?php echo $id;?>" class="btn-secondary">Ubdate Admin</a>
                                    <a href="<?php echo SITURAL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {

                    }
                }
                ?>

               
            </table>

            
        </div>
    </div>
    <!--Main Content Sections Ends-->
    
   <?php
   include('partials/footer.php');
   ?>