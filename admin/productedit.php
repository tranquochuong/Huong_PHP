<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>

<?php 
	$product = new product();

    if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
        echo "<script>window.location = 'productlist.php' </script>";
    } else {
        $id = $_GET['productId'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // $productName = $_POST['productName'];
        // $category = $_POST['productName'];
        // $brand = $_POST['brand'];
        // $productdesc = $_POST['productdesc'];
        // $price = $_POST['price'];
        // $type = $_POST['type'];
    
        $editProduct = $product -> edit_Product($_POST,$_FILES, $id);
    }
    
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
        <?php 
                    if(isset($editProduct)) {
                        echo $editProduct;
                    }
                ?>
                <?php
                    $get_product_by_id = $product ->getproductbyId($id);
                        if($get_product_by_id) {
                            while($result_product = $get_product_by_id -> fetch_assoc()){
                ?>
            <!-- enctype="multipart/form-data"  khi thêm hình ảnh phải có-->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" style="width: 50%" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Danh mục</label>
                        </td>
                        <td>
                            <select id="select" style="width: 50%" name="category">
                                <option>--------Chọn danh mục--------</option>
                                <?php
                                $cat = new category;
                                $catlist = $cat->showCat();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>

                                <option 
                                    <?php 
                                        if($result['catId'] == $result_product['catId']) {
                                            echo 'selected';
                                        }
                                    ?>
                                        
                                    value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php

                                    }
                                }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Thương hiệu</label>
                        </td>
                        <td>
                            <select id="select" style="width: 50%" name="brand">
                                <option>------Chọn thương hiệu--------</option>
                                <?php
                                $brand = new brand;
                                $brandlist = $brand->showBrand();
                                if ($brandlist) {
                                    while ($result = $brandlist->fetch_assoc()) {

                                ?>

                                        <option 
                                        <?php 
                                        if($result['brandId'] == $result_product['brandId']) {
                                            echo 'selected';
                                        }
                                    ?>
                                        value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                                <?php

                                    }
                                }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Mô tả</label>
                        </td>
                        <td>
                            <textarea name="productdesc" style="width: 100%" class="tinymce"><?php echo $result_product['productdesc'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá</label>
                        </td>
                        <td>
                            <input name="price" style="width: 50%" type="text" Value = "<?php echo $result_product['price'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tải ảnh</label>
                        </td>
                        <td>
                            <img src="uploads/<?php echo $result_product['image']?>" alt="" width="100"><br>
                            <input name="image" type="file" style="width: 50%"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type" Value = "<?php echo $result_product['type'] ?>" style="width: 50%">
                                <option>-------Select Type---------</option>
                                <?php 
                                if($result_product['type'] == 1) {
                                ?>
                                <option selected value="1">Nổi bật</option>
                                <option value="0">Không nổi bậc</option>
                                <?php
                                }else {
                                ?>
                                <option value="1">Nổi bật</option>
                                <option selected value="0">Không nổi bậc</option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Sửa" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                 }
               }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>