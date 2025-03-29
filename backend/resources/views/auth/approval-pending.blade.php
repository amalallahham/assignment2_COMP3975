@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Pending Approval</div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <h4 class="alert-heading">Thank you for registering!</h4>
                        <p>Your account is currently pending approval from an administrator. You will be notified when your account has been approved.</p>
                        <hr>
                        <p class="mb-0">Once approved, you will have full access to contribute articles to our blog.</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 