function getShippingCostOptions(city_id) {
    // Mengambil nilai gudang yang dipilih
    var warehouse_id = $("#shipping-warehouse").val();
    // Mengambil nilai provinsi yang dipilih
    var province_id = $("#shipping-province").val();
    // Mengambil nilai kurir yang dipilih
    var courier_id = $("#shipping-courier").val();

    $("#loader").show();
    $.ajax({
        type: "POST",
        url: "/search-shipping-cost",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            city_id: city_id,
            warehouse_id: warehouse_id,
            province_id: province_id,
            courier_id: courier_id,
        },
        // Ketika permintaan Ajax berhasil, tampilkan hasilnya
        success: function (response) {
            $("#loader").hide();
            $("#shipping-cost-options").empty();
            $("#shipping-cost-options").append(
                "<option value>- Please Select -</option>"
            );

            // Tampilkan harga jika berhasil ditemukan
            if (response.price !== null) {
                $("#shipping-cost-options").append(
                    '<option value="' +
                        response.price.replace(/\s/g, "") +
                        '">' +
                        response.price +
                        "</option>"
                );
                // Update total pesanan
                updateOrderTotal(response.price);
            } else {
                // Tampilkan pesan jika harga tidak ditemukan
                $("#shipping-cost-options").append(
                    '<option value="">Tidak ada ongkir yang tersedia</option>'
                );
                // Reset total pesanan
                updateOrderTotal(0);
            }
        },
        error: function (xhr, status, error) {
            // Tangani kesalahan Ajax
            console.error(xhr.responseText);
        },
    });
}

function getQuickView(product_slug) {
    $.ajax({
        type: "GET",
        url: "/products/quick-view/" + product_slug,
        success: function (response) {
            $("#exampleModal").html(response);
            $("#exampleModal").modal();
        },
    });
}

