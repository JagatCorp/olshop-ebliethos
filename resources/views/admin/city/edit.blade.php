 {{-- Edit Modal --}}
 @extends('admin.layout.dashboard')
 @section('title', 'City')
 @section('ActiveCity', 'active')
 @section('Active3PL', 'active')
 @section('content')

     @foreach ($city as $item)
         <div class="modal fade modal-add-contact" id="ModalEdit{{ $item->city_id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                 <div class="modal-content">
                     <form action="{{ route('admin.edit-city') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="modal-header px-4">
                             <h5 class="modal-title" id="exampleModalCenterTitle">Edit City</h5>
                         </div>
                         <input type="hidden" name="city_id" value="{{ $item->city_id }}">
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
                                         <label for="userName">Name City</label>
                                         <input type="text" class="form-control" name="city_name"
                                             value="{{ $item->city_name }}" />
                                     </div>
                                 </div>

                                 <div class="col-lg-6">
                                     <div class="form-group mb-4">
                                         <label for="userName">Type</label>
                                         <input type="text" class="form-control" name="type"
                                             value="{{ $item->type }}" />
                                     </div>
                                 </div>

                                 {{-- <div class="col-lg-6">
                                     <div class="form-group mb-4">
                                         <label for="userName">Postal Code</label>
                                         <input type="number" class="form-control" name="postal_code"
                                             value="{{ $item->postal_code }}" />
                                     </div>
                                 </div> --}}


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
     {{-- <script>
         $.get('{{ route('admin.city.edit-modal') }}', function(data) {
             $('#editModalContainer').html(data);
         });
     </script> --}}
 @endsection
