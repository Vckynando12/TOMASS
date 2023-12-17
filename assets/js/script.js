$(document).ready(function () {
    var isLoggedIn = true;

    if (isLoggedIn) {
        $("#accountDropdown").on({
            mouseenter: function () {
                $(".dropdown-menu").addClass("show");
            },
            mouseleave: function () {
                $(".dropdown-menu").removeClass("show");
            }
        });

        $("#userActions li.nav-item:nth-child(3) a.nav-link").text("Logout");
        $("#userActions li.nav-item:nth-child(3) a.nav-link").attr("href", "../proses/logout_proses.php");
        $("#userActions li.nav-item:nth-child(4)").remove();
    }
});

$(document).ready(function () {
    $(".add-to-cart").on("click", function () {
        var productId = $(this).data("product-id");
        var quantity = 1;

        if (!$(this).prop('disabled')) {
            $(this).prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "../proses/add_chart.php",
                data: { productId: productId, quantity: quantity },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                updateCartItemCount();
                            }
                        });
                    } else {
                        if (response.redirect) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Warning',
                                text: response.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.redirect;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error adding product to cart',
                    });
                },
                complete: function () {
                    $(".add-to-cart").prop('disabled', false);
                }
            });
        }
    });

    function updateCartItemCount() {
        $.ajax({
            type: "GET",
            url: "../proses/update_keranjang.php",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Memperbarui jumlah barang di header
                    var itemCount = response.itemCount;
                    updateHeaderCartCount(itemCount);
                }
            }
        });
    }

    function updateHeaderCartCount(count) {
        // Memperbarui tampilan jumlah barang di header
        var cartCountElement = $('.nav-icon span.badge');
        if (count > 0) {
            cartCountElement.text(count).show();
        } else {
            cartCountElement.hide();
        }
    }

});
