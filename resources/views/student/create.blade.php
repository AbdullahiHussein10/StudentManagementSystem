@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>         
                    @endif
                    <div class="card-header">
                        <h3>Add a student</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Student Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="student name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="roll_no" class="form-label">Roll Number</label>
                                <input type="text" class="form-control @error('roll_no')
                                    is-invalid
                                @enderror" id="roll_no" name="roll_no"
                                    placeholder="roll number">

                                    @error('roll_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Create student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
