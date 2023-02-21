<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title Of The Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="discreption" cols="30" rows="5" placeholder="Description Of The Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            $res=mysqli_query($conn,$sql);
                            $count=mysqli_num_rows($res);
                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <option value="0">No Category Found</option> 
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" value="Yes">Yes
                        <input type="radio" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" value="Yes">Yes
                        <input type="radio" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $title=$_POST['title'];
            $discreption=$_POST['discreption'];
            $price=$_POST['price'];
            $category_id=$_POST['category_id'];
            if(isset($_POST['feature'])){
                $feature=$_POST['feature'];
            }
            else{
                $feature="Yes";
            }
            if(isset($_POST['active'])){
                $active=$_POST['active'];
            }
            else{
                $active="Yes";
            }
            if(isset(($_FILES['image_name']['name']))){
                $image_name=$_FILES['image_name']['name'];
                if($image_name!=""){
                    $ext=end(explode('.',$image_name));
                    $image_name="Food_Name_".rand(000,999).".".$ext;
                    $src=$_FILES['image_name']['tmp_name'];
                    $dst="../images/food/".$image_name;
                    $upload=move_uploaded_file($src,$dst);
                    if($upload==false){
                        $_SESSION['upload']="<div style='color:red;'>Failed To Upload Image.</div>";
                        header('location:'.SITURAL.'admin/add-food.php');
                        die();
                    }
                }
            }
            else{
                $image_name="";
            }
            $sql2="INSERT INTO tbl_food SET 
            title='$title',
            discreption='$discreption',
            price='$price',
            image_name='$image_name',
            category_id='$category_id',
            feature='$feature',
            active='$active'";
            $res2=mysqli_query($conn,$sql2);
            if($res2==true){
                $_SESSION['add']="<div style='color:green;'>Food Add Successfully.</div>";
                header('location:'.SITURAL.'admin/manage-food.php');
            }
            else{
                $_SESSION['add']="<div style='color:red;'>Failed To Added Food.</div>";
                header('location:'.SITURAL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php
include('partials/footer.php');
?>