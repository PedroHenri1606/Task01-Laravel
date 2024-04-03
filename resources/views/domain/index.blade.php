@extends('layout.template')

@section('title', 'Index')

@section('content')

@include('layout._partials.navbar')

<div class="container tabela border-light shadow text-center">
  <div class="container">
    <form method="POST" action="{{route ('domain.find')}}" class="row justify-content-end">     
      @csrf
      <div class="col-auto col-md-4 opcoes">
        @is('admin')
          List of all domains
        @else
          Your domains
        @endis
      </div>

      <div class="col-auto align-self-center">
      <input type="text" class="findInput" name="id" placeholder="Enter the ID">
      </div>
      
      <div class="col-auto align-self-center">
        <button class="btn btn-success " type="submit">Find</button>
      </div>

      <div class="col-auto col-md-2 align-self-center">
        <a class="btn btn-success" href="{{route('domain.create')}}" role="button">Add Domain</a>
      </div>
    <form>

    <table class="table mt-2">
      <thead>
        <tr>
          <th class="col item">Id</th>
          <th class="col item">URI</th>
          @is('admin')
          <th class="col item">Publisher</th>
          @endis
          <th class="col item">Ravshare</th>
          <th class="col item">Status</th>
          <th class="col item">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach($domains as $domain)
              <tr>
                <td>{{ $domain->id }}</td>
                <td>{{ $domain->domain }}</td>
                @is('admin')
                <td>{{ $domain->publisher->name }}</td>
                @endis
                <td>{{ $domain->ravshare }}%</td>
                  @if( $domain->status === 1)
                      <td> Active </td>
                  @else
                      <td> Disactive</td>
                  @endif
                <td>
                  <a class="btn btn-outline-success" href="{{ route('domain.edit', ['domain' => $domain])}}" role="button">Edit Domain</a>
                  <a class="btn btn-success" href="{{ route('domain.show', ['domain' => $domain])}}" role="button">Details</a>
                </td>
                </tr>
          @endforeach
      </tbody>
    </table>
    {{ $domains->onEachSide(0)->links()}}
  </div>
</div>

@endsection