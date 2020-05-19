<?php 
include("includes/connection.php");
$query="SELECT * FROM product,category,sub_cat
         where product.cat_id=category.cat_id
         and category.cat_id=sub_cat.cat_id
        AND product.pro_id={$_GET['id']}";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $id=$_POST['pro_id'];
    $name=$_POST['pro_name'];
    $price=$_POST['price'];
    $image=$_POST['proImg'];
    $desc=$_POST['pro_desc'];
    $cat=$_POST['cat'];
    $sub=$_POST['sub'];
    $author=$_POST['author'];
    $state=$_POST['state'];
    $error=$_FILES['image']['error'];
    if (!$error) {
        $query="SELECT cat_name FROM category WHERE cat_id='$cat'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        $image=uniqid();
        $tmp_name=$_FILES['image']['tmp_name'];
        $path="uploads/category/".$row['cat_name']."/".$image;
        move_uploaded_file($tmp_name, $path);
        // unlink($image_cat);
    }else
    {
        $Image=$image_cat;
    }
    $query="UPDATE product SET  pro_name  ='$name',
                                author    ='$author',
                                pro_price ='$price',
                                pro_img   ='$image',
                                pro_desc  ='$desc',
                                state     ='$state',
                                cat_id    ='$cat',
                                sub_id    ='$sub'
                          WHERE pro_id    ='$id'"; 
    mysqli_query($conn,$query); 
    header('location:manage_product.php');
}

?>



<?php include("includes/header.php")?> 
<div class="main-content-inner">
    <div class="col-lg-6 col-ml-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title text-center"> Edit Product</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                           <div class="form-group">
                            <!-- <label >Product id</label> -->
                            <input type="hidden" class="form-control" name="pro_id"  required  value="<?php echo $row['pro_id'] ?>">
                        </div>
                        <div class="form-group">
                            <label >Product Name</label>
                            <input type="text" class="form-control" name="pro_name" autocomplete="off" required placeholder="Enter Product Name" value="<?php echo $row['pro_name'] ?>">
                        </div>
                         <div class="form-group">
                            <label >Author Name</label>
                            <input type="text" class="form-control" name="author" autocomplete="off" required placeholder="Enter Product Name" value="<?php echo $row['author'] ?>">
                        </div>
                        <div class="form-group">
                            <label >Price</label>
                            <input type="text" class="form-control" name="price" autocomplete="off" required placeholder="Product Price" value="<?php echo $row['pro_price'] ?>">
                        </div>
                        <div class="form-group ">
                            <label  class="control-label mb-1">Image Poduct</label>
                            <input id="cc-name" name="image" type="file" class="form-control cc-name valid" >
                            <input id="cc-name" name="proImg" type="hidden" class="form-control cc-name valid"  value="<?php echo $row['pro_img'] ?>" >

                        </div>
                        <div class="form-group">
                            <label >Description</label>
                            <textarea type="text" class="form-control" name="pro_desc" autocomplete="off" required placeholder="Product Description">
                                <?php echo $row['pro_desc'] ?>
                            </textarea>
                          
                        </div>
                        <div class="form-group">
                         <div class="form-group has-success">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="cc-name" class="control-label mb-1">Category Name</label>
                                    <select id="catId" required style="padding:10px;" class="form-control" name="cat" >
                                        <option selected value="<?php echo $row['cat_id'] ?>"> <?php echo $row['cat_name'] ?></option>
                                        <?php  
                                        $query="SELECT * FROM category";
                                        $result=mysqli_query($conn,$query);
                                        while ($cat=mysqli_fetch_assoc($result))
                                            { ?>
                                                <option value='<?php echo $cat['cat_id'] ?>'><?php echo $cat['cat_name']?>
                                                
                                            </option>
                                        <?php } ?>
                                        ?>
                                    </select>  
                                    <div class="col-lg-6">
                                    <label for="cc-name" class="control-label mb-1 mt-3">SubCategory Name</label>
                                    <select id="names" required style="padding:10px;" class="form-control" name="sub" >
                                        <option selected value="<?php echo $row['sub_id'] ?>"> <?php echo $row['sub_name'] ?></option>
                                        <?php  
                                        $query="SELECT * FROM sub_cat where cat_id={$row['cat_id']}";
                                        $result=mysqli_query($conn,$query);
                                        while ($cat=mysqli_fetch_assoc($result))
                                            { ?>
                                                <option value='<?php echo $cat['sub_id'] ?>'><?php echo $cat['sub_name']?>
                                                
                                            </option>
                                        <?php } ?>
                                        ?>
                                    </select>  
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="cc-name" class="control-label mb-1">State Product</label>
                                    <select id="State" required style="padding:10px;" class="form-control" name="state">
                                        <option selected disabled value="<?php echo $row['state']?>">
                                            <?php 
                                            if ($row['state']) {
                                                echo "On";
                                            }else
                                            {
                                                echo "Off";
                                            }
                                            ?>
                                        </option>
                                        <option value="1">
                                            On
                                        </option>
                                        <option value="0">
                                            Off
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- basic form end -->
</div>
<?php include("includes/footer.php")?> 

<script type="text/javascript">
            $(document).ready(function()
            {
                $("#catId").change(function()
                {
                    //get selected parent option 
                    var catId = $("#catId").val();              
                    //alert(admin_id);
                    $.ajax(
                            {
                                type: "GET",
                                url: "names2.php?catId="+catId,
                                success: function(data)
                                {                                    
                                    $("#names").html(data);                                    
                                }
                            });
                });

            });
        </script>
