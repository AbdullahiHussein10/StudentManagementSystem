@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>         
    @endif
    <div class="row">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" style="font-size: 20px">#</th>
                <th scope="col" style="font-size: 20px">Name</th>
                <th scope="col" style="font-size: 20px">Roll Number</th>
                <th scope="col" style="font-size: 20px">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach (App\Student::all() as $key=>$students)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $students->name }}</td>
                <td>{{ $students->roll_no }}</td>
                <td>
                    <a href="{{ route('student.edit', [$students->id]) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="{{ route('student.destroy', [$students->id]) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>

  @endsection