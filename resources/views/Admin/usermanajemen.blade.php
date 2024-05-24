@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Basic Data Table</h4>
                <p class="sub-header">
                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                    function: <code>$().DataTable();</code>.
                </p>

                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->gambar }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="#">hapus</a>
                                <a href="#">edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
