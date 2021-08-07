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
                        <h3>Add a student grade</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('grade.update', [$grade->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="roll_no" class="form-label">Student</label>
                                <select name="student_id" id="" class="form-control @error('student_id') is-invalid @enderror">
                                    <option value="#">Select student</option>
                                @foreach (App\Student::all() as $students)
                                
                                <option value="{{ $students->id }}"  {{ $students->id == $grade->student->id ? 'selected' : '' }}>{{ $students->name}}</option>
                                @endforeach

                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="maths" class="form-label">Mathematics</label>
                                <input type="number" class="form-control @error('maths')
                                    is-invalid
                                @enderror" id="maths" name="maths"
                                    placeholder="mathematics" value="{{ $grade->maths }}">

                                    @error('roll_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="physics" class="form-label">physics</label>
                                <input type="number" class="form-control @error('physics')
                                    is-invalid
                                @enderror" id="physics" name="physics"
                                    placeholder="physics" value="{{ $grade->physics }}">

                                    @error('physics')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="chemistry" class="form-label">Chemistry</label>
                                <input type="number" class="form-control @error('chemistry')
                                    is-invalid
                                @enderror" id="chemistry" name="chemistry"
                                    placeholder="chemistry" value="{{ $grade->chemistry }}">

                                    @error('chemistry')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="botany" class="form-label">Botany</label>
                                <input type="number" class="form-control @error('botany')
                                    is-invalid
                                @enderror" id="botany" name="botany"
                                    placeholder="botany" value="{{ $grade->botany }}">

                                    @error('botany')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="zoology" class="form-label">Zoology</label>
                                <input type="number" class="form-control @error('zoology')
                                    is-invalid
                                @enderror" id="zoology" name="zoology"
                                    placeholder="zoology" value="{{ $grade->zoology }}">

                                    @error('zoology')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Update grades</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
