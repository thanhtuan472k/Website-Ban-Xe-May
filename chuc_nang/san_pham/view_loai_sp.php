<?php
        $conn = mysqli_connect('localhost', 'root', '', 'xemay');        
        $idloai = $_GET['idloai'];
		$result = mysqli_query($conn, 'select count(ID) as total from tbl_dmsp where TrangThai=1');
		$row = mysqli_fetch_assoc($result);
		$total_records = $row['total'];
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$limit = 8;
		$total_page = ceil($total_records / $limit);
		if ($current_page > $total_page){
			$current_page = $total_page;
		}
		else if ($current_page < 1){
			$current_page = 1;
		}
		$start = ($current_page - 1) * $limit;
		$result = mysqli_query($conn, "SELECT * FROM tbl_dmsp where IDLoai = $idloai LIMIT $start, $limit");
?>
<div class="alert alert-danger text-center m-1">
    <h3><b>DANH MỤC XE</b></h3>
</div>
<div  class="container padding">
    <div class="row padding">
        <?php	
            //session_start();
            require('./connect/connect.php');
            $sql = "select * from tbl_dmsp where TrangThai=1 and IDLoai = $idloai";
            $query = mysqli_query($con,$sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($result)){?>
                        <div class="col-md-3 col-12 my-2">
                            <div class="card sp h-100">
                                <div class="card-body">
                                <form method="post" action="add.php?id=<?php echo $row["ID"];?>">
                                        <img class="card-img-top thumb" src="<?php echo $row['HinhAnh']?>">
                                        <h6 class="card-title"><?php echo $row['TenSP']?></h6>
                                        <p class="card-text">Giá: <?php echo number_format($row['DonGia'])?> đ</p>
                                        <!-- <input type='submit' name='btn_dathang' class="btn btn-outline-secondary p-1 btn-muangay" value='Mua ngay'/> -->
                                        <?php
                                            $dem = $row['SoLuong'] - $row['SoLuongBan'];
                                            if($dem > 0){
                                                echo "<input type='submit' name='btn_dathang' class='btn btn-outline-secondary p-1 btn-muangay' value='Mua ngay'/>";
                                            }else{
                                                echo "<input type='button' class='btn btn-outline-secondary p-1 btn-hethang' value='Hết hàng'/>";
                                            }
                                        ?>
                                        <?php 
                                            echo "<a href='./index.php?action=chitiet&id=".$row['ID']."' class='btn btn-outline-secondary p-1 btn-chitiet float-right'>Chi tiết</a>";
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php							
                }
            }else
            {
                echo "Không có dữ liệu";
            }
        ?>
    </div>
</div>