(function ($) {
    $("#user-province-id").on("change", function (e) {
        var province_id = e.target.value;

        $.get("/orders/cities?province_id=" + province_id, function (data) {
            $("#user-city-id").empty();
            $("#user-city-id").append(
                "<option value>- Please Select -</option>"
            );

            $.each(data.cities, function (city_id, city) {
                $("#user-city-id").append(
                    '<option value="' + city_id + '">' + city + "</option>"
                );
            });
        });
    });

    $("#province-id").on("change", function (e) {
        var province_id = e.target.value;

        $.get("/orders/cities?province_id=" + province_id, function (data) {
            $("#city-id").empty();
            $("#city-id").append("<option value>- Please Select -</option>");

            $.each(data.cities, function (city_id, city) {
                $("#city-id").append(
                    '<option value="' + city_id + '">' + city + "</option>"
                );
            });
        });
    });

    // $("#change-qty").on("change", function (e) {
    //     var qty = e.target.value;
    //     console.log(this.getAttribute("data-productId"));
    //     console.log(qty);

    //     $.ajax({
    //         type: "POST",
    //         url: "/carts/update",
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr("content"),
    //             product_id: product_id,
    //             qty: qty,
    //         },
    //         success: function (response) {
    //             location.reload(true);
    //         },
    //     });
    // });

    // gudang di pilih
    // Memperbarui harga ongkir ketika pilihan gudang, provinsi, atau kota/kabupaten berubah
    $("#shipping-warehouse, #shipping-province, #shipping-city").on(
        "change",
        function () {
            var warehouse = $("#shipping-warehouse").val(); // Mengambil nilai gudang yang dipilih
            var province = $("#shipping-province").val(); // Mengambil nilai provinsi yang dipilih
            var city = $("#shipping-city").val(); // Mengambil nilai kota/kabupaten yang dipilih

            // Memeriksa apakah telah dipilih gudang, provinsi, dan kota/kabupaten
            if (warehouse && province && city) {
                $("#loader").show();
                // Mengirimkan permintaan ke server untuk mendapatkan harga ongkir
                $.get(
                    "/orders/shipping-cost",
                    { warehouse: warehouse, province: province, city: city },
                    function (data) {
                        $("#loader").hide();
                        if (data && data.harga_ongkir) {
                            // Menampilkan harga ongkir yang ditemukan
                            $("#shipping-cost").text(
                                "Harga Ongkir: " + data.harga_ongkir
                            );
                        } else {
                            // Menampilkan pesan jika harga ongkir tidak ditemukan
                            $("#shipping-cost").text(
                                "Harga Ongkir tidak ditemukan"
                            );
                        }
                    }
                );
            }
        }
    );

    // get provice
    // Memperbarui pilihan kota/kabupaten berdasarkan provinsi yang dipilih
    $("#shipping-province").on("change", function (e) {
        var province_id = e.target.value;

        $("#loader").show();
        $.get("/orders/cities?province_id=" + province_id, function (data) {
            if (data) {
                $("#loader").hide();
            }
            $("#shipping-city").empty();
            $("#shipping-city").append(
                "<option value>- Please Select -</option>"
            );

            $.each(data.cities, function (city_id, city) {
                $("#shipping-city").append(
                    '<option value="' + city_id + '">' + city + "</option>"
                );
            });
        });
    });
    // kota yang di pilih
    // Memperbarui harga ongkir ketika pilihan kota/kabupaten berubah
    $("#shipping-city").on("change", function (e) {
        var city_id = e.target.value;

        // Mengambil nilai gudang yang dipilih
        var warehouse = $("#shipping-warehouse").val();

        // Memeriksa apakah telah dipilih gudang, provinsi, dan kota/kabupaten
        if (warehouse && city_id) {
            $("#loader").show();
            $.get(
                "/orders/shipping-cost",
                { warehouse: warehouse, city_id: city_id },
                function (data) {
                    $("#loader").hide();

                    if (data && data.harga_ongkir) {
                        // Menampilkan harga ongkir yang ditemukan
                        $("#shipping-cost").text(
                            "Harga Ongkir: " + data.harga_ongkir
                        );
                    } else {
                        // Menampilkan pesan jika harga ongkir tidak ditemukan
                        $("#shipping-cost").text(
                            "Harga Ongkir tidak ditemukan"
                        );
                    }
                }
            );
        }
    });

    // Memperbarui harga ongkir ketika pilihan gudang, provinsi, kota/kabupaten, atau kurir berubah
    // Memperbarui harga ongkir ketika pilihan gudang, provinsi, kota/kabupaten, atau kurir berubah
    $(
        "#shipping-warehouse, #shipping-province, #shipping-city, #shipping-courier"
    ).on("change", function () {
        var warehouse = $("#shipping-warehouse").val(); // Mengambil nilai gudang yang dipilih
        var province = $("#shipping-province").val(); // Mengambil nilai provinsi yang dipilih
        var city = $("#shipping-city").val(); // Mengambil nilai kota/kabupaten yang dipilih
        var courier = $("#shipping-courier").val(); // Mengambil nilai kurir yang dipilih

        // Memeriksa apakah telah dipilih gudang, provinsi, kota/kabupaten, dan kurir
        if (warehouse && province && city && courier) {
            $("#loader").show();
            // Mengirimkan permintaan ke server untuk mendapatkan harga ongkir
            $.ajax({
                type: "POST",
                url: "/orders/shipping-cost",
                data: {
                    warehouse: warehouse,
                    province: province,
                    city: city,
                    courier: courier,
                },
                success: function (response) {
                    $("#loader").hide();
                    // Mengosongkan pilihan sebelumnya
                    $("#shipping-cost-option").empty();
                    // Menambahkan pilihan harga ongkir yang ditemukan ke dalam dropdown
                    $("#shipping-cost-option").append(
                        '<option value="' +
                            response.shipping_cost +
                            '">' +
                            response.shipping_cost +
                            "</option>"
                    );
                },
                error: function (xhr, status, error) {
                    $("#loader").hide();
                    // Menampilkan pesan kesalahan jika terjadi kesalahan
                    alert("Terjadi kesalahan: " + xhr.responseText);
                },
            });
        }
    });

    // ======= Show Shipping Cost Options =========
    if ($("#shipping-city").val()) {
        getShippingCostOptions($("#shipping-city").val());
    }

    $("#shipping-city").on("change", function (e) {
        var city_id = e.target.value;

        if (!$("#ship-box").is(":checked")) {
            getShippingCostOptions(city_id);
        }
    });

    // ============ Set Shipping Cost ================
    // Memperbarui harga ongkir ketika layanan pengiriman berubah
    $("#shipping-cost-option").on("change", function (e) {
        var shipping_service = e.target.value;
        var city_id = $("#shipping-city").val();

        if ($("#ship-box").is(":checked")) {
            city_id = $("#shipping-city").val();
        }

        // Mengambil nilai gudang yang dipilih
        var warehouse = $("#shipping-warehouse").val();
        // Mengambil nilai provinsi yang dipilih
        var province = $("#shipping-province").val();
        // Mengambil nilai kota/kabupaten yang dipilih
        var city = $("#shipping-city").val();
        // Mengambil nilai kurir yang dipilih
        var courier = $("#shipping-courier").val();

        if (warehouse && province && city && courier) {
            $("#loader").show();
            // Mengirimkan permintaan ke server untuk mendapatkan harga ongkir
            $.ajax({
                type: "POST",
                url: "/orders/set-shipping",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    city_id: city_id,
                    shipping_service: shipping_service,
                    warehouse: warehouse,
                    province: province,
                    city: city,
                    courier: courier,
                },
                success: function (response) {
                    $("#loader").hide();
                    $(".total-amount").html(
                        response.data.total.toLocaleString()
                    );
                },
            });
        }
    });

    $(".quick-view").on("click", function (e) {
        e.preventDefault();

        var product_slug = $(this).attr("product-slug");

        getQuickView(product_slug);
    });

    $(".add-to-cart").on("click", function (e) {
        e.preventDefault();

        var product_type = $(this).attr("product-type");
        var product_id = $(this).attr("product-id");
        var product_slug = $(this).attr("product-slug");

        if (product_type == "configurable") {
            getQuickView(product_slug);
        } else {
            $.ajax({
                type: "POST",
                url: "/carts",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    product_id: product_id,
                    qty: 1,
                },

                success: function (response) {
                    location.reload(true);
                    Swal.fire({
                        title: "Produk",
                        text: "Berhasil ditambahkan !",
                        icon: "success",
                        confirmButtonText: "Close",
                    });
                },
            });
        }
    });

    $(".add-to-fav").on("click", function (e) {
        e.preventDefault();

        var product_slug = $(this).attr("product-slug");

        $.ajax({
            type: "POST",
            url: "/wishlists",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                product_slug: product_slug,
            },
            success: function (response) {
                if (response.status == 401) {
                    $("#loginModal").modal();
                } else {
                    alert(response);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status == 401) {
                    console.log(xhr);
                    $("#loginModal").modal();
                }

                if (xhr.status == 422) {
                    alert(xhr.responseText);
                }
            },
        });
    });
})(jQuery);
