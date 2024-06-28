@extends('layout.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Penggajian</h1>
                    </div><!-- /.col -->
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Penggajian</li>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penggajian</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/insertdata_penggajian" method="POST" enctype="multipart/form-data">
                                                
                                                @csrf
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
                                                    <label for="exampleInputEmail1" class="form-label">Periode</label>
                                                    <input type="text" name="periode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label ">Makan</label>
                                                    <input type="number" name="uang_makan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Transportasi</label>
                                                    <input type="number" name="uang_tp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>

                                                 <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Gaji Pokok</label>
                                                    <input type="number" name="gaji_pokok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>

                                                 <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Potongan</label>
                                                    <input type="number" name="total_potongan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Tanggal Bayar</label>
                                                    <input type="date" name="tgl_penggajian" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                                <table class="table table-responsive-md table-hover" id="table-penggajian">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">Devisi</th>
                                            <th class="text-center">Periode</th>
                                            <th class="text-center">Total Gaji</th>
                                            {{-- <th class="text-center">Makan</th>
                                            <th class="text-center">Transportasi</th>  --}}
                                            <th class="text-center">Tanggal Penggajian</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $a = 1;
                                            $b = 1;
                                        @endphp
                                         @foreach($data as $row)
                                            <tr class="text-center">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $row->pegawais->nama_pegawai }}</td>
                                                <td>{{ $row->devisis->nama_devisi }}</td>
                                                <td>{{ $row->periode}}</td>
                                                {{-- <td>Rp{{ number_format($row->makan, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($row->transportasi, 0, ',', '.') }}</td> 
                                                <td>{{ number_format($row->total_potongan, 0, ',', '.') }}</td> --}}
                                                <td>{{ number_format($row->gaji_pokok + $row->uang_makan + $row->uang_tp - $row->total_potongan, 0, ',', '.') }}</td>
                                                {{-- @foreach ($penggajian as $gj)
                                                    <td>{{ $gj->gaji_pokok }}</td>
                                                @endforeach --}}
                                                <td>{{ date('d-m-Y', strtotime($row->tgl_penggajian))
                                                    }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Lihat</a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            @can('delete role')
                                                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">Edit</a></li>
                                                            @endcan
                                                            <li><hr class="dropdown-divider"></li>
                                                            @can('delete role')
                                                                <li><a class="dropdown-item" href="/deletedata_penggajian/{{ $row->id }}">Hapus</a></li>
                                                            @endcan
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $row->id }}">Detail</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit
                                                            Data Penggajian</h5>
                                                        @can('edit role')
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        @endcan
                                                    </div>
                                                    <form action="/updatedata_penggajian/{{ $row->id }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                            @csrf
                                                            
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Nama Pegawai</label>
                                                                <input type="text" name="id_pegawai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->pegawais->nama_pegawai}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                                                                <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->devisis->nama_devisi}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label ">Periode</label>
                                                                <input type="text" name="periode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->periode}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Makan</label>
                                                                <input type="text" name="uang_makan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="Rp{{ number_format($row->uang_makan, 0, ',', '.') }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Transportasi</label>
                                                                <input type="text" name="uang_tp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="Rp{{ number_format($row->uang_tp, 0, ',', '.') }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Total Gaji</label>
                                                                <input type="text" name="gaji_pokok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ number_format($row->gaji_pokok, 0, ',', '.') }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Potongan</label>
                                                                <input type="text" name="total_potongan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="Rp{{ number_format($row->total_potongan, 0, ',', '.') }}">
                                                            </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Tanggal Bayar</label>
                                                            <input type="date" name="tgl_penggajian" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ date('d-m-Y', strtotime($row->tgl_penggajian))
                                                    }}">
                                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Keluar</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Penggajian</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- CODE UNTUK TAMPILAN POP UP --}}
                                                        <div class="mb-3">
                                                            <label for="devisi" class="form-label">Nama Pegawai</label>
                                                            <input type="text" name="id_pegawai" class="form-control" id="id_pegawai" value="{{ $row->pegawais->nama_pegawai }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="id_devisi" class="form-label">Nama Devisi</label>
                                                            <input type="text" name="id_devisi" class="form-control" id="id_devisi" value="{{ $row->devisis->nama_devisi }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="periode" class="form-label">Periode</label>
                                                            <input type="text" name="periode" class="form-control" id="periode" value="{{ $row->periode }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="uang_makan" class="form-label">Makan</label>
                                                            <input type="text" name="uang_makan" class="form-control" id="uang_makan" value="Rp{{ number_format($row->uang_makan, 0, ',', '.') }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="uang_tp" class="form-label">Transportasi</label>
                                                            <input type="text" name="uang_tp" class="form-control" id="uang_tp" value="Rp{{ number_format($row->uang_tp, 0, ',', '.') }}" disabled>
                                                        </div>`

                                                        <div class="mb-3">
                                                            <label for="total_potongan" class="form-label">Total Potongan</label>
                                                            <input type="text" name="total_potongan" class="form-control" id="total_potongan" value="Rp{{ number_format($row->total_potongan, 0, ',', '.') }}" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="gaji_pokok" class="form-label">Total Gaji</label>
                                                            <input type="text" name="gaji_pokok" class="form-control" id="gaji_pokok" value=
                                                            "Rp{{ number_format($row->gaji_pokok + $row->uang_makan + $row->uang_tp - $row->total_potongan, 0, ',', '.') }}" disabled>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="tgl_penggajian" class="form-label">Tanggal Bayar</label>
                                                            <input type="date" name="tgl_penggajian" class="form-control" id="tgl_penggajian" value="{{ $row->tgl_penggajian }}" disabled>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

    {{-- MEMBUAT PENCARIANNYA --}}
    <script>
        var table_penggajian = $('#table-penggajian').dataTable({
            ordering: false
        })
    </script>
@endsection
