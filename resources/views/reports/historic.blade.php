@extends('layout.template')

@section('title', 'Index')

@section('content')

<div class="container tabela border-light shadow text-center">
    <div class="container">
        <div class="row justify-content-center">

        <div class="col-auto opcoes">
          Historic of Domain
        </div>

    </div>

    <table class="table mt-2 border-light shadow text-center mt-4">
        <thead>
            <tr>
                <th class="col">
                    <a class="item">Id</a>
                </th>

                <th class="col">
                    <a class="item">Domain</a>
                </th>

                <th class="col">
                    <a class="item">Total Impressions</a>
                </th>

                <th class="col">
                    <a class="item">CPM</a>
                </th>

                <th class="col">
                    <a class="item">RPM</a>
                </th>

                <th class="col">
                    <a class="item">Revenue</a>
                </th>

                <th class="col">
                    <a class="item">Data Create</a>
                </th>

                <th class="col">
                    <a class="item">Actions</a>
                </th>
            </tr>
      </thead>
      <tbody>
          @foreach($revenuesDomain as $revenueDomain)
            <tr>
                <td>{{ $revenueDomain->id }}</td>
                <td>{{ $domain->domain }}</td>
                <td>{{ $revenueDomain->impressions }}</td>
                <td>${{ $revenueDomain->cpm }}</td>
                <td>${{ $revenueDomain->rpm }}</td>
                <td>${{ $revenueDomain->revenue }}</td>
                <td>{{ $revenueDomain->created_at }}</td>
                <td>
                    <form id="form_{{$revenueDomain}}" method="post" action="{{ route('reports.delete', ['revenueDomain' => $revenueDomain])}}">
                    @method('DELETE')
                    @csrf
                        <a class="btn btn-outline-success" href="#" onclick="document.getElementById('form_{{$revenueDomain}}').submit()">Delete</a>
                    </form>
                </td>
            </tr>
          @endforeach
      </tbody>
    </table>

    <div class="container text-center mt-5">
        <a class="btn btn-outline-success" href="{{ route('reports.index')}}" role="button">Return</a>
    </div>
  </div>
</div>

@endsection

