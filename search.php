<?php
include_once 'include/header.php';
?>

<div class="main">
    <div class="content">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tukhoa = $_POST['tukhoa'];
            $searchProduct = $product->search_Product($tukhoa);
        }
        ?>
        <div class="content_top">
            <div class="heading">
                <h3> Từ khoá tìm kiếm : <?php echo $tukhoa ?>
                </h3>
            </div>

            <div class="clear"></div>
        </div>

        <div class="section group"> 
            <?php
            if ($searchProduct) {
                while ($result_searchProduct = $searchProduct->fetch_assoc()) {
            ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php"><img src="admin/uploads/<?php echo $result_searchProduct['image'] ?>" alt="" /></a>
                        <h2><?php echo $result_searchProduct['productName'] ?></h2>
                        <p><?php echo $result_searchProduct['productdesc'] ?></p>
                        <p><span class="price"><?php echo $result_searchProduct['price'] ?></span></p>
                        <div class="button"><span><a href="details.php" class="details">Chi tiết</a></span></div>
                    </div>
            <?php
                }
            } else {
                echo '<span class="danger">Không có sản phẩm</span>';
            }
            ?>
        </div>



    </div>
</div>
<?php
include_once 'include/footer.php';
?>