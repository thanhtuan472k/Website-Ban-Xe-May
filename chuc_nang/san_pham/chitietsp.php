<meta charset="utf-8" />
<?php
require('connect/connect.php');
// if (isset($_POST["btn_dathang"])) {
$id = $_GET['id'];
$sql = mysqli_query($con, "select * from tbl_dmsp where ID=$id order by ID desc");
// echo "<h2>Chi tiết sản phẩm </h2>".$sql['TenSP'];
// echo $id;
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="alert alert-danger text-center m-1">
        <h3><b>CHI TIẾT SẢN PHẨM<b><h3>
    </div>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-4 col-12 text-center">
                <img class="img-fluid border" width="100%" src="<?php echo $row['HinhAnh']; ?>" />
            </div>
            <div class="col-md-8 col-12">
                <form method="post" action="add.php?id=<?php echo $row["ID"]; ?>">
                    <H2><?php echo $row['TenSP'] ?></H2>
                    <p class="card-text">Giá: <?php echo number_format($row['DonGia']) ?> đ</p>
                    <?php
                    $dem = $row['SoLuong'] - $row['SoLuongBan'];
                    if ($dem > 0) {
                        echo "<input type='submit' name='btn_dathang' class='btn btn-outline-secondary p-1 btn-muangay' value='Mua ngay'/>";
                    } else {
                        echo "<input type='button' class='btn btn-outline-secondary p-1 btn-hethang' value='Hết hàng'/>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="row px-5 py-3">
            <p><?php echo $row['DienGiai'] ?></P>
        </div>
    </div>
    <div class="alert alert-success text-center m-1 mt-3">
        <strong>SẢN PHẨM TƯƠNG TỰ</strong>
    </div>
    <?php require('sanphamtuongtu.php'); ?>
<?php } ?>