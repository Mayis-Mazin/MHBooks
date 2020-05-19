 <?php 
 require("includes/connection.php");
 if (isset($_POST['submit'])){
    $pro_name=$_POST['pro_name'];
    $author=$_POST['author'];
    $price=$_POST['price'];
    $desc=$_POST['pro_desc'];
    $cat_id=$_POST['cat'];
    $subCat=$_POST['names'];
    $image_name=uniqid();
    $tmp_name=$_FILES['image']['tmp_name'];
    $que="SELECT cat_name from category where cat_id='$cat_id'";
    $res=mysqli_query($conn,$que);
    $cat=mysqli_fetch_assoc($res);
    $cat_name=$cat['cat_name'];
    $pathImage= "uploads/category/".$cat_name."/".$image_name;
    move_uploaded_file($tmp_name, $pathImage);
    $query="INSERT INTO product(pro_name,author,pro_price,pro_img,pro_desc,state,cat_id,sub_id)
            VALUES('$pro_name','$author','$price','$image_name','$desc','1',$cat_id,$subCat)";

    mysqli_query($conn,$query); 
    header('location:manage_product.php');
}

if (isset($_GET['d_id'])) {
    $id=$_GET['d_id'];
    $query="DELETE FROM product WHERE pro_id='$id'";
    mysqli_query($conn,$query);
    header("location:manage_product.php");
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
                        <h4 class="header-title text-center"> Add Product</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label >Product Name</label>
                                <input type="text" class="form-control" name="pro_name" autocomplete="off" required placeholder="Enter Product Name">
                            </div>
                             <div class="form-group">
                                <label >Author Name</label>
                                <input type="text" class="form-control" name="author" autocomplete="off" required placeholder="Enter Author Name">
                            </div>
                            <div class="form-group">
                                <label >Price</label>
                                <input type="text" class="form-control" name="price" autocomplete="off" required placeholder="Product Price">
                            </div>
                            <div class="form-group ">
                                <label  class="control-label mb-1">Image Poduct</label>
                                <input id="cc-name" name="image" type="file" required class="form-control cc-name valid" >
                            </div>
                            <div class="form-group">
                                <label >Description</label>
                                <input type="text" class="form-control" name="pro_desc" autocomplete="off" required placeholder="Product Description">
                            </div>
                            <div class="form-group">
                               <div class="form-group has-success">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="cc-name" class="control-label mb-1">Category Name</label>
                                        <select id="catId" class="form-control p-1" name="cat" required>
                                            <option value="">Choose....</option>
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
                                    </div> 
                                    <div class="col-md-6" id="sel">
                                        <label for="cc-name" class="control-label mb-1">SubCategory Name</label>
                                        <select id="names" name="names" required class="form-control p-1">
                                                                  
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
    <!-- order list area start -->
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="header-title text-center mb-4">Product Information</h4>
            <div class="table">
                <table class="table text-center">
                    <tbody>
                        <tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
                            <td>ID</td>
                            <td>Name</td>
                            <td>Author</td>
                            <td>Price</td>
                            <td>Image</td>
                            <td>Description</td>
                            <td>category name</td>
                            <td>SubCategory name</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        <?php
                        $query="SELECT * FROM product INNER JOIN category 
                                        ON category.cat_id=product.cat_id 
                                        ORDER BY pro_id ";
                        $result=mysqli_query($conn,$query);
                        foreach ($result as $key => $value) { ?>
                            <tr>
                                <form method="post">
                                    <td><?php echo $value['pro_id']?></td>
                                    <td><?php echo $value['pro_name']?></td>
                                    <td><?php echo $value['author']?></td>
                                    <td>$<?php echo $value['pro_price']?></td>
                                    <td><img style="width:100px; height:100px" src="uploads/category/<?php echo $value['cat_name']."/". $value['pro_img']?>"></td>
                                    <td><p style="width: 130px;">
                                        <?php $text= $value['pro_desc'];
                                           $pieces =substr($text, 0, 40);
                                           echo $pieces."   ....Elc";
                                         ?>
                                        </p></td>
                                    <td><?php echo $value['cat_name']?></td>
                                    <td><?php echo $value['sub_id']?></td>
                                    <td>
                                        <a href="edit_pro.php?id=<?php echo $value['pro_id']?>" class="btn btn-info">Edit
                                        </td>
                                        <td>
                                            <input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['pro_id']?>)" name="Delete" value="Delete">
                                        </td>
                                    </form>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php")?> 

        <script language="javascript">
           function deleted(dil) {
            if (confirm("Do you want to delete")) {
                window.location.href='manage_product.php?d_id='+dil+'';
                return true;
            }
        }
    </script>
    <script type="text/javascript">
            $(document).ready(function()
            {
                $("#sel").hide();
                $("#catId").change(function()
                {
                $("#sel").show();

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

