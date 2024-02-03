@extends('admin.layout.dashboard')
@section('title', 'Data Kategori')
@section('ActiveProduct', 'active')
@section('content')
    <!-- Main content -->
    <section class="ec-content-wrapper">
        <div class="content">

            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Buat Kategori</h1>

                </div>
                <div>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary shadow-sm float-right">
                        <i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="form-group row border-bottom pb-4">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" id="name">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="parent_id" class="col-sm-2 col-form-label">Kategori Utama</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="parent_id" id="parent_id">
                                            <option value="">Atur sebagai Kategori Utama</option>
                                            @foreach ($main_categories as $main_category)
                                                <option {{ old('parent_id') == $main_category->id ? 'selected' : null }}
                                                    value="{{ $main_category->id }}"> {{ $main_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
