@extends('layout')
@section('content')

            @if (session('status'))
              <div class="alert alert-success">
                {{session('status')}}
              </div>
            @endif
            @if (session('filed'))
              <div class="alert alert-danger">
              {{session('filed')}}
              </div>
            @endif
<div class="card">
    <div class="card-header">
   <marquee behavior="" direction=""><strong>INI HALAMAN DATA BARANG</strong></marquee>
    </div>
    <div class="card-header">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
      data-target="#insert"><i class="fa fa-plus"></i>Tamabah Data</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>                  
          <tr>
            <th style="width: 10px">#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th style="width: 200px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach ($data as $item)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$item->kode_barang}}</td>
            <td>{{$item->nama_barang}}</td>
            <td>{{$item->harga_barang}}</td>
            <td>
              <a  data-toggle="modal" data-target="#edit-{{$item->id}}" 
                title="edit"  class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
              <a  data-toggle="modal" data-target="#delete-{{$item->id}}" 
                title="delete"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</a>  
            </td>
          </tr>   
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
      </div>
</div>

{{-- MODAL INSERT--}}
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/barang/store" method="POST" class="form-horizontal">
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Kode Barang:</label>
            <input type="text" class="form-control" id="recipient-name" name="kode_barang">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="recipient-name" name="nama_barang">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Harga Barang:</label>
            <input type="text" class="form-control" id="recipient-name" name="harga_barang">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Delete-->
@foreach ($data as $row)
<div class="modal fade" id="delete-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DELETE</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <caption>Apakah anda yakin ingin menghapus data {{$row->kode_barang}} ?</caption>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{url('/del_barang'.$row->id)}}" type="submit" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>  
@endforeach
<!-- Modal edit-->
@foreach ($data as $up)
<div class="modal fade" id="edit-{{$up->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <form action="{{url('/edit_barang'.$up->id)}}" method="POST" class="form-horizontal">
            @csrf
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Kode Barang:</label>
              <input type="text" class="form-control" id="recipient-name" name="kode_barang" readonly value="{{$up->kode_barang}}">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Nama Barang:</label>
              <input type="text" class="form-control" id="recipient-name" name="nama_barang" value="{{$up->nama_barang}}">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Harga Barang:</label>
              <input type="text" class="form-control" id="recipient-name" name="harga_barang" value="{{$up->harga_barang}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>   
@endforeach

@endsection