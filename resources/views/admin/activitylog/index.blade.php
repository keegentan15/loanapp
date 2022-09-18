@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-7">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Activity Log List</span>
            </nav>
        </div>
        <div class="col-md-5 align-self-center">
            <div class="customize-input float-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="activitylog_options">
                    <option selected="Loan">Loan</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
        <div class = "table-responsive">
        <table id = "user_table" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Content</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody id="loan_data">
                    @foreach ($report_data as $key => $value)
                        <tr>
                            <td>{{ $value->Staff_ID}}</td>
                            <td>{{ $value->Username }}</td>
                            <td>{{ $value->Action }}</td>
                            <td>{{ $value->Content }}</td>
                            <td>{{ $value->created_at }}</td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

$('#activitylog_options').on('change', function() {
    if ((this.value) == "Loan" ) {
        $('#loan_data').show();    }
    else if ((this.value) == "Staff" ) {
        $('#loan_data').hide();    
    }
  
});
</script>
@endpush