<div class="mb10">
    <h3>DANH SÁCH SP TRONG ĐƠN HÀNG</h3>
</div>

<div class="formcontent">
    <form action="index.php?act=ctdh" method="post">
        <div>
            <label>Tình trạng</label>
            <?php if ($onebill['bill_status'] == 1): ?>
                <select name="bill_status">
                    <option value="1" <?php echo ($onebill['bill_status'] == 1) ? 'selected' : ''; ?>>Đơn hàng mới</option>
                    <option value="2" <?php echo ($onebill['bill_status'] == 2) ? 'selected' : ''; ?>>Đang xử lý</option>
                    <option value="3" <?php echo ($onebill['bill_status'] == 3) ? 'selected' : ''; ?>>Đang giao hàng</option>
                    <option value="4" <?php echo ($onebill['bill_status'] == 4) ? 'selected' : ''; ?>>Đã giao hàng</option>
                    <option value="5" <?php echo ($onebill['bill_status'] == 5) ? 'selected' : ''; ?>>Đơn hàng bị hủy</option>
                </select>
            <?php elseif ($onebill['bill_status'] == 2): ?>
                <select name="bill_status">
                    <option value="2" <?php echo ($onebill['bill_status'] == 2) ? 'selected' : ''; ?>>Đang xử lý</option>
                    <option value="3" <?php echo ($onebill['bill_status'] == 3) ? 'selected' : ''; ?>>Đang giao hàng</option>
                    <option value="4" <?php echo ($onebill['bill_status'] == 4) ? 'selected' : ''; ?>>Đã giao hàng</option>
                    <option value="5" <?php echo ($onebill['bill_status'] == 5) ? 'selected' : ''; ?>>Đơn hàng bị hủy</option>
                </select>
            <?php elseif ($onebill['bill_status'] == 3): ?>
                <select name="bill_status">
                    <option value="3" <?php echo ($onebill['bill_status'] == 3) ? 'selected' : ''; ?>>Đang giao hàng</option>
                    <option value="4" <?php echo ($onebill['bill_status'] == 4) ? 'selected' : ''; ?>>Giao thành công</option>
                    <option value="5" <?php echo ($onebill['bill_status'] == 5) ? 'selected' : ''; ?>>Đơn hàng thất bại
                    </option>
                </select>
            <?php else: ?>
                <select name="bill_status">
                    <option value="5" <?php echo ($onebill['bill_status'] == 5) ? 'selected' : ''; ?>>Đơn hàng bị hủy</option>
                </select>
            <?php endif ?>
        </div><br>

        <div class="mb10">
            <table class="mb10 content-table">
                <thead>
                    <tr>

                        <th>Mã tài khoản</th>

                        <th>User</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($listbill as $key => $bill) {
                        $countsp = loadall_cart_count($bill['id']);
                        $ttdh = get_ttdh($bill['bill_status']);
                        $pttt = get_pttt($bill['bill_pttt']);
                        ?>
                        <tr>
                            <td>DA1-<?php echo $bill['id'] ?></td>
                           
                            <td><?php echo $bill['bill_name'] ?><br></td>
                            <td><?php echo $bill['bill_email'] ?><br></td>
                            <td><?php echo $bill['bill_address'] ?><br></td>
                            <td><?php echo $bill['bill_tel'] ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="mb10">
            <table class="mb10 content-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ctdh as $key => $sp) {
                        $img = $image_path . $sp['img']; ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><img src="<?php echo $img ?>" alt="" width="70px" height="50px"></td>
                            <td><?php echo $sp['name'] ?></td>
                            <td><?php echo number_format($sp['price'], 0, ",", ".") ?> VNĐ</td>
                            <td><?php echo $sp['soluong'] ?></td>
                            <td><?php echo number_format($sp['thanhtien'], 0, ",", ".") ?> VNĐ</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- <a href="index.php?act=listdh"><input type="button" value="Danh sách"></a><br> -->
        <input type="hidden" name="iddh" value="<?php echo $onebill['id'] ?>">
        <input name="editdh" type="submit" value="Cập nhật">
        <input type="reset" value="Nhập lại">
        <a href="index.php?act=listdh"><input type="button" value="Danh sách"></a><br>
    </form>
</div>