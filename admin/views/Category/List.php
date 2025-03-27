<?php $count = 1 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<?php include './views/components/header.php'; ?>
<?php include './views/components/sidebar.php' ?>
<div class="container-fluid">
        <!-- Main Content (BÊN PHẢI) -->
        <main class="col-md-8 p-4 main-content order-md-1" style="width: 75%; margin-left: 400px;">
            <!-- <h1>Welcome to Shop</h1> -->
            <h1>Danh sách Sản phẩm</h1>
            <table class="table">
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" class="text-center"><a class="btn btn-primary" href="<?php echo BASE_URL_ADMIN . "?act=add_category_view" ?>">Add Product</a></td>
                </tr>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>

                <?php foreach($categories as $category){ ?>
                <tr>
                    <td class="text-center"><?php echo $count; ?></td>
                    <td class="text-center"><?php echo $category["category_name"]; ?></td>

                    <td class="text-center"><a class="btn btn-primary" href="<?php echo BASE_URL_ADMIN . "/index.php?act=get_category_id&id=" . $category["id"] ?>" >Update</a></td>

                    <td class="text-center"><a class="btn btn-danger" href="javascript:void(0);" onclick="deleteCategory(<?php echo $category['id']; ?>)" >Delete</a></td>
                </tr>
                <?php $count++; }?>
            </table>
        </main>
</div>

<?php include './views/components/footer.php'; ?>
</body>
</html>

<script>
function deleteCategory(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = "<?= BASE_URL_ADMIN ?>?act=delete_category&id=" + id;
        alert("Delete success!!!");

    } else{
        return null;
    }
}

</script>