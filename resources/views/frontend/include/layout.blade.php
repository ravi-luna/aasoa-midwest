<!DOCTYPE html>

<head>
    @include('frontend.include.head')
</head>

<body class="frontend">
    <section id="container">
        @include('frontend.include.header')

        <!--sidebar start-->
        <!--sidebar end-->

        <section id="main-content">
            <section class="wrapper">
                {{-- <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Exhibitor Table</div>
                        <div class="row w3-res-tb">
                            <label>Company Name</label>
                            <input type="text" class="form-control-sm" id="company_name" name="company_name"
                                placeholder="Company Name Filter">
                            <button class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                            <a class="btn btn-success" id="createNewProduct">CSV</a>
                            <a class="btn btn-success" href="{{ route('exhibitor_registration') }}"
                                style="margin-left:347px;">New Exhibitor</a><br>
                        </div><br>
                        <div class="table-responsive">

                            <table class="table table-striped b-t b-light data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Exhibitor Id</th>
                                        <th>Contact Name</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                @yield('content')
                <!-- footer -->
                @include('frontend.include.footer')
                <!-- / footer -->
            </section>
        </section>
        <!--main content end-->
    </section>
</body>
@yield('datatable')
