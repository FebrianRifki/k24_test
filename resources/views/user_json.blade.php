
<html lang="en">

@include('partials.header')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  @include('partials.navbar')
  @include('partials.sidebar')
    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Json</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div id="json-data">
            @json($jsonData)
        </div>
        </div>
      </div>
 @include('partials.footer')
</body>
</html>
