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

    <form action="{{ route('inquiry')}}" method="GET">
        <div class="row">
            <div class="col-md-5">
                Sample Data - Total Records - <b><span id="total_records">{{ count($inquiry)}}</span></b>
            </div>
            <div class="col-md-5">
                <div class="input-group input-daterange">
                    <input type="text" name="from_date" id="from_date" readonly class="form-control" value="{{ request()->from_date }}">
                    <div class="input-group-addon">
                        to
                    </div>
                    <input type="text" name="to_date" id="to_date" readonly class="form-control" value="{{ request()->to_date }}"> 
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary" title="Search">Search</button>
            </div>
        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col" style="width: 10%">Inquiry_ID</th>
            <th scope="col" style="width: 40%">Subject</th>
            <th scope="col" style="width: 10%">Status</th>
            <th scope="col" style="width: 20%">Date</th>
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
                    <form action="{{ route('inquiry-destroy',$value->Inquiry_ID) }}" method="POST">   
                        <a class="btn btn-info" href="{{route('inquiry-view',$value->Inquiry_ID)}}">View</a>    
                        @csrf
                        @method('DELETE')      
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{csrf_field()}}
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

    $(document).ready(function(){
        var date = new Date();

        $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
        });

    })

</script>
@endpush