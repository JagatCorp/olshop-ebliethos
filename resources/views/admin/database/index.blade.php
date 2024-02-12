@extends('admin.layout.dashboard')
@section('title', 'Database')
@section('ActiveDatabase', 'active')
@section('content')
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper breadcrumb-contacts">
                    <div>
                        <h1>Backup</h1>
                        <p class="breadcrumbs"><span><a href="/admin/dashboard">Home</a></span>
                            <span><i class="mdi mdi-chevron-right"></i></span>Backup
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ url('admin/database/backup') }}" class='btn bg-primary'>
                                <i class='fa fa-download text-white '>Buat Backup</i>
                            </a>
                            <p>File Backup:</p>
                            <ul>

                                @foreach ($files as $file)
                                    <li>
                                        <?php $filename = str_replace('backup/', '', $file); ?>
                                        {{ $filename }}
                                        <a href="{{ route('download.backup/' . $file) }}" title="Download"
                                            class='text-success'>
                                            <i class='fa fa-download'></i> {{ $file }}
                                        </a>
                                        <a href="{{ url('admin/database/backup/delete/' . $file) }}" title="Hapus"
                                            onclick="return confirm('Yakin hapus file backup.?')" class='text-danger'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
