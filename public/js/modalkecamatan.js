$(document).ready(function () {
    //get base URL *********************
    var url = $("#url").val();

    //display modal form for product EDIT ***************************
    $(document).on("click", ".edit-btn", function () {
        var kecamatan_id = $(this).data("id");
        var city_id = $(this).data("city-id");
        var kecamatanName = $(this).data("kecamatan-name");

        $("#namaKecamatan").val(kecamatanName); // Memasukkan input pada value
        $("#kecamatan_id").val(kecamatan_id); // Memasukkan input pada value

        var selectCity = $(".city")[0]; // Mengakses elemen DOM asli
        selectCity.innerHTML = "";

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
                        city_id
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

        $("#ModalEdit").modal("show"); // Menampilkan modal
    });

    $(document).on("click", ".delete-btn", function () {
        var kecamatan_id = $(this).data("id");
        $("#delete_id").val(kecamatan_id); // Memasukkan input pada value

        $("#ModalDelete").modal("show"); // Menampilkan modal
    });
});

