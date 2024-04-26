<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>

<?php
$product = new product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $insertProduct = $product->insert_Product($_POST, $_FILES);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
            ?>
            <!-- enctype="multipart/form-data"  khi thêm hình ảnh phải có-->
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" style="width: 50%" name="productName" placeholder="Thêm sản phẩm..." class="medium" />
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

                                        <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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

                                        <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                            <textarea name="productdesc" style="width: 100%" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá</label>
                        </td>
                        <td>
                            <input name="price" style="width: 50%" type="text" placeholder="Nhập giá..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tải ảnh</label>
                        </td>
                        <td>
                            <input name="image" type="file" style="width: 50%" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type" style="width: 50%">
                                <option>-------Select Type---------</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bậc</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Thêm" />
                        </td>
                    </tr>
                </table>
            </form>
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