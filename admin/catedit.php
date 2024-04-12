<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>

<?php
$cat = new category();

if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script>window.location = 'catlist.php' </script>";
} else {
    $id = $_GET['catId'];
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>

        <div class="block copyblock">
            <?php
            if (isset($editCat)) {
                echo $editCat;
            }
            ?>
            <?php
            $get_cat_name = $cat->getcatbyId($id);
            if ($get_cat_name) {
                while ($result = $get_cat_name->fetch_assoc()) {
            ?>
                    <form action="catadd.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Sửa danh mục..." class="medium" />
                                </td>
                            </tr>
                            <tr>
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
<?php include 'inc/footer.php'; ?>