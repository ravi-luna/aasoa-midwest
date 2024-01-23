@extends('backend.include.layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading"> Exhibitor Table</div>
            <div class="row w3-res-tb">
                <label>Company Name</label>
                <input type="text" class="form-control-sm" id="company_name" name="company_name"
                    placeholder="Company Name Filter">
                <button class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                <a class="btn btn-success" id="createNewProduct">CSV</a>
                <a class="btn btn-success" href="{{ route('exhibitor_registration') }}" style="margin-left:347px;">New
                    Exhibitor</a><br>
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
    </div>

    </section>
@endsection
@section('datatable')
    <script type="text/javascript">
        $(function() {

            //  Pass Header Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Render DataTable
            var table = $('.data-table').DataTable({
                ajax: {
                    "url": "{{ route('exhibitor_table') }}",
                    "type": "get"
                },
                processing: true,
                serverSide: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'exhibitor_id',
                        name: 'exhibitor_id'
                    },
                    {
                        data: 'contact_name',
                        name: 'contact_name'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'contact_email',
                        name: 'contact_email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#applyFilterBtn').click(function() {
                var companyName = $('#company_name').val();

                // Reload DataTable with applied filters
                table.ajax.url("{{ route('exhibitor_table') }}?company_name=" + companyName).load();
            });

            $('#createNewProduct').click(function() {
                var companyName = $('#company_name').val();
                var csvExportUrl = "{{ route('exportExhibitorCsv') }}?company_name=" + companyName;
                window.location = csvExportUrl;
            });
        });
    </script>
@endsection
