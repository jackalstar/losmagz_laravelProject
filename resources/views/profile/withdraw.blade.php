@extends('layouts.app')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
  <div style="margin:20px;">
      <h3 class="mb-3">Hi, {{ auth()->user()->username }}!</h3>

      @if (Session::has('success'))
          <div class="alert alert-success text-center" role="alert">
              {{ Session::get('success') }}
          </div>
      @endif

      @if(!$userWithdraw->isEmpty())
      <div class="table-responsive mb-3">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Withdrawed Points</th>
                <th scope="col">PayGateway</th>
                <th scope="col">Account Name</th>
                <th scope="col">BSB Number</th>
                <th scope="col">Account Number</th>
                <th scope="col">Paypal Email</th>
                <th scope="col">Approve</th>
                <th scope="col">Created_at</th>
                <th scope="col">Completed_at</th>
              </tr>
            </thead>
            <tbody>
               @foreach ($userWithdraw as $key => $value)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $value->username }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->withdrawpoints }}</td>
                <td>{{ $value->paymethod }}</td>
                <td>{{ $value->account_name }}</td>
                <td>{{ $value->bsb_number }}</td>
                <td>{{ $value->account_number }}</td>
                <td>{{ $value->paypal_email }}</td>
                <td>{{ $value->approve }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->updated_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      @else
          <p>Your transactions will be displayed here.</p>
      @endif
  </div>
@endsection
