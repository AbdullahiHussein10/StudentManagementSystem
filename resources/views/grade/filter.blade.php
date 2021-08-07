@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>         
    @endif
    <div class="row">
       
</div>
      
        <table class="table table-striped mt-3">
            <thead>
              <tr>
                <th scope="col" style="font-size: 20px">#</th>
                <th scope="col" style="font-size: 20px">Name</th>
                <th scope="col" style="font-size: 20px">Mathematics (%)</th>
                <th scope="col" style="font-size: 20px">Physics (%)</th>
                <th scope="col" style="font-size: 20px">Chemistry (%)</th>
                <th scope="col" style="font-size: 20px">Botany (%)</th>
                <th scope="col" style="font-size: 20px">Zoology (%)</th>
                <th scope="col" style="font-size: 20px">Class</th>
                <th scope="col" style="font-size: 20px">Engineering Cut off</th>
                <th scope="col" style="font-size: 20px">Medical Cut off</th>
                <th scope="col" style="font-size: 20px">% Secured</th>
                <th scope="col" style="font-size: 20px">Actions</th>
              </tr>
            </thead>
            <tbody>
                @if ($dataCount > 0)
                    
                @foreach ($filterData as $key=>$grade)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->maths }}</td>
                <td>{{ $grade->physics }}</td>
                <td>{{ $grade->chemistry }}</td>
                <td>{{ $grade->botany }}</td>
                <td>{{ $grade->zoology }}</td>
                <td>{{ $grade->class }}</td>
                <td>{{ $grade->engineering_cut_off }}</td>
                <td>{{ $grade->medical_cut_off }}</td>
                <td>{{ $grade->final }}</td>

                <td>
                    <a href="{{ route('grade.edit', [$grade->id]) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="{{ route('grade.destroy', [$grade->id]) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach

              @else
              <tr>
              <td>
                No data found
            </td>
        </tr>
              @endif
            </tbody>
          </table>
    </div>
</div>

  @endsection