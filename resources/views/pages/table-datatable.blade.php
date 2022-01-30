@extends('layouts/contentLayoutMaster')

@section('title', 'DataTables')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>
  </div>
</div>

<!-- Zero configuration table -->
<section>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Upload File</h4>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="col-lg-6 col-md-12">
              <form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="basicInputFile">Pilih File</label>
                  <div class="custom-file">
                    <input type="file" class="form-control" id="inputGroupFile01" name="file">
                    <label class="custom-file-label" for="inputGroupFile01">Pilih File</label>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary mr-1 mb-1">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Zero configuration</h4>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table zero-configuration">
                <thead class="text-center">
                  <tr>
                    <th>Name</th>
                    <th>File</th>
                    <th>Extension</th>
                    <th>Size</th>
                    <th>Mime</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @if ($medias->count())
                  @foreach ($medias as $media)
                  <tr>
                    <td>{{ $media->name }}</td>
                    <td>{{ $media->file }}</td>
                    <td>{{ $media->extension }}</td>
                    <td>{{ $media->size }}</td>
                    <td>{{ $media->mime }}</td>
                    <td>{{ $media->created_at }}</td>
                    <td>
                      <form action="" method="post">
                        @csrf
                        <a href="{{ route('media.show', $media->id) }}" class="item-edit" type="button" target="_blank">
                          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit font-small-4">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                          </svg>
                        </a>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Scroll - horizontal and vertical table -->
@endsection
@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/datatables/datatable.js')) }}"></script>
@endsection
