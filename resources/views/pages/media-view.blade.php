@extends('layouts/contentLayoutMaster')

@section('title', 'Chips')

@section('content')
{{-- Default chips starts --}}
<section id="default-chips">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">
        Default Chips
      </h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <iframe src="{{ asset('uploads/' . $medias->file) }}" frameborder="0" class="media" width="100%" height="1000"
          alt="pdf"></iframe>
        {{-- @if ($medias->extension == 'jpeg')
        <iframe src="{{ asset('uploads/' . $medias->file) }}" frameborder="0" class="media" width="100%" height="1000"
          alt="pdf"></iframe>
        @endif --}}
      </div>
    </div>
  </div>
</section>
{{-- Default chips ends --}}
{{-- Customized Closeable Chips Ends --}}
@endsection
