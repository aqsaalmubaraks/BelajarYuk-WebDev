@extends('app-dashboard')

@section('title')
@foreach($tugas as $tg)
Tugas {{ $tg->judul }} | Guru
@endforeach
@endsection

@section('content')
@foreach($tugas as $tg)

<ul id="dropdown-export" class="dropdown-content">
  <li><a id="ExportPDF" href="#!">PDF</a></li>
  <li><a id="ExportExcel" href="#!">Excel</a></li>
</ul>

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
              <h6>Created At 19 June 2020</h6>
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
        <p>
          {!! $tg->tugas !!}
        </p>
      </div>

      <div class="col s12">
        <div class="row nm">
          <div class="col s12 m12 l6">
            <h6><b>Data Pengumpulan</b></h6>
          </div>
          <div class="col s12 m12 l6 pdr-0">
            <div class="input-field nm">
              <i class="material-icons prefix">search</i>
              <input placeholder="Search here" id="input-search" type="text" class="nbr mb-0">
            </div>
          </div>
        </div>

        <div class="divider"></div>

        @php
        $semua_sudah = App\Jawaban::where('id_tugas', $tg->id)->count();
        $semua = App\JoinKelas::where('id_kelas', $tg->id_kelas)->count();

        $stk = App\Jawaban::where('id_tugas', $tg->id)->where('nilai', null)->count();
        $sss = $semua_sudah - $stk;
        $blm = $semua - $semua_sudah;
        @endphp

        <div style="margin: 2rem 0">
          <div class="row nm">
            <div class="col s12 m12 l6">
              <div class="row nm">
                <div class="col s3">
                  <i class="material-icons red-text text-lighten-5" style="font-size: 11px; padding-right: 4px">lens</i>{{ $blm }}
                </div>
                <div class="col s3">
                  <i class="material-icons green-text text-lighten-5" style="font-size: 11px; padding-right: 4px">lens</i>{{ $sss }}
                </div>
                <div class="col s3">
                  <i class="material-icons blue-grey-text text-lighten-5" style="font-size: 11px; padding-right: 4px">lens</i>{{ $stk }}
                </div>
              </div>
            </div>
            <div class="col s12 m12 l6 right-align">
              <a href="#!" data-target="dropdown-export" class="waves-effect waves-light btn outlined primary dropdown-trigger"><i class="material-icons left">description</i>Rekap</a>
            </div>
          </div>
        </div>

        <table id="tabel-siswa" class="display">
          <thead>
            <tr>
              <th style="width: 350px">Siswa</th>
              <th>Status</th>
              <th>Nilai</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>

            @foreach($siswa as $sw)

            @php
            $ceksis = App\Jawaban::where('id_siswa', $sw->id)->where('id_tugas', $tg->id)->count();
            $cekjwb = App\Jawaban::where('id_siswa', $sw->id)->where('id_tugas', $tg->id)->where('nilai', null)->count();
            @endphp

            @if($ceksis == 0)
            <tr class="red lighten-5">
              <td>
                <div class="img-wtext">
                  <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                  <div class="text">
                    <b>{{ $sw->nama }}</b><br>{{ $sw->nis }}
                  </div>
                </div>
              </td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>

            @else

            @foreach($jawaban as $jw)
            @if($cekjwb != 0)
            <tr class="blue-grey lighten-5">
              <td>
                <div class="img-wtext">
                  <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                  <div class="text">
                    <b>{{ $sw->nama }}</b><br>{{ $sw->nis }}
                  </div>
                </div>
              </td>
              <td>Sudah</td>
              <td>Belum Dikoreksi</td>
              <td><a class="waves-effect waves-light btn outlined modal-trigger" href="#modal-jawaban{{ $jw->id }}">Jawaban</a></td>
            </tr>
            @else
            <tr class="green lighten-5">
              <td>
                <div class="img-wtext">
                  <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                  <div class="text">
                    <b>{{ $sw->nama }}</b><br>{{ $sw->nis }}
                  </div>
                </div>
              </td>
              <td>Sudah</td>
              <td>{{ $jw->nilai }}</td>
              <td><a class="waves-effect waves-light btn outlined modal-trigger" href="#modal-jawaban{{ $jw->id }}">Jawaban</a></td>
            </tr>
            @endif
            @endforeach

            @endif

            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>


