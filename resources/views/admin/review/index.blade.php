@extends('admin.layout.dashboard')
@section('title', 'Review')
@section('ActiveReview', 'active')
@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Review</h1>
                    <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Review
                    </p>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"> <i
                            class="fa fa-plus"></i>
                        Review
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
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($review as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->user->first_name }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>
                                                    <?php  $a=$item->rating; if ($a == 1 ) { ?>
                                                    <div class="ec-t-rate">
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </div>
                                                    <?php  } elseif ($a == 2 ) { ?>
                                                    <div class="ec-t-rate">
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </div>
                                                    <?php  } elseif ($a == 3 ) { ?>
                                                    <div class="ec-t-rate">
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </div>
                                                    <?php  } elseif ($a == 4 ) { ?>
                                                    <div class="ec-t-rate">
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="ec-t-rate">
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                        <i class="mdi mdi-star is-rated"></i>
                                                    </div>
                                                    <?php } ?>
                                                </td>
                                                <td>{{ $item->review }}</td>
                                                <td>
                                                    <img width="200px" src="{{ asset('img/fotoreview/' . $item->foto) }}"
                                                        alt="foto review" />
                                                </td>
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
                        <form action="{{ route('admin.create-review') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header px-4">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Review</h5>
                            </div>
                            <div class="modal-body px-4">
                                <div class="row mb-2 ">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">User</label>
                                            <select class="form-select" name="user_id" id="">
                                                <option value="">pilih</option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->first_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Product</label>
                                            <select class="form-select" name="product_id" id="">
                                                <option value="">pilih</option>
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Rating</label>
                                            <select class="form-select" name="rating" id="">
                                                <option value="">pilih</option>
                                                <option value="1">⭐</option>
                                                <option value="2">⭐⭐</option>
                                                <option value="3">⭐⭐⭐</option>
                                                <option value="4">⭐⭐⭐⭐</option>
                                                <option value="5">⭐⭐⭐⭐⭐</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstName">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="review">Review</label>
                                        <textarea type="text" class="form-control" name="review" rows="5" cols="5" id="review"
                                            required>
                                            </textarea>
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
            @foreach ($review as $item)
                <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.edit-review') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header px-4">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Review</h5>
                                </div>
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-body px-4">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">User</label>
                                                <select class="form-select" name="user_id" id="">
                                                    <option value="{{ $item->user_id }}">{{ $item->user->first_name }}
                                                    </option>
                                                    @foreach ($user as $items)
                                                        <option value="{{ $items->id }}">{{ $items->first_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Product</label>
                                                <select class="form-select" name="product_id" id="">
                                                    @foreach ($product as $items)
                                                        <option value="{{ $items->id }}">{{ $items->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Rating</label>
                                                <select class="form-select" name="rating" id="ratingSelect">
                                                    <option value="{{ $item->rating }}">{{ $item->rating }}</option>
                                                    <option value="1">⭐</option>
                                                    <option value="2">⭐⭐</option>
                                                    <option value="3">⭐⭐⭐</option>
                                                    <option value="4">⭐⭐⭐⭐</option>
                                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="firstName">Foto</label>
                                                <input type="file" class="form-control" name="foto">
                                                <input type="hidden" class="form-control" name="gambarLama"
                                                    value="{{ $item->foto }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4">
                                            <label for="review">Review</label>
                                            <textarea type="text" class="form-control" name="review" rows="5" cols="5" id="review"
                                                value="{{ $item->review }}">
                                                    {{ $item->review }}
                                                </textarea>
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
            @foreach ($review as $item)
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
                                <a href="{{ route('admin.delete-review', $item->id) }}" class="btn btn-danger"
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
    <script>
        // Function to update star ratings
        function updateStarRating() {
            var ratingSelect = document.getElementById('ratingSelect');
            var selectedOption = ratingSelect.options[ratingSelect.selectedIndex];
            var stars = '';
            for (var i = 0; i < parseInt(selectedOption.value); i++) {
                stars += '⭐'; // Unicode character for star
            }
            selectedOption.text = stars;
        }

        // Call the function initially to set star ratings
        updateStarRating();

        // Add event listener to update star ratings when the select option changes
        document.getElementById('ratingSelect').addEventListener('change', updateStarRating);
    </script>

@endsection
