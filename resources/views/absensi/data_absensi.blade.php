@extends('layout.master')

@section('content')
        <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Data Gaji</h1>
                  </div><!-- /.col -->
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Data Absensi</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
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
              <!-- Button trigger modal -->
              @can('update role')
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah +
              </button>
              @endcan

              <!-- Modal -->
              <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Absensi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/insertdata_penggajian" method="POST" enctype="multipart/form-data">
                     @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Id Pegawai</label>
                            <input type="text" name="id_pegawai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                            <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kehadiran</label>
                            <select class="form-select" name="kehadiran"
                                aria-label="Default select example">
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
                        
            </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div> 

              
                <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-dark" role="alert">
                      {{$message}}
                    </div>
                @endif

                

                             <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-responsive-md table-hover" id="table-penggajian">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Id Pegawai</th>
                      <th class="text-center">Devisi</th>
                      <th class="text-center">Kehadiran</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                  $no = 1;
                  $a= 1;
                  $b = 1;
                  @endphp
                  @foreach($data as $row)
                    <tr class="text">
                      <th scope="row">{{ $no++}}</th>
                      <td>{{ $row->pegawais->nama_pegawai }}</td>
                      <td>{{ $row->devisis->nama_devisi }}</td>
                      <td>{{ $row->kehadiran }}</td>
                      <td>{{ date('d-m-Y', strtotime($row->tanggal))
                        }}</td>
                      <td>
                            <!-- Button trigger modal -->
                            @can('update role')
                           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $a++ }}">
                              <i class="far fa-edit"></i>
                            </button>
                            @endcan

                          <!-- Modal Edit -->
                          <div class="modal fade" id="exampleModal{{$b++}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Absensi</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/updatedata_penggajian/{{$row->id}}" method="POST" 
                                enctype="multipart/form-data">
                                {{-- <form action="/updatedata" method="POST" enctype="multipart/form-data">  --}}
                                <div class="modal-body">
                                  {{-- CODE UNTUK TAMPILAN POP UP --}}
                                   

                                    @csrf
                                  <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Nama Pegawai</label>
                                      <input type="text" name="id_pegawai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->id_pegawai}}">
                                  </div>
                                  <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Nama Devisi</label>
                                      <input type="text" name="id_devisi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $row->nama_devisi}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kehadiran</label>
                                    <select class="form-select" name="kehadiran"
                                        aria-label="Default select example">
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
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>  
                        <div class="btn-group">
                        @can('delete role')
                              <a href="/deletedata_penggajian/{{ $row->id }}" class="btn btn-danger mt-3 delete"><i class="fas fa-trash-alt"></i></a>
                              
                        @endcan
                        </div>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success mt-2 detail"
                              data-bs-toggle="modal"
                              data-bs-target="#modalDetail{{ $row->id }}">
                              <i class="fas fa-eye"></i>
                          </button>
                      </div>
                      <!-- Modal Detail -->
                      <div class="modal fade" id="modalDetail{{ $row->id }}"
                          tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail
                                          Data Gaji</h5>
                                  </div>
                                  <div class="modal-body">
                                      {{-- CODE UNTUK TAMPILAN POP UP --}}
                                      <div class="mb-3">
                                          <label for="devisi"
                                              class="form-label">Nama Pegawai</label>
                                          <input type="text" name="id_pegawai"
                                              class="form-control"
                                              id="id_pegawai"
                                              value="{{ $row->pegawais->nama_pegawai }}" disabled>
                                      </div>
                                      <div class="mb-3">
                                          <label for="id_devisi"
                                              class="form-label">Nama Devisi</label>
                                          <input type="text" name="id_devisi"
                                              class="form-control"
                                              id="id_devisi"
                                              value="{{ $row->devisis->nama_devisi }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kehadiran"
                                                class="form-label">Kehadiran</label>
                                            <input type="text" name="kehadiran"
                                                class="form-control"
                                                id="kehadiran"
                                                value="{{ $row->kehadiran }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal"
                                            class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal"
                                            class="form-control"
                                            id="tanggal"
                                            value="{{ $row->tanggal }}" disabled>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      </td>
                    </tr>
                    @endforeach
                    
                    
                    </div>
                    </div>

                         
                    <!-- Option 1: Bootstrap Bundle with Popper -->
                  <script>"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"</script>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

            <script src="https://unpkg.com/sweetaalert/dist/sweetalert.min.js"></script>
                  </tbody>
                 <script> 
                        $('.delete').click(function(e){
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
                </table> 
             </div> 
            </div>
          </div> 
        </div> 
              


  {{-- MEMBUAT PENCARIANNYA --}}
  <script>
    var table_penggajian = $('#table-penggajian').dataTable({
      ordering: false
    })

  </script>

@endsection