{{-- MODAL --}}
@foreach($jawaban as $jw)
<div id="modal-jawaban{{ $jw->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>Jawaban Tugas {{ $tg->judul }}</h5>
      <h6>{{ App\Siswa::where('id', $jw->id_siswa)->value('nama') }} | {{ date('H:i, j F Y', strtotime($jw->created_at)) }}</h6>
    </div>
    <div class="col s1 right-align">
      <button class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></button>
    </div>
  </div>
  <div class="modal-content">
    <div class="container">
      <h6><b>Jawaban</b></h6>
      <p>
        {!! $jw->jawaban !!}
      </p>

      <div class="divider"></div>

      <form action="{{ route('guru.jawaban.nilai', $jw->id) }}" method="POST">
        @csrf
        <div class="row">
          <div class="col s12 m12 l8">
            <p>
              <label>
                <input id="yakin" type="checkbox" />
                <span>Apakah anda yakin telah mengkoresksi pekerjaan ini ?</span>
              </label>
            </p>
          </div>

          <div class="col s12 m12 l4">
            <div class="input-field">
              <input id="nilai" type="number" class="validate" min="0" max="100" required="" disabled="disabled" name="nilai" value="{{ $jw->nilai }}">
              <label for="nilai">Nilai</label>
            </div>

            <input type="hidden" name="id_tugas" value="{{ $jw->id_tugas }}">
            <input type="hidden" name="id_siswa" value="{{ $jw->id_siswa }}">
            <input type="hidden" name="jawaban" value="{{ $jw->jawaban }}">

            <div class="input-field right-align">
              <button id="btn-send" type="submit" class="waves-effect waves-light btn outlined primary" disabled="disabled"><i class="material-icons right">send</i>Submit</button>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>
