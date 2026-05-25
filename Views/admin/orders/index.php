<div class="orders-page">

    <div class="box">

        <div class="box-title">

            <h2>Danh sách đơn hàng</h2>

            <button class="btn-primary" onclick="openOrderModal()">
                <i class='bx bx-plus'></i>
                Tạo đơn hàng
            </button>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>#OD001</td>

                        <td>Nguyễn Văn A</td>

                        <td>Mô hình Luffy Gear 5</td>

                        <td>2.500.000đ</td>

                        <td>
                            <span class="payment paid">
                                Đã thanh toán
                            </span>
                        </td>

                        <td>
                            <span class="status confirmed">
                                Đang giao
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <button class="action-btn view" onclick="openOrderModal()">
                                    <i class='bx bx-show'></i>
                                </button>

                                <button class="action-btn edit">
                                    <i class='bx bx-edit'></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>#OD002</td>

                        <td>Trần Văn B</td>

                        <td>Mô hình Gojo Satoru</td>

                        <td>1.850.000đ</td>

                        <td>
                            <span class="payment unpaid">
                                Chưa thanh toán
                            </span>
                        </td>

                        <td>
                            <span class="status pending">
                                Chờ xác nhận
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <button class="action-btn view" onclick="openOrderModal()">
                                    <i class='bx bx-show'></i>
                                </button>

                                <button class="action-btn edit">
                                    <i class='bx bx-edit'></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>#OD003</td>

                        <td>Lê Văn C</td>

                        <td>Mô hình Naruto</td>

                        <td>990.000đ</td>

                        <td>
                            <span class="payment paid">
                                Đã thanh toán
                            </span>
                        </td>

                        <td>
                            <span class="status delivered">
                                Hoàn thành
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <button class="action-btn view" onclick="openOrderModal()">
                                    <i class='bx bx-show'></i>
                                </button>

                                <button class="action-btn edit">
                                    <i class='bx bx-edit'></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- ORDER MODAL -->

<div class="modal" id="orderModal">

    <div class="modal-box">

        <div class="modal-header">

            <h3>Chi tiết đơn hàng</h3>

            <button class="modal-close" onclick="closeOrderModal()">
                <i class='bx bx-x'></i>
            </button>

        </div>

        <div class="order-detail">

            <div class="detail-group">
                <span>Mã đơn:</span>
                <strong>#OD001</strong>
            </div>

            <div class="detail-group">
                <span>Khách hàng:</span>
                <strong>Nguyễn Văn A</strong>
            </div>

            <div class="detail-group">
                <span>Email:</span>
                <strong>admin@gmail.com</strong>
            </div>

            <div class="detail-group">
                <span>Số điện thoại:</span>
                <strong>0987654321</strong>
            </div>

            <div class="detail-group full">
                <span>Địa chỉ nhận hàng:</span>

                <strong>
                    123 Nguyễn Văn Cừ, Quận 5, TP.HCM
                </strong>
            </div>

            <div class="detail-group">
                <span>Sản phẩm:</span>
                <strong>Mô hình Luffy Gear 5</strong>
            </div>

            <div class="detail-group">
                <span>Số lượng:</span>
                <strong>1</strong>
            </div>

            <div class="detail-group">
                <span>Tổng tiền:</span>
                <strong>2.500.000đ</strong>
            </div>

           <div class="detail-group">
    <span>Thanh toán:</span>

    <strong class="payment-method">
        COD
    </strong>
</div>

            <div class="detail-group">
                <span>Trạng thái:</span>

                <select>
                    <option>Chờ xác nhận</option>
                    <option>Đang giao</option>
                    <option>Hoàn thành</option>
                    <option>Đã hủy</option>
                </select>
            </div>

            <div class="detail-group full">

                <span>Ghi chú:</span>

                <textarea placeholder="Không có ghi chú"></textarea>

            </div>

        </div>

    </div>

</div>

<script>

    const orderModal = document.getElementById('orderModal');

    function openOrderModal() {
        orderModal.classList.add('show');
    }

    function closeOrderModal() {
        orderModal.classList.remove('show');
    }

</script>