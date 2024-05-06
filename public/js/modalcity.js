$(document).ready(function () {
    //get base URL *********************
    var url = $("#url").val();

    //display modal form for product EDIT ***************************
    $(document).on("click", ".edit-btn", function () {
        var city_id = $(this).data("id");
        var province_id = $(this).data("province-id");
        var namaCity = $(this).data('name-city');
        var typeCity = $(this).data('type');

        var selectProvince = $(".province")[0]; // Mengakses elemen DOM asli
        var selectType = $(".typeCity")[0];
        $("#city_id").val(city_id);

        $("#city_name").val(namaCity); // Memasukkan input pada value
        selectProvince.innerHTML = "";
        selectType.innerHTML = "";

        // Lakukan permintaan AJAX
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
                        province_id
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

        var options = [
            { value: 'Kabupaten' },
            { value: 'Kota' },
        ];

        options.forEach(function (option){
            var optionElement = document.createElement('option');
            optionElement.value = option.value;
            optionElement.text = option.value;
            if(option.value === typeCity){
                optionElement.selected = true;
            }
            selectType.appendChild(optionElement)
        });


        $("#ModalEdit").modal("show"); // Menampilkan modal
    });

    $(document).on("click", ".delete-btn", function () {
        var city_id = $(this).data("id");
        $("#delete_id").val(city_id); // Memasukkan input pada value

        $("#ModalDelete").modal("show"); // Menampilkan modal
    });
});

