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
            <h1 class="m-0">Create User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
              <div class="card-header">
                <h3 class="card-title">Fill user data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama *</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" id="username" name="username" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Email *</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" id="exampleInputEmail1" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Telepon</label>
                    <input type="text" class="form-control" value="{{ $user->phone_number }}"  id="phonenumber" name="phoneNumber" placeholder="Enter Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor KTP</label>
                    <input type="text" class="form-control" value="{{ $user->ktp_number }}" id="ktpNumber"  name="ktpNumber"placeholder="Enter KTP Number">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" name="gender" data-minimum-results-for-search="Infinity" style="width: 100%;">
                      <option selected="selected">laki-laki</option>
                      <option>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label>Tanggal Lahir</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" value="{{ $user->date_of_birth }}" class="form-control datetimepicker-input" data-target="#reservationdate" name="Dob">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" value="{{ $user->photo }}" class="custom-file-input" id="exampleInputFile" name="photo">
                        <label class="custom-file-label" for="exampleInputFile">Upload Foto</label>
                      </div>
                    </div>
                  </div>
                </div>
                <img id="previewImg" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;">
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 @include('partials.footer')
</body>
</html>
