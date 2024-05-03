$(document).ready(function () {
    //get base URL *********************
    var url = $("#url").val();

    //display modal form for creating new product *********************
    $("#btn_add").click(function () {
        $("#btn-save").val("add");
        $("#frmProducts").trigger("reset");
        $("#updateModal").modal("show");
    });

    //display modal form for product EDIT ***************************
    $(document).on("click", ".edit-btn", function () {
        var tripiel_id = $(this).data("id");
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + "/" + tripiel_id,
            success: function (data) {
                // console.log('data', data);
                $("#tripiel_id").val(data.id);
                $("#price").val(data.price);
                var selectProvince = $(".province")[0]; // Mengakses elemen DOM asli
                var selectCity = $(".city")[0]; // Mengakses elemen DOM asli
                var selectCourier = $(".courier")[0]; // Mengakses elemen DOM asli
                var selectWarehouse = $(".warehouse")[0]; // Mengakses elemen DOM asli
                var selectKecamatan = $(".kecamatan")[0]; // Mengakses elemen DOM asli
                var selectType = $(".type_pem")[0]; // Mengakses elemen DOM asli

                // Bersihkan elemen <select> sebelum menambahkan opsi baru
                selectProvince.innerHTML = "";
                selectCity .innerHTML = "";
                selectCourier .innerHTML = "";
                selectWarehouse .innerHTML = "";
                selectKecamatan .innerHTML = "";
                selectType .innerHTML = "";

                // Lakukan permintaan AJAX tambahan untuk mendapatkan detail kelas
                // PROVINCE
                $.ajax({
                    type: "GET",
                    url: "province/api",
                    success: function (provinceData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        provinceData.forEach(function (province) {
                            var option = document.createElement("option");
                            option.value = province.province_id;
                            option.textContent = province.province_name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                province.province_id ===
                                data.province.province_id
                            ) {
                                option.selected = true;
                            }
                            selectProvince.appendChild(option);
                        });
                    },
                    error: function (provinceData) {
                        console.log("Error:", provinceData);
                    },
                });

                // CITY
                $.ajax({
                    type: "GET",
                    url: "city/api",
                    success: function (cityData) {
                        // console.log(cityData);
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        cityData.forEach(function (city) {
                            // console.log(city);
                            var option = document.createElement("option");
                            option.value = city.city_id;
                            option.textContent = city.city_name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                city.city_id ===
                                data.city_id
                            ) {
                                option.selected = true;
                            }
                            selectCity.appendChild(option);
                        });
                    },
                    error: function (cityData) {
                        console.log("Error:", cityData);
                    },
                });

                // COURIER
                $.ajax({
                    type: "GET",
                    url: "courier/api",
                    success: function (courierData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        courierData.forEach(function (courier) {
                            // console.log(courier);
                            var option = document.createElement("option");
                            option.value = courier.id;
                            option.textContent = courier.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                courier.id ===
                                data.courier_id
                            ) {
                                option.selected = true;
                            }
                            selectCourier.appendChild(option);
                        });
                    },
                    error: function (courierData) {
                        console.log("Error:", courierData);
                    },
                });

                // WAREHOUSE
                $.ajax({
                    type: "GET",
                    url: "warehouse/api",
                    success: function (warehouseData) {
                        // console.log(warehouseData);
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        warehouseData.forEach(function (warehouse) {
                            // console.log(warehouse);
                            var option = document.createElement("option");
                            option.value = warehouse.id;
                            option.textContent = warehouse.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                warehouse.id ===
                                data.warehouse_id
                            ) {
                                option.selected = true;
                            }
                            selectWarehouse.appendChild(option);
                        });
                    },
                    error: function (warehouseData) {
                        console.log("Error:", warehouseData);
                    },
                });

                // KECAMATAN
                $.ajax({
                    type: "GET",
                    url: "kecamatan/api",
                    success: function (kecamatanData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        kecamatanData.forEach(function (kecamatan) {
                            // console.log(kecamatan);
                            var option = document.createElement("option");
                            option.value = kecamatan.id;
                            option.textContent = kecamatan.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                kecamatan.id ===
                                data.kecamatan_id
                            ) {
                                option.selected = true;
                            }
                            selectKecamatan.appendChild(option);
                        });
                    },
                    error: function (kecamatanData) {
                        console.log("Error:", kecamatanData);
                    },
                });

                var options = [
                    { value: "yes", text: "COD" },
                    { value: "no", text: "Transfer" }
                ];

                // Buat dan tambahkan opsi ke dalam elemen select
                options.forEach(function(option) {
                    var optionElement = document.createElement("option");
                    optionElement.value = option.value;
                    optionElement.text = option.text;
                    // Jika nilai dari $item->cod sama dengan nilai opsi, tetapkan opsi tersebut sebagai yang dipilih
                    if (option.value === data.cod) {
                        optionElement.selected = true;
                    }
                    selectType.appendChild(optionElement);
                });

                $("#updateModal").modal("show"); // Menampilkan modal
            },
            error: function (data) {
                console.log("Error:", data);
            },
        })
    });

    $(document).on("click", ".duplikat-btn", function () {
        var tripiel_id = $(this).data("id");
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + "/" + tripiel_id,
            success: function (data) {
                // console.log('data', data);
                $("#tripiel_ids").val(data.id);
                $("#prices").val(data.price);
                var selectProvince = $(".provinces")[0]; // Mengakses elemen DOM asli
                var selectCity = $(".citys")[0]; // Mengakses elemen DOM asli
                var selectCourier = $(".couriers")[0]; // Mengakses elemen DOM asli
                var selectWarehouse = $(".warehouses")[0]; // Mengakses elemen DOM asli
                var selectKecamatan = $(".kecamatans")[0]; // Mengakses elemen DOM asli
                var selectType = $(".type_pems")[0]; // Mengakses elemen DOM asli

                // Bersihkan elemen <select> sebelum menambahkan opsi baru
                selectProvince.innerHTML = "";
                selectCity .innerHTML = "";
                selectCourier .innerHTML = "";
                selectWarehouse .innerHTML = "";
                selectKecamatan .innerHTML = "";
                selectType .innerHTML = "";

                // Lakukan permintaan AJAX tambahan untuk mendapatkan detail kelas
                // PROVINCE
                $.ajax({
                    type: "GET",
                    url: "province/api",
                    success: function (provinceData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        provinceData.forEach(function (province) {
                            var option = document.createElement("option");
                            option.value = province.province_id;
                            option.textContent = province.province_name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                province.province_id ===
                                data.province.province_id
                            ) {
                                option.selected = true;
                            }
                            selectProvince.appendChild(option);
                        });
                    },
                    error: function (provinceData) {
                        console.log("Error:", provinceData);
                    },
                });

                // CITY
                $.ajax({
                    type: "GET",
                    url: "city/api",
                    success: function (cityData) {
                        // console.log(cityData);
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        cityData.forEach(function (city) {
                            // console.log(city);
                            var option = document.createElement("option");
                            option.value = city.city_id;
                            option.textContent = city.city_name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                city.city_id ===
                                data.city_id
                            ) {
                                option.selected = true;
                            }
                            selectCity.appendChild(option);
                        });
                    },
                    error: function (cityData) {
                        console.log("Error:", cityData);
                    },
                });

                // COURIER
                $.ajax({
                    type: "GET",
                    url: "courier/api",
                    success: function (courierData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        courierData.forEach(function (courier) {
                            // console.log(courier);
                            var option = document.createElement("option");
                            option.value = courier.id;
                            option.textContent = courier.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                courier.id ===
                                data.courier_id
                            ) {
                                option.selected = true;
                            }
                            selectCourier.appendChild(option);
                        });
                    },
                    error: function (courierData) {
                        console.log("Error:", courierData);
                    },
                });

                // WAREHOUSE
                $.ajax({
                    type: "GET",
                    url: "warehouse/api",
                    success: function (warehouseData) {
                        // console.log(warehouseData);
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        warehouseData.forEach(function (warehouse) {
                            // console.log(warehouse);
                            var option = document.createElement("option");
                            option.value = warehouse.id;
                            option.textContent = warehouse.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                warehouse.id ===
                                data.warehouse_id
                            ) {
                                option.selected = true;
                            }
                            selectWarehouse.appendChild(option);
                        });
                    },
                    error: function (warehouseData) {
                        console.log("Error:", warehouseData);
                    },
                });

                // KECAMATAN
                $.ajax({
                    type: "GET",
                    url: "kecamatan/api",
                    success: function (kecamatanData) {
                        // Buat elemen <option> untuk setiap province dan tambahkan ke elemen <select>
                        kecamatanData.forEach(function (kecamatan) {
                            // console.log(kecamatan);
                            var option = document.createElement("option");
                            option.value = kecamatan.id;
                            option.textContent = kecamatan.name;
                            // Tetapkan atribut selected jika province_id sesuai dengan selectedProvinceId
                            if (
                                kecamatan.id ===
                                data.kecamatan_id
                            ) {
                                option.selected = true;
                            }
                            selectKecamatan.appendChild(option);
                        });
                    },
                    error: function (kecamatanData) {
                        console.log("Error:", kecamatanData);
                    },
                });

                var options = [
                    { value: "yes", text: "COD" },
                    { value: "no", text: "Transfer" }
                ];

                // Buat dan tambahkan opsi ke dalam elemen select
                options.forEach(function(option) {
                    var optionElement = document.createElement("option");
                    optionElement.value = option.value;
                    optionElement.text = option.text;
                    // Jika nilai dari $item->cod sama dengan nilai opsi, tetapkan opsi tersebut sebagai yang dipilih
                    if (option.value === data.cod) {
                        optionElement.selected = true;
                    }
                    selectType.appendChild(optionElement);
                });

                $("#duplikatModal").modal("show"); // Menampilkan modal
            },
            error: function (data) {
                console.log("Error:", data);
            },
        })
    });

    //create new product / update existing product ***************************
    $(document).ready(function () {
        $("#btn-save").click(function (e) {
            e.preventDefault();

            // Buat objek FormData untuk mengirim data form
            var formData = new FormData();
            formData.append("nama", $("#nama").val());
            formData.append("nisn", $("#nisn").val());
            formData.append("no_telp", $("#no_telp").val());
            formData.append("no_wali", $("#no_wali").val());
            formData.append("tgl_lahir", $("#tgl_lahir").val());
            formData.append("alamat", $("#alamat").val());
            formData.append("jk", $("#jk").val());
            formData.append("kelas_id", $("#kelas_id").val());
            formData.append("email", $("#email").val());
            formData.append("_token", $("input[name=_token]").val());

            // Ambil foto yang dipilih
            var foto = $("#foto")[0].files[0];

            // Jika ada foto yang dipilih, tambahkan ke formData
            if (foto) {
                formData.append("foto", foto);
            }

            // Ambil ID siswa
            var tripiel_id = $("#tripiel_id").val();

            // Tentukan tipe permintaan
            var type = "POST";
            var state = $("#btn-save").val();
            if (state === "update") {
                type = "PUT";
            }

            // Kirim permintaan AJAX
            $.ajax({
                type: "POST",
                url: "/admin/edit-siswa/" + tripiel_id,
                data: formData,
                dataType: "json",
                processData: false, // Set false agar FormData tidak diproses secara otomatis
                contentType: false, // Set false agar jQuery tidak mengatur tipe konten
                success: function (response) {
                    console.log(response);
                    $("#updateForm").trigger("reset");
                    $("#updateModal").modal("hide");

                    if (response.success) {
                        alert("Data Siswa Berhasil Diubah");
                        $(".data-table").DataTable().ajax.reload();
                    } else {
                        alert("Data Siswa Gagal Diubah");
                    }
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        });
    });

    //delete product and remove it from TABLE list ***************************
    var baseUrl = $("#url").val(); // Mendapatkan nilai baseUrl dari input hidden

    $(document).on("click", ".delete-btn", function () {
        var tripiel_id = $(this).data("id");

        // Populate Data in Delete Modal
        $.ajax({
            type: "GET",
            url: baseUrl + "/delete-show/" + tripiel_id,
            success: function (data) {
                console.log(data);
                $("#delete-siswa-name").text(data.nama);
                $("#delete-modal").modal("show");
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });

        // Submit form when "Yes" button is clicked
        $(document).on("click", "#confirm-delete", function () {
            var deleteUrl = baseUrl + "/delete-tripiel/" + tripiel_id;
            $.ajax({
                type: "GET",
                url: deleteUrl,
                success: function (response) {
                    alert("Data tripiel Berhasil Dihapus.");
                    $(".data-table").DataTable().ajax.reload();
                    $("#delete-modal").modal("hide");
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        });
    });
});
