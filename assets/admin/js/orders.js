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

    });

    window.openOrderConfirmModal = function (link) {

        const href = link.getAttribute("href");

        orderConfirmBtn.setAttribute("href", href);

        orderConfirmModal.classList.add("show");

        return false;
    };

    window.closeOrderConfirmModal = function () {

        orderConfirmModal.classList.remove("show");

    };

})();