    </div>

    <div class="footer">
        © 2026 WEB_MO_HINH ADMIN
    </div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/admin/js/category.js"></script>
<?php if (
    ($_GET['page'] ?? '') === 'product-add' ||
    ($_GET['page'] ?? '') === 'product-edit'
): ?>
<script src="assets/admin/js/product.js"></script>
<?php endif; ?>

</body>
</html>