@endforeach

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  $(document).ready( function () {
    var titlec = "nama Tugas";
    var kelas = "Nama Kelas";
    var guru = "Nama Guru";
    var created = "";
    var deadline = "";

    var table = $('#tabel-siswa').DataTable({
      "dom": 
      "<'row'<'col s12 m12 l12'tr>>" +
      "<'row'<'col s12 m12 l5'><'col s12 m12 l7'p>>",

      buttons: [
      {
        extend: 'excelHtml5',
        exportOptions: {
          columns: [ 0, 1, 2 ]
        }
      },
      {
        extend: 'pdfHtml5',
        pageSize: 'A4',
        filename: 'Rekap Tugas '+titlec,
        title: ' ',
        message: ' ',
        exportOptions: {
          columns: [ 0, 1, 2 ],
        },

        customize: function (doc) {
          doc.styles.tableHeader = {
            color: 'black',
            background: '#fff',
            alignment: 'center',
          };

          doc.content[2].table.widths = 
          Array(doc.content[2].table.body[0].length + 1).join('*').split('');

          var rdoc = doc;
          var rcout = doc.content[doc.content.length - 1].table.body.length - 1;
          var now = new Date();
          var jsDate = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear() + ', ' +now.getHours() + ':' + now.getMinutes();

          var sum_bm = 0;
          var sum_bd = 0;
          var sum_sm = 0;

          for (var i = 0; i < rcout; i++) {
            var obj = doc.content[doc.content.length - 1].table.body[i + 1];

            doc.content[doc.content.length - 1].table.body[(i + 1)][0] = { 
              text: obj[0].text,
              style: [obj[0].style],
              fillColor: '#fff',
            };

            doc.content[doc.content.length - 1].table.body[(i + 1)][1] = { 
              text: obj[1].text, 
              style: [obj[1].style], 
              alignment: 'center',
              fillColor: '#fff',
            };

            doc.content[doc.content.length - 1].table.body[(i + 1)][2] = { 
              text: obj[2].text, 
              style: [obj[2].style], 
              fillColor: '#fff',
            };

            if (obj[1].text == "-") {
              doc.content[doc.content.length - 1].table.body[(i + 1)][0] = { 
                text: obj[0].text,
                style: [obj[0].style],
                fillColor: '#fef8ed', 
              };

              doc.content[doc.content.length - 1].table.body[(i + 1)][1] = { 
                text: obj[1].text,
                style: [obj[1].style],
                alignment: 'center',
                fillColor: '#fef8ed',
              };

              doc.content[doc.content.length - 1].table.body[(i + 1)][2] = { 
                text: obj[2].text,
                style: [obj[2].style],
                fillColor: '#fef8ed',
              };

              sum_bm += 1;

            } else if (obj[1].text == "Sudah" && obj[2].text == "Belum Dikoreksi") {
              doc.content[doc.content.length - 1].table.body[(i + 1)][0] = { 
                text: obj[0].text,
                style: [obj[0].style],
                fillColor: '#eeeeee', 
              };

              doc.content[doc.content.length - 1].table.body[(i + 1)][1] = { 
                text: obj[1].text,
                style: [obj[1].style],
                alignment: 'center',
                fillColor: '#eeeeee',
              };

              doc.content[doc.content.length - 1].table.body[(i + 1)][2] = { 
                text: obj[2].text,
                style: [obj[2].style],
                fillColor: '#eeeeee',
              };

              sum_bd += 1;
            } else {
              sum_sm += 1;
            }
          }

          if (sum_bm == 0){sum_bm = '-'};
          if (sum_bd == 0){sum_bd = '-'};
          if (sum_sm == 0){sum_sm = '-'}; 

          var objLayout = {};
          objLayout['hLineWidth'] = function(i) { return .5; };
          objLayout['vLineWidth'] = function(i) { return .5; };
          objLayout['hLineColor'] = function(i) { return '#bdbdbd '; };
          objLayout['vLineColor'] = function(i) { return '#bdbdbd '; };
          objLayout['paddingLeft'] = function(i) { return 4; };
          objLayout['paddingRight'] = function(i) { return 4; };
          doc.content[2].layout = objLayout;

          doc.content.splice( 1, 0, {
            margin: [ 0, -30, 0, 0 ],

            table: {
              widths: ['100%'],
              headerRows: 1,
              layout: 'noBorders',
              body: [
              [{ columns: [{ alignment: 'center', text: 'Rekap Tugas', alignment: 'center', fontSize: 14 }], border: [false] },],
              [{ columns: [{ alignment: 'center', text: titlec, alignment: 'center', fontSize: 12, margin: [0, 0, 0, 10] }], border: [false, false, false, true] },],
              [{ 
                border: [false],
                margin: [0, 10, 0, 10],
                columns: [
                { 
                  alignment: 'left', 
                  table: 
                  {
                    widths: ['100%'],
                    headerRows: 1,
                    body: [
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Kelas', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+kelas, alignment: 'left', fontSize: 10 }
                      ], 
                      border: [false] 
                    }],
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Guru', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+guru, alignment: 'left', fontSize: 10 }
                      ], 
                      border: [false] 
                    }]
                    ],
                  },
                },
                { 
                  alignment: 'right', 
                  table: 
                  {
                    widths: ['100%'],
                    headerRows: 1,
                    body: [
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Dibuat', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+created, alignment: 'left', fontSize: 10 }
                      ], 
                      border: [false] 
                    }],
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Deadline', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+deadline, alignment: 'left', fontSize: 10 }
                      ], 
                      border: [false] 
                    }],
                    ],
                  },
                },
                ] 
              }],
              [{ 
                margin: [0, 10, 0, 10],
                columns: [
                { 
                  alignment: 'left', 
                  table: 
                  {
                    widths: ['100%'],
                    headerRows: 1,
                    body: [
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Sudah', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+sum_sm, alignment: 'left', fontSize: 10, width: '20%', }
                      ], 
                      border: [false] 
                    }],
                    ],
                  },
                },
                { 
                  alignment: 'center', 
                  table: 
                  {
                    widths: ['100%'],
                    headerRows: 1,
                    body: [
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Belum Dikoreksi', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+sum_bd, alignment: 'left', fontSize: 10, width: '20%', }
                      ], 
                      border: [false] 
                    }],
                    ],
                  },
                },
                { 
                  alignment: 'right', 
                  table: 
                  {
                    widths: ['100%'],
                    headerRows: 1,
                    body: [
                    [{ 
                      columns: [
                      { alignment: 'left', text: 'Belum Mengumpulkan', alignment: 'left', fontSize: 10 },
                      { alignment: 'right', text: ': '+sum_bm, alignment: 'left', fontSize: 10, width: '20%', }
                      ], 
                      border: [false] 
                    }],
                    ],
                  },
                },
                ] 
              }],
              ],
            },
          });

doc['footer'] = (function (page, pages) {
  return {
    columns: [
    {
      alignment: 'left',
      text: ['Waktu Rekap: ', { text: jsDate.toString() }]
    },
    {
      alignment: 'center',
      text: 'Total ' + rcout.toString() + ' data'
    },
    {
      alignment: 'right',
      text: ['Halaman ', { text: page.toString() }]
    }
    ],
    margin: 10
  }
});
},
},
],
});

$("#ExportPDF").on("click", function() {
  table.button( '.buttons-pdf' ).trigger();
});

$("#ExportExcel").on("click", function() {
  table.button( '.buttons-excel' ).trigger();
});

tabelsearch = $('#tabel-siswa').DataTable();
$('#input-search').keyup(function(){
  tabelsearch.search($(this).val()).draw();
});


});

$(document).ready( function () {
  $('#yakin').click(function() {
    $('#nilai').attr('disabled',! this.checked);
    $('#btn-send').attr('disabled',! this.checked)
  });
});
</script>
@endsection