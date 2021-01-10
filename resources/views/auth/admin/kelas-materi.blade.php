@extends('app-dashboard')

@section('title')
Kelas-Materi | Admin

@endsection

@section('content')
@foreach($kelas as $kl)

@foreach($materi as $mt)
<ul id="dropdown-menu{{ $mt->id }}" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="#modal-edit{{ $mt->id }}">Edit</a></li>
  <li><a class="modal-trigger" href="#modal-hapus{{ $mt->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Kelas {{ $kl->kelas }} - Materi</h5>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-dashboard">
    <div class="row">
      <div class="col s12 m12 l6">
       <div class="input-field nm">
        <i class="material-icons prefix">search</i>
        <input placeholder="Search here" id="input-search" type="text" style="border: 0 !important; margin-bottom: 0">
      </div>
    </div>
    <div class="col s12 m12 l6 right-align">

    </div>
  </div>

  <table id="tabel-materi" class="display">
    <thead>
      <tr>
        <th>Materi</th>
        <th>Created At</th>
        <th style="width: 100px"></th>
      </tr>
    </thead>
    <tbody>

      @foreach($materi as $mt)
      <tr>
        <td><a class="modal-trigger" href="#modal-det{{ $mt->id }}">{{ $mt->judul }}</a></td>
        <td>{{ date('j F Y', strtotime($mt->created_at)) }}</td>
        <td>
          <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $mt->id }}">
            <i class="material-icons">more_vert</i>
          </a>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>
</section>


{{-- MODAL --}}
@foreach($materi as $mt)
<div id="modal-hapus{{ $mt->id }}" class="modal small">

  <div class="modal-content">
    <div class="title-page nm">
      <h4>Hapus Materi</h4>
    </div>
    <br>

    <h6>Anda akan menghapus Materi {{ $mt->judul }} dari kelas {{ $kl->kelas }}</h6>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
    <a href="{{ route('admin.materi.delete', $mt->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
  </div>

</div>

<div id="modal-edit{{ $mt->id }}" class="modal modal-full">
  <form action="{{ route('admin.materi.edit', $mt->id) }}" method="POST">
    @csrf

    <div class="modal-header row">
      <div class="col s11">
        <h5>Edit Materi</h5>
      </div>
      <div class="col s1 right-align">
        <a class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></a>
      </div>
    </div>
    <div class="modal-content">
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="" id="judul" type="text" class="validate" name="judul" required="" value="{{ $mt->judul }}">
          <label for="judul">Judul</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <textarea id="materi" name="materi">{{ $mt->materi }}</textarea>
        </div>
      </div>

      <input type="hidden" name="id_kelas" value="{{ $mt->id_kelas }}">

      <div class="row">
        <div class="input-field col s12 right-align">
          <button type="submit" class="waves-effect waves-light btn outlined primary">Submit</button>
        </div>
      </div>
    </div>

  </form>
</div>

<div id="modal-det{{ $mt->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>{{ $mt->judul }}</h5>
    </div>
    <div class="col s1 right-align">
      <a class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></a>
    </div>
  </div>
  <div class="modal-content">
    {!! $mt->materi  !!}
  </div>
</div>

@endforeach

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#tabel-materi').DataTable({
      "dom": 
      "<'row'<'col s12 m12 l12'tr>>",

      buttons: [
      {
        extend: 'excelHtml5'
      },
      {
        extend: 'pdfHtml5'
      },
      ],

    });

    tabelsearch = $('#tabel-materi').DataTable();
    $('#input-search').keyup(function(){
      tabelsearch.search($(this).val()).draw();
    });

    $("#ExportPDF").on("click", function() {
      table.button( '.buttons-pdf' ).trigger();
    });

    $("#ExportExcel").on("click", function() {
      table.button( '.buttons-excel' ).trigger();
    });
  });
</script>

<script src="https://cdn.tiny.cloud/1/naiean50arcvcg7c4k08y4vbuuu0sg1n4s3q5jyab04r7rhi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: "textarea",
    menubar: false,
    plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table paste",
    "autoresize"
    ],

    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',

    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

    file_picker_callback: function (cb, value, meta) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');


      input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {

          var id = 'blobid' + (new Date()).getTime();
          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);

          cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
      };

      input.click();
    }
  });

  $.extend(M.Modal.prototype, {
    _handleFocus(e) {
      if (!this.el.contains(e.target) && this._nthModalOpened === M.Modal._modalsOpen && document.defaultView.getComputedStyle(e.target, null).zIndex < 1002) {
        this.el.focus();
      }
    }
  });
</script>
@endsection