@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @guest
                    <div class="card-header">Please login for usage Task Management</div>
                @else
                    <img src="https://www.ntaskmanager.com/wp-content/uploads/2021/02/Task-management-vs-project-management.jpg" alt="">
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
