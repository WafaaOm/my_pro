<?php
include('partials/menu.php');
?>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql2="SELECT * FROM tbl_food WHERE id=$id ";
    $res2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($res2);
    $title=$row2['title'];
    $discreption=$row2['discreption'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $feature=$row2['feature'];
    $active=$row2['active'];
}
else{
    header('location:'.SITURAL.'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="discreption" cols="30" rows="5"><?php echo $discreption;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image==""){
                            echo "<div style='color:red;'>Image Not Available.</div>";
                        }
                        else{
                            ?>
                            <img src="<?php echo SITURAL;?>images/food/<?php echo $current_image;?>" width="150px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php
                            $sql=" SELECT * FROM tbl_category WHERE active='Yes'";
                            $res=mysqli_query($conn,$sql);
                            $count=mysqli_num_rows($res);
                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "Selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                    <?php
                                }
                            }
                            else{
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                            ?>
                            <option value="0">Test Category</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Fatured:</td>
                    <td>
                        <input <?php if($feature=="Yes"){echo "checked";}?> type="radio" name="feature" value="Yes">Yes
                        <input <?php if($feature=="No"){echo "checked";} ?>type="radio" name="feature" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $id=$_POST['id'];
            $title=$_POST['title'];
            $discreption=$_POST['discreption'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category_id=$_POST['category_id'];
            $feature=$_POST['feature'];
            $active=$_POST['active'];
            if(isset($_FILES['image_name']['name'])){
                $image_name=$_FILES['image_name']['name'];
                if($image_name!=""){
                    $ext=end(explode('.',$image_name));
                    $image_name="Food_Name_".rand(000,999).'.'.$ext;
                    $src_path=$_FILES['image_name']['tmp_name'];
                    $dst_path="../images/food/".$image_name;
                    $upload=move_uploaded_file($src_path,$dst_path);
                    if($upload==false){
                        $_SESSION['upload']="<div style='color:red;'>Failed To Upload New Image.</div>";
                        header('location:'.SITURAL.'admin/manage-food.php');
                        die();
                    }
                    if($current_image!=""){
                        $remove_path="../images/food/".$current_image;
                        $remove=unlink($remove_path);
                        if($remove==false){
                            $_SESSION['remove-failed']="<div style='color:red;'>Failed To Remove Current Image.</div>";
                            header('location:'.SITURAL.'admin/manage-food.php');
                            die();
                        }
                    }
                }
            }
            else{
                $image_name=$current_image;
            }
            $sql3="UPDATE tbl_food SET
            title='$title',
            discreption='$discreption',
            price=$price,
            image_name='$image_name',
            category_id='$category_id',
            feature='$feature',
            active='$active'
            WHERE id=$id";
            $res3=mysqli_query($conn,$sql3);
            if($res3==true){
                $_SESSION['update']="<div style='color:green;'>Food Updated Successfully.</div>";
                header('location:'.SITURAL.'admin/manage-food.php');

            }
            else{
                $_SESSION['update']="<div style='color:red;'>Failed To Updated Food.</div>";
                header('location:'.SITURAL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php
include('partials/footer.php');
?>