<!DOCTYPE html>
<html lang="en">

@include('partials.header')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  @include('partials.navbar')
  @include('partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      @if($userData->role == 'Admin')
         <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
            <a href="{{ route('user.create') }}"><button type="button" class="btn btn-block btn-primary">Create User</button></a>  
            </div>
         </div>
        @endif
         <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Foto</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat Email</th>
                      <th>Jenis Kelamin</th>
                      <th>Nomor Telepon</th>
                      <th>Nomor KTP</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($userData->role == 'Admin')
                  @foreach($users as $user)
                  <tr>
                      <td>{{$user->name}}</td>
                      <td><img src="{{ url('/storage/photos/' . $user->photo) }}" alt="Foto Pengguna" style="max-width: 200px; max-height: 200px;"></td>
                      <td>{{$user->date_of_birth}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->gender}}</td>
                      <td>{{$user->phone_number}}</td>
                      <td>{{$user->ktp_number}}</td>
                      <td>  
                        <div class="row">
                          <div class="col-md-6">
                              <a href="{{ route('user.edit', ['id'=>$user->id]) }}"><button type="button" class="btn btn-block btn-dark btn-xs">Edit</button></a> 
                          </div>
                          <div class="col-md-6">
                             <button type="button" class="btn btn-block btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">Hapus</button>
                          </div> 
                        </div> 
                      </td>
                    </tr>
                  @endforeach
                  @else
                  <tr>
                      <td>{{$users->name}}</td>
                      <td><img src="{{ url('storage/photos/' .  $users->photo) }}" alt="Foto Pengguna" style="max-width: 200px; max-height: 200px;"></td>
                      <td>{{$users->date_of_birth}}</td>
                      <td>{{$users->email}}</td>
                      <td>{{$users->gender}}</td>
                      <td>{{$users->phone_number}}</td>
                      <td>{{$users->ktp_number}}</td>
                      <td>  
                        <div class="row">
                          <div class="col-md-12">
                              <a href="{{ route('user.edit', ['id'=>$users->id]) }}"><button type="button" class="btn btn-block btn-dark btn-xs">Edit</button></a> 
                          </div>
                        </div> 
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
              @if($userData->role == 'Admin')
                <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-light">Hapus</button>
                </form>
              @else
              <form action="{{ route('user.delete', ['id' => $users->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-light">Hapus</button>
                </form>
                @endif
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    
 @include('partials.footer')
</body>
</html>
