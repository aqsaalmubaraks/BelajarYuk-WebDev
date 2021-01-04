@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Tugas {{ $kl->kelas }} | Guru
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)

@foreach($tugas as $tg)
<ul id="dropdown-menu{{ $tg->id }}" class="dropdown-content">
  <li><a class="modal-trigger" href="#modal-edit-tugas{{ $tg->id }}">Edit</a></li>
  <li><a class="modal-trigger" href="#modal-hapus-tugas{{ $tg->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container">

    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Tugas</h5>
          <h6>{{ $kl->kelas }}</h6>
        </div>

        <div class="col s12 m12 l6 right-align">
          <a class="waves-effect waves-light btn outlined primary modal-trigger" href="#modal-add-tugas"><i class="material-icons right">add</i>New Tugas</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">

      @foreach($tugas as $tg)
      <div class="col s12">
        <a href="{{route('guru.tugas_detail', $tg->id)}}">
          <div class="card outlined">
            <div class="card-title row nm">
              <div class="col s11">
                <div class="title">
                  <h6>{{ $tg->judul }}</h6>
                </div>
              </div>
              <div class="col s1">
                <div class="menu">
                  <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $tg->id }}"><i class="material-icons">more_vert</i></a>
                </div>
              </div>
            </div>

            <div class="card-content ptb-1">
              <div class="row nm">
                <div class="col s12 m12 l6 left-align">
                  Deadline At {{ date('H:i', strtotime($tg->jam)) }}, {{ date('j F Y', strtotime($tg->deadline)) }}
                </div>
                <div class="col s12 m12 l6 right-align">

                  @php
                  $kumpul = App\Jawaban::where('id_tugas', $tg->id)->count();
                  $siswa = App\JoinKelas::where('id_kelas', $kl->id)->count();
                  @endphp

                  <div class="badges flat primary-dark-text">
                    <i class="material-icons">assignment_ind</i><span style="font-size: 14px">{{ $kumpul }} / {{ $siswa }} Mengumpulkan</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach

    </div>
  </div>
</section>


{{-- MODAL --}}
<div id="modal-add-tugas" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>Add Tugas</h5>
      <h6>Nama Tugas</h6>
    </div>
    <div class="col s1 right-align">
      <a class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></a>
    </div>
  </div>
  <div class="modal-content">

    <form action="{{ route('guru.tugas.store') }}" method="POST">
      @csrf
      <div class="row">

        <div class="col s12 m12 l9 row">
          <div class="input-field col s12">
            <input placeholder="" id="judul" type="text" class="validate" name="judul" required="">
            <label for="judul">Judul</label>
          </div>

          <div class="input-field col s12">
            <textarea id="tugas" name="tugas"></textarea>
          </div>
        </div>

        <div class="col s12 m12 l3">
          <div class="input-field col s12">
           <input placeholder="" type="date" id="tanggal" class="validate" name="tanggal" required="">
           <label for="tanggal">Tanggal Deadline</label>
         </div>
         <div class="input-field col s12">
           <input placeholder="" type="time" id="waktu" class="validate" name="waktu" required="">
           <label for="waktu">Waktu Deadline</label>
         </div>
         <div class="input-field col s12 right-align">
          <button type="submit" class="waves-effect waves-light btn outlined primary">Submit</button>
        </div>
      </div>

      <input type="hidden" name="id_kelas" value="{{ $kl->id }}">

    </div>
  </form>
</div>
</div>

@foreach($tugas as $tg)
<div id="modal-edit-tugas{{ $tg->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>Edit Tugas</h5>
      <h6>{{ $tg->judul }}</h6>
    </div>
    <div class="col s1 right-align">
      <a class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></a>
    </div>
  </div>
  <div class="modal-content">

    <form action="{{ route('guru.tugas.edit', $tg->id) }}" method="POST">
      @csrf
      <div class="row">

        <div class="col s12 m12 l9 row">
          <div class="input-field col s12">
            <input placeholder="" id="judul" type="text" class="validate" name="judul" required="" value="{{ $tg->judul }}">
            <label for="judul">Judul</label>
          </div>

          <div class="input-field col s12">
            <textarea id="tugas" name="tugas">{{ $tg->tugas }}</textarea>
          </div>
        </div>

        <div class="col s12 m12 l3">
          <div class="input-field col s12">
           <input placeholder="" type="date" id="tanggal" class="validate" name="tanggal" required="" value="{{ $tg->deadline }}">
           <label for="tanggal">Tanggal Deadline</label>
         </div>
         <div class="input-field col s12">
           <input placeholder="" type="time" id="waktu" class="validate" name="waktu" required="" value="{{ $tg->jam }}">
           <label for="waktu">Waktu Deadline</label>
         </div>
         <div class="input-field col s12 right-align">
          <button type="submit" class="waves-effect waves-light btn outlined primary">Submit</button>
        </div>
      </div>

      <input type="hidden" name="id_kelas" value="{{ $tg->id_kelas }}">

    </div>
  </form>
</div>
</div>


<div id="modal-hapus-tugas{{ $tg->id }}" class="modal small">

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Hapus Tugas</h4>
      </div>
      <br>

      <h6>Anda akan menghapus Tugas {{ $tg->judul }}</h6>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <a href="{{ route('guru.tugas.delete', $tg->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
    </div>

</div>
@endforeach

@endforeach
@endsection

@section('js-plus')
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