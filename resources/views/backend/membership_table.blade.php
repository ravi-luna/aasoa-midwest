@extends('backend.include.layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading"> Membership Table</div>
            <div class="row w3-res-tb">
                <label>Bussiness Name</label>
                <input type="text" class="form-control-sm" id="bussiness_name" name="bussiness_name"
                    placeholder="Bussiness Name Filter">
                <button class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                <a class="btn btn-success" id="createNewProduct">CSV</a>
                <a class="btn btn-success" href="{{ route('assign_membership') }}" style="margin-left:319px;">New
                    Membership</a><br>
            </div><br>
            <div class="table-responsive">

                <table class="table table-striped b-t b-light data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Member Id</th>
                            <th>Corporation Name</th>
                            <th>Bussiness Name</th>
                            <th>Contact Name</th>
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
                    "url": "{{ route('membership_table') }}",
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
                        data: 'membership_id',
                        name: 'membership_id'
                    },
                    {
                        data: 'corporation_name',
                        name: 'corporation_name'
                    },
                    {
                        data: 'bussiness_name',
                        name: 'bussiness_name'
                    },
                    {
                        data: 'contact_person_name',
                        name: 'contact_person_name'
                    },
                    {
                        data: 'email_id',
                        name: 'email_id'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'bussiness_address',
                        name: 'bussiness_address'
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
                var bussinessName = $('#bussiness_name').val();

                // Reload DataTable with applied filters
                table.ajax.url("{{ route('membership_table') }}?bussiness_name=" + bussinessName).load();
            });

            $('#createNewProduct').click(function() {
                var bussinessName = $('#bussiness_name').val();
                var csvExportUrl = "{{ route('exportMembershipCsv') }}?bussiness_name=" + bussinessName;
                window.location = csvExportUrl;
            });
        });
    </script>
@endsection
