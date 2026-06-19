(function () {
    let orderConfirmModal;
    let orderConfirmBtn;

    document.addEventListener("DOMContentLoaded", function () {
        orderConfirmModal = document.getElementById("confirmModal");
        orderConfirmBtn = document.getElementById("confirmBtn");

        const toast = document.getElementById("toast");

        if (toast) {
            setTimeout(() => {
                toast.classList.add("toast-hide");
            }, 2500);

            setTimeout(() => {
                toast.remove();
            }, 3000);

            const url = new URL(window.location);
            url.searchParams.delete("msg");
            window.history.replaceState({}, "", url);
        }

        if (orderConfirmModal) {
            orderConfirmModal.addEventListener("click", function (event) {
                if (event.target === orderConfirmModal) {
                    closeOrderConfirmModal();
                }
            });
        }
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeOrderConfirmModal();
        }
    });

    window.openOrderConfirmModal = function (link) {
        if (!orderConfirmModal || !orderConfirmBtn) {
            return true;
        }

        const href = link.getAttribute("href");

        orderConfirmBtn.setAttribute("href", href);
        orderConfirmModal.classList.add("show");

        return false;
    };

    window.closeOrderConfirmModal = function () {
        if (orderConfirmModal) {
            orderConfirmModal.classList.remove("show");
        }
    };
})();
