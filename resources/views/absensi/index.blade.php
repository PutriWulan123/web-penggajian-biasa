@extends('layout.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Absensi</h1>
                    </div><!-- /.col -->
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Absensi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-dark" role="alert">
                      {{$message}}
                    </div>
                @endif --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <a href="/tambahpegawai" type="button" class="btn btn-sm btn-primary mb-4">Tambah +</a> --}}

                            <!-- Button trigger modal -->
                            @can('update role')
                                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                                    data-bs-target="#tambah">
                                    Tambah +
                                </button>
                            @endcan

                            <!-- Modal -->
                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Absensi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/insertdata_absensi" method="POST" enctype="multipart/form-data">
                                                
                                                @csrf
                                                {{-- PR --}}
                                                 <div class="form-group">
                                                    <label>Pegawai</label>
                                                    <select name="id_pegawai" class="form-control">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($pegawais as $pg)
                                                            <option value="{{ $pg->id }}">{{ $pg->nama_pegawai }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                
                                            
                                                <div class="form-group">
                                                    <label>Devisi</label>
                                                    <select name="id_devisi" class="form-control">
                                                    <option selected>- Pilih -</option>
                                                        @foreach ($row as $dv )
                                                            <option value="{{ $dv->id}}">{{ $dv->nama_devisi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Kehadiran</label>
                                                    <select class="form-select" name="kehadiran" aria-label="Default select example">
                                                        <option selected>--Kehadiran--</option>
                                                        <option value="Ijin">Ijin</option>
                                                        <option value="Sakit">Sakit</option>
                                                        <option value="Alfa">Alfa</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>
                                                
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-dark" role="alert">
                                    {{ $message }}
                                </div>
                            @endif

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-responsive-md table-hover" id="table-absensi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Pegawai</th>
                                            <th class="text-center">Devisi</th>
                                            <th class="text-center">Kehadiran</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $row)
                                            <tr class="text-center">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $row->pegawai->nama_pegawai }}</td>
                                                <td>{{ $row->devisi->nama_devisi }}</td>
                                                <td>{{ $row->kehadiran }}</td>
                                                <td>{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                   <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">Lihat</a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @can('delete role')
                                                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">Edit</a></li>
                                                            @endcan
                                                            <li><hr class="dropdown-divider"></li>
                                                            @can('delete role')
                                                                <li><a class="dropdown-item" href="/deletedata_absensi/{{ $row->id }}">Hapus</a></li>
                                                            @endcan
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item delete" href="#" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $row->id }}">Detail</a></li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Absensi</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <form action="/updatedata_absensi/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                                        @csrf
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Nama Pegawai</label>
                                                                            <input type="text" name="id_pegawai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->pegawai->nama_pegawai}}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                                                                            <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->devisi->nama_devisi }}">
                                                                        </div>
{{-- 
                                                                        <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Id Devisi</label>
                                                                        <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1 aria-describedby="emailHelp"
                                                                            value="{{ $row->id_devisi }}">
                                                                    </div> --}}

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Kehadiran</label>
                                                                            <select class="form-select" name="kehadiran" aria-label="Default select example">
                                                                                <option selected>--Kehadiran--</option>
                                                                                <option value="Ijin">Ijin</option>
                                                                                <option value="Sakit">Sakit</option>
                                                                                <option value="Alfa">Alfa</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                                                            <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->tanggal}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Keluar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan
                                                                            Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Detail -->
                                                    <div class="modal fade" id="modalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Absensi</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                                    <div class="mb-3">
                                                                        <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                                                                        <input type="text" name="id_pegawai" class="form-control" id="id_pegawai" value="{{ $row->pegawai->nama_pegawai }}" disabled>
                                                                    </div>
                                                                                        
                                                                    <div class="mb-3">
                                                                        <label for="devisi" class="form-label">Nama Devisi</label>
                                                                        <input type="text" name="id_devisi" class="form-control" id="id_devisi" value="{{ $row->devisi->nama_devisi }}" disabled>
                                                                    </div>
                                                                                            
                                                                    <div class="mb-3">
                                                                        <label for="kehadiran" class="form-label">Kehadiran</label>
                                                                        <input type="text" name="kehadiran" class="form-control" id="kehadiran" value="{{ $row->kehadiran }}" disabled>
                                                                    </div>
                                                                                            
                                                                    <div class="mb-3">
                                                                        <label for="tanggal" class="form-label">Tanggal</label>
                                                                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $row->tanggal }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 



    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"</script>
            <script>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"</script> --}}
            <!-- Option 1: Bootstrap Bundle with Popper -->
            
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="https://unpkg.com/sweetaalert/dist/sweetalert.min.js"></script>
    <script>
        $('.delete').click(function(e) {
            e.preventDefault()
            let link = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    </script>

   {{-- <script>
        $(document).ready(function(){
            $('#loadData').click(function(){
                $.ajax({
                    url: '/api/getPegawaiHTML',
                    type: 'GET',
                    success: function(response) {
                        $('#pegawaiDropdown').html(response);
                    },
                    error: function(error) {
                        alert('Error retrieving data');
                    }
                });
            });
        });
    </script> --}}

    {{-- MEMBUAT PENCARIANNYA --}}
    <script>
        var table_absensi = $('#table-absensi').dataTable({
            ordering: false
        })
    </script>
@endsection
