@extends('layout.template')

@section('title', 'Create')

@section('content')

@include('layout._partials.navbar')


<div class= "container tabela border-light shadow text-center">
    <div class="container">
        <div class="opcoes">
            User Add
        </div>

        <form method="post" action="{{ route('user.store')}}">
            @csrf
            <div class="row">
                <div class="row mb-2">
                    <label for="name" class="col dado">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $user->name ?? old('name')}}" name="name" class="form-control " placeholder="Name">
                        {{ $errors->has('name') ? $errors->first('name') : ''}}  
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="email" class="col dado">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" value="{{ $user->email ?? old('email')}}" name="email" class="form-control " placeholder="Email">
                        {{ $errors->has('email') ? $errors->first('email') : ''}}
                    </div>
                </div> 

                <div class="row mb-2">
                    <label for="password" class="col dado">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" value="{{ $user->password ?? old('password')}}" name="password" class="form-control " placeholder="Password">
                        {{ $errors->has('password') ? $errors->first('password') : ''}}
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="role_id" class="col dado">Role:</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" > {{ $role->name}} </option> 
                            @endforeach                         
                        </select>
                        {{ $errors->has('role_id') ? $errors->first('role_id') : ''}}
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="status" class="col dado">Status:</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status">
                            <option> -- Select Status -- </option>
                            <option value="1"> Active </option>
                            <option value="2"> Disable </option>  
                        </select>
                        {{ $errors->has('status') ? $errors->first('status') : ''}}
                    </div>
                </div>
            </div>     
            <div class="mt-4">  
                <a class="btn btn-outline-success" href="{{route('user.index')}}" role="button">Return</a>
                <button type="submit" class="btn btn-success" >Create</button>
            </div>
        </form>
    </div>
</div>


@endsection

     