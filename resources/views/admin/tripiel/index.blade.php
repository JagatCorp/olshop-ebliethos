@extends('admin.layout.dashboard')
@section('title', '3PL')
@section('ActiveTripiel', 'active')
@section('Active3PL', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>3PL</h1>
                    <p class="breadcrumbs"><span><a href="admin/dashboard">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>3PL
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        3PL
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ec-vendor-list card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Destination Province</th>
                                            <th>Destination City</th>
                                            <th>Destination Kecamatan</th>
                                            <th>Courier</th>
                                            <th>Warehouse</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($tripiel as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $item->province->province_name }}</td>

                                                <td>{{ $item->city->city_name }}</td>
                                                <td>{{ $item->kecamatan->name }}</td>
                                                <td>{{ $item->courier->name }}</td>

                                                <td>{{ $item->warehouse->name }}</td>
                                             

                                                <td>{{ $item->price }}</td>

                                                <td>
                                                    <div class="btn-group mb-1">
                                                        <button type="button"
                                                            class="btn btn-outline-success">Action</button>
                                                        <button type="button"
                                                            class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-display="static">
                                                            <span class="sr-only">Info</span>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" style="cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalEdit{{ $item->id }}">Edit</a>
                                                            <a class="dropdown-item" style="cursor:pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalDelete{{ $item->id }}">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Modal  -->
            <div class="modal fade modal-add-contact" id="ModalAdd" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.create-tripiel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Tripiel</h5>
                            </div>

                            <div class="modal-body px-4">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Province Name</label>
                                            <select id="province" name="province_id" class="form-control" required>
                                                <option value="">-- Select Province --
                                                </option>
                                                @foreach ($province as $item)
                                                    <option value="{{ $item->province_id }}">
                                                        {{ $item->province_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">City Name</label>
                                            <select id="city" name="city_id" class="form-control" required>
                                                <option value="">-- Select City --
                                                </option>
                                                @foreach ($city as $item)
                                                    <option value="{{ $item->city_id }}">
                                                        {{ $item->city_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Kecamatan</label>
                                            <select id="district" name="kecamatan_id" class="form-control" required>
                                                <option value="">-- Select Kecamatan --
                                                </option>
                                                @foreach ($kecamatan as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">courier Name</label>
                                            <select name="courier_id" class="form-control" required>
                                                <option value="">-- Select courier --
                                                </option>
                                                @foreach ($courier as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }} {{$item->type}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">warehouse Name</label>
                                            <select name="warehouse_id" class="form-control" required>
                                                <option value="">-- Select warehouse --
                                                </option>
                                                @foreach ($warehouse as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label for="userName">Price</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="modal-footer px-4">
                                <button type="button" class="btn btn-secondary btn-pill"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Edit Modal --}}
            @foreach ($tripiel as $item)
                <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.edit-tripiel') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Tripiel</h5>
                                </div>
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2">

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Province</label>
                                                <select name="province_id" class="form-control" required>

                                                    @foreach ($province as $province_item)
                                                        <option value="{{ $province_item->province_id }}"
                                                            {{ $province_item->province_id == $item->province_id ? 'selected' : '' }}>
                                                            {{ $province_item->province_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">City</label>
                                                <select name="city_id" class="form-control" required>

                                                    @foreach ($city as $city_item)
                                                        <option value="{{ $city_item->city_id }}"
                                                            {{ $city_item->city_id == $item->city_id ? 'selected' : '' }}>
                                                            {{ $city_item->city_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">courier Name</label>
                                                <select name="courier_id" class="form-control">

                                                    @foreach ($courier as $courier_item)
                                                        <option value="{{ $courier_item->id }}"
                                                            {{ $courier_item->id == $item->id ? 'selected' : '' }}>
                                                            {{ $courier_item->name }} {{$item->type}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Warehouse Name</label>
                                                <select name="warehouse_id" class="form-control">
                                                    @foreach ($warehouse as $warehouse_item)
                                                        <option value="{{ $warehouse_item->id }}"
                                                            {{ $warehouse_item->id == $item->id ? 'selected' : '' }}>
                                                            {{ $warehouse_item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Kecamatan</label>
                                                <select name="kecamatan_id" class="form-control">
                                                    @foreach ($kecamatan as $kecamatan_item)
                                                        <option value="{{ $kecamatan_item->id }}"
                                                            {{ $kecamatan_item->id == $item->id ? 'selected' : '' }}>
                                                            {{ $kecamatan_item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-4">
                                                <label for="userName">Price</label>

                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $item->price }}">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="modal-footer px-4">
                                    <button type="button" class="btn btn-secondary btn-pill"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- Delete Modal --}}
            @foreach ($tripiel as $item)
                <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a href="{{ route('admin.delete-tripiel', $item->id) }}" class="btn btn-danger"
                                    id="confirmDelete">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

      {{-- jquery fetch city based on province --}}
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
          $(document).ready(function() {
              $('#province').change(function() {
                  var provinceId = $(this).val();
  
                  // Clear existing options and add default option
                  $('#city').empty().append('<option value="">-- Pilih Kota/Kab --</option>');
  
                  $.ajax({
                      url: '/admin/fetch-cities',
                      method: 'GET',
                      data: {
                          province_id: provinceId
                      },
                      success: function(response) {
                          $.each(response, function(index, city) {
                              $('#city').append('<option value="' + city.city_id + '">' +
                                  city.type + ' ' + city.city_name + '</option>');
                          });
                      },
                      error: function(xhr, status, error) {
                          console.error(error);
                      }
                  });
              });
          });
      </script>

<script>
    $(document).ready(function() {
        $('#city').change(function() {
            var cityId = $(this).val();

            // Clear existing options and add default option
            $('#district').empty().append('<option value="">-- Pilih Kecamatan --</option>');

            $.ajax({
                url: '/admin/fetch-districts-by-city',
                method: 'GET',
                data: {
                    city_id: cityId
                },
                success: function(response) {
                    $.each(response, function(index, district) {
                        $('#district').append('<option value="' + district.id + '">' +
                            district.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@endsection
