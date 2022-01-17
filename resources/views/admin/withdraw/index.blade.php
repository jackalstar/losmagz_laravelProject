@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
<div class="card-body">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Payment methods</th>
                <th>Account Name</th>
                <th>BSB Number</th>
                <th>Account Number</th>
                <th>PayPal Account</th>
                <th>Available or Withdrawed Points</th>
                <th>Approve</th>
                <th>created at</th>
                <th>completed at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdraws as $key => $withdraw)
                <tr>
                    <td>
                        {{$key + 1}}
                    </td>
                    <td>
                        {{$withdraw->username}}
                    </td>
                    <td>
                        {{$withdraw->email}}
                    </td>
                    <td>
                        {{$withdraw->paymethod}}
                    </td>
                    <td>
                        {{$withdraw->account_name}}
                    </td>
                    <td>
                        {{$withdraw->bsb_number}}
                    </td>
                    <td>
                        {{$withdraw->account_number}}
                    </td>
                    <td>
                        {{$withdraw->paypal_email}}
                    </td>
                    <td>
                        <div id="withdrawed_points{{$withdraw->id}}">
                            {{$withdraw->withdrawpoints}}    
                        </div>
                    </td>
                    <td>
                        <div id="withdraw_approve{{$withdraw->id}}">                        
                            @if ($withdraw->approve == 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif ($withdraw->approve == 'disapproved')
                                <span class="badge badge-primary">Disapproved</span>
                            @else
                                <input type="number" class="form-control card-number" id="withdraw_points{{ $withdraw->id }}" min="0" max="{{$withdraw->withdrawpoints}}" size="20"  value="{{$withdraw->withdrawpoints}}" required>
                                <span class="badge btn badge-success" onclick="withdraw_yes({{ $withdraw->id }})">
                                    yes
                                </span>
                                <span class="badge btn badge-primary" onclick="withdraw_no({{ $withdraw->id }})">
                                    no
                                </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        {{$withdraw->created_at}}
                    </td>
                    <td>
                        <div id="approve_time">
                            @if ($withdraw->approve == 'approved' || $withdraw->approve == 'disapproved')
                                {{$withdraw->updated_at}}
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Payment methods</th>
                <th>Account Name</th>
                <th>BSB Number</th>
                <th>Account Number</th>
                <th>PayPal Account</th>
                <th>Available or Withdrawed Points</th>
                <th>Approve</th>
                <th>created at</th>
                <th>completed at</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
<script>
    
function withdraw_yes($id){
    let form = new FormData();
    var withdraw_id = 'withdraw_points' + $id;
    form.append("id", $id);
    form.append("withdrawing_points", document.getElementById(withdraw_id).value);
    
    $.ajax({
            url: "/withdraw_approve",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);   
            showSuccess("This user's withdraw is approved successfully");
                var var_id = 'withdraw_approve' + data.id;
                document.getElementById(var_id).innerHTML = '<span class="badge badge-success">Approved</span>';
                $("#approve_time").html((data.approve_time).replace("T"," ").replace('.000000Z', ""));
                
                var withdrawed_points = 'withdrawed_points' + data.id;
                document.getElementById(withdrawed_points).innerHTML = data.withdrawed_points;
                
        })
        .catch(function() {
            showError();
            $("#save").attr("disabled", false);
        });
}
function withdraw_no($id){
    let form = new FormData();
    form.append("id", $id);
    $.ajax({
            url: "/withdraw_disapprove",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);   
            showError("This user's withdraw is disapproved");
                var var_id = 'withdraw_approve' + data.id;
                document.getElementById(var_id).innerHTML = '<span class="badge badge-primary">Disapproved</span>';
                $("#approve_time").html((data.approve_time).replace("T"," ").replace('.000000Z', ""));
                
                var withdrawed_points = 'withdrawed_points' + data.id;
                document.getElementById(withdrawed_points).innerHTML = 0;
        })
        .catch(function() {
            showError();
            $("#save").attr("disabled", false);
        });
}

</script>
@endsection
