@extends('layout.template')

@section('title', 'Edit')

@section('content')

@include('layout._partials.navbar')


<div class= "container tabela border-light shadow text-center">
    <div class="container">
        <div class="opcoes">
            Domain Edit
        </div>

        <form method= "post" action="{{ route('domain.update', ['domain' => $domain->id])}}" >
        @csrf
        @method('PUT')
            <div class="row">

                <div class="row mb-2">
                    <label for="name" class="col dado">Domain:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $domain->domain ?? old('name')}}" name="domain" class="form-control " placeholder="Domain">
                    </div>
                </div>

                @is('admin')
                <div class="row mb-2">
                    <label for="publisher_id" class="col dado">Publisher:</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="publisher_id">
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}"> {{ $publisher->name}} </option> 
                            @endforeach                         
                        </select>
                    </div>
                </div>
                @endis

                <div class="row mb-2">
                        <label for="revshare" class="form-label col dado">Revshare:</label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ $domain->revshare ?? old('revshare')}}" name="revshare"class="form-control" max="100">
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="nome" class="col dado">Status:</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status">
                            <option value="{{$domain->status}}"> 
                                @if ($domain->status === 1)
                                    Active
                                @else 
                                    Disactive
                                @endif
                            </option>
                            <option> -- Select Status -- </option>
                            <option value="1"> Active </option>
                            <option value="2"> Disable </option>  
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <a class="btn btn-outline-success" href="{{route('domain.index')}}" role="button">Return</a>
                <button type="submit" class="btn btn-success" >Edit</button>
            </div>
        </form>
    </div>
</div>


@endsection

     