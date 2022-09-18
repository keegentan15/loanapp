@extends('admin.dashboard_layout')
@section('content')
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-7">
            <nav class="breadcrumb">
                <span class="breadcrumb-item active">Inquiry List</span>
            </nav>
        </div>
        <div class="col-md-5 align-self-center">
            <div class="customize-input float-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="activitylog_options">
                    <option selected="Loan">All</option>
                    <option value="Staff">Unread</option>
                </select>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col" style="width: 10%">ID</th>
            <th scope="col" style="width: 40%">Subject</th>
            <th scope="col" style="width: 10%">Status</th>
            <th scope="col" style="width: 10%">Date</th>
            <th scope="col" style="width: 20%">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($inquiry as $key => $value)
            <tr>
                <th scope="row">{{$value->Inquiry_ID}}</th>
                <td>{{$value->Subject}}</td>
                <td>{{$value->Status}}</td>
                <td>{{$value->created_at}}</td>
                <td>
                    <form action="#" method="POST">   
                        <a class="btn btn-info" href="#">View</a>    
                        @csrf
                        @method('DELETE')      
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    
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