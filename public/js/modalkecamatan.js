$(document).ready(function() {
    //display modal form for product EDIT ***************************
    $(document).on("click", ".edit-btn", function () {
        var tripiel_id = $(this).data("id");
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + "/" + tripiel_id,
            success: function (data) {
                // console.log('data', data);
                var selectCity = $(".city")[0]; // Mengakses elemen DOM asli
                var selectKecamatan = $(".kecamatan")[0]; // Mengakses elemen DOM asli

                // Bersihkan elemen <select> sebelum menambahkan opsi baru
                selectCity .innerHTML = "";
                selectKecamatan .innerHTML = "";

                // Lakukan permintaan AJAX
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

                $("#ModalEdit").modal("show"); // Menampilkan modal
            },
            error: function (data) {
                console.log("Error:", data);
            },
        })
    });
});

