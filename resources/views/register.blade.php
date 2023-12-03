<!DOCTYPE html>
<html lang="en">

@include('partials.header')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
    @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{ route('register') }}" method="POST">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="text" class="form-control" id="ktpnumber" name="ktpNumber" placeholder="Enter KTP Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control select2 " name="gender" data-minimum-results-for-search="Infinity" style="width: 100%;">
                        <option selected="selected">laki-laki</option>
                        <option>Perempuan</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" name="Dob" class="form-control datetimepicker-input" data-target="#reservationdate">
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
          </div>

      </div>
        <div class="input-group mb-3">
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFile" name="photo">
              <label class="custom-file-label" for="exampleInputFile">Upload photo</label>
              
            </div>
            <!-- <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div> -->
          </div>
        </div>
        <img id="previewImg" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;">
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{url('/')}}/assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/assets/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/assets/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="{{url('/')}}/assets/js/select2.full.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/assets/js/moment.min.js"></script>
<script src="{{url('/')}}/assets/js/daterangepicker.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/assets/js/jquery.overlayScrollbars.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/')}}/assets/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/assets/js/adminlte.js"></script>
<script src="{{url('/')}}/assets/js/jquery.inputmask.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

     //Date range as a button
     $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    $('#exampleInputFile').on('change', function() {
        previewFile(this);
    });
    
    function previewFile() {
    const preview = document.getElementById('previewImg');
    const file = document.getElementById('exampleInputFile').files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

});
</script>
</body>

</html>