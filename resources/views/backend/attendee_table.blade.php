@extends('backend.include.layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading"> Attendee Table</div>
            <div class="row w3-res-tb">
                <label>Company Name</label>
                <input type="text" class="form-control-sm" id="company_name" name="company_name"
                    placeholder="Company Name Filter">
                <button class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                <a class="btn btn-success" id="createNewProduct">CSV</a>
                <a class="btn btn-success" href="{{ route('attendee_registration') }}" style="margin-left:347px;;">New
                    Attendee</a><br>
            </div><br>
            <div class="table-responsive">

                <table class="table table-striped b-t b-light data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Attendee Id</th>
                            <th>Name</th>
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
                    "url": "{{ route('attendee_table') }}",
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
                        data: 'attendee_id',
                        name: 'attendee_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                table.ajax.url("{{ route('attendee_table') }}?company_name=" + companyName).load();
            });

            $('#createNewProduct').click(function() {
                var companyName = $('#company_name').val();
                var csvExportUrl = "{{ route('exportAttendeeCsv') }}?company_name=" + companyName;
                window.location = csvExportUrl;
            });
        });
    </script>
@endsection
