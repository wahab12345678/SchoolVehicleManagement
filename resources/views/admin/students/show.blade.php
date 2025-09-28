@extends('admin.includes.main')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Student Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a>
                                </li>
                                <li class="breadcrumb-item active">Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Basic Information</h5>
                                        <div class="mt-1">
                                            <p><strong>Name:</strong> {{ $student->name }}</p>
                                            <p><strong>Roll Number:</strong> {{ $student->roll_number ?? '-' }}</p>
                                            <p><strong>Class:</strong> {{ $student->class ?? '-' }}</p>
                                            <p><strong>Guardian:</strong> {{ optional($student->guardian->user)->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.students.index') }}" class="btn btn-primary mt-2">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
