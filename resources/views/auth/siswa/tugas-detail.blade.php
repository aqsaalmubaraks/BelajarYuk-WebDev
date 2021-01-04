@extends('app-dashboard')

@section('title')
@foreach($tugas as $tg)
Tugas {{ $tg->judul }} | Siswa
@endforeach
@endsection

@section('content')
@foreach($tugas as $tg)
<section>
  <div class="container">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <div class="row nm valign-wrapper">
            <div class="col m2 valign">
              <a class="btn-floating waves-effect waves-light btn-flat" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="col m10">
              <h5>{{ $tg->judul }}</h5>
              <h6>Deadline At {{ date('H:i', strtotime($tg->jam)) }}, {{ date('j F Y', strtotime($tg->deadline)) }}</h6>
            </div>
          </div>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">

      <div class="col s12" style="margin-bottom: 5rem">
        <h6><b>Soal</b></h6>
        <div class="divider"></div>
        <p>{!! $tg->tugas !!}</p>
      </div>

      <div class="col s12">
        <div class="row">

          <div class="col s6">
            <h6><b>Lembar Jawaban</b></h6>
          </div>

          <div class="col s6 right-align">
            @if($cek != 0)
            @foreach($jawaban as $jw)
            @if($jw->nilai == null)
            <a id="btn-edit" class="waves-effect waves-light btn outlined primary"><i class="material-icons left">edit</i>Edit</a>
            <a id="btn-batal" class="waves-effect waves-light btn outlined danger hide"><i class="material-icons left">close</i>Batal Edit</a>
            @else
            
            @endif
            @endforeach
            @endif
          </div>
        </div>

        <div class="divider"></div>

        @if($cek == 0)

        <form action="{{ route('siswa.jawaban.store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="input-field col s12">
              <textarea id="konten" name="jawaban"></textarea>
            </div>
          </div>

          <input type="hidden" name="id_tugas" value="{{ $tg->id }}">
          <input type="hidden" name="id_siswa" value="{{ Auth::guard('siswa')->user()->id }}">

          <div class="row">
            <div class="input-field col s12 right-align">
              <button type="submit" class="waves-effect waves-light btn outlined primary"><i class="material-icons right">send</i>Submit</button>
            </div>
          </div>
        </form>

        @else

        @foreach($jawaban as $jw)
        @if($jw->nilai == null)

        <div id="page-jawaban">
          <div class="center">
            <h5>Jawaban anda telah terkirim <br> Tunggu guru anda mengkoreksi.</h5>
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
          </div>
        </div>

        <div id="form-edit" class="hide">
         @if(Carbon\Carbon::now() >= $tg->deadline)
         <h5>Opps, Pengerjaan telah melewati Batas</h5>
         @else
         <form action="{{ route('siswa.jawaban.edit', $jw->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="input-field col s12">
              <textarea id="konten" name="jawaban">{{ $jw->jawaban }}</textarea>
            </div>
          </div>

          <input type="hidden" name="id_tugas" value="{{ $jw->id_tugas }}">
          <input type="hidden" name="id_siswa" value="{{ $jw->id_siswa }}">

          <div class="row">
            <div class="input-field col s12 right-align">
              <button type="submit" class="waves-effect waves-light btn outlined primary"><i class="material-icons right">send</i>Submit</button>
            </div>
          </div>
        </form>
        @endif
      </div>

      @else


      <div class="row">
        <div class="col s12">
          <p>{!! $jw->jawaban !!}</p>
        </div>
      </div>
      <div class="center">
        <h5>Selamat {{ App\Siswa::where('id', $jw->id_siswa)->value('nama') }} nilai anda </h5>
        <h4 class="primary-text">{{ $jw->nilai }}</h4>
      </div>
      @endif
      @endforeach

      @endif

    </div>

  </div>
</div>
</section>

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

<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-edit").click(function(){
      $("#page-jawaban").addClass('hide');
      $("#btn-edit").addClass('hide');

      $("#form-edit").removeClass('hide');
      $("#btn-batal").removeClass('hide');
    });

    $("#btn-batal").click(function(){
      $("#page-jawaban").removeClass('hide');
      $("#btn-edit").removeClass('hide');

      $("#form-edit").addClass('hide');
      $("#btn-batal").addClass('hide');
    });
  });
</script>
@endsection