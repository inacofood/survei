<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Learning Module | INACO</title>

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rubic.css') }}">
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('css/flatpicker.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Font Awsome --}}
    <script src="https://kit.fontawesome.com/1cd7233012.js" crossorigin="anonymous"></script>
    <style>
        .dataTables_length {
            float: left;
        }
    </style>
</head>
    
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" >
    <br>
    <div style="text-align: center;">
        <br>
        <h3><strong>Instrumen Penilaian Budaya Organisasi (OCAI)</strong></h3>
        <p class="has-line"></p>
    </div>
    <br>
    <br>
    <form action="{{ route('ocai.store') }}" method="POST">
    @csrf
    <div class="container" id="depan">
    <div class="row">
        <!-- Kolom Kiri - TUJUAN dan CARA PENGISIAN -->
        <div class="col-md-6">
            <div class="card p-4" style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <h4 class="text-center" style="font-weight: bold;">Tujuan</h4>
                <p>Organizational Culture Assessment Instrument (OCAI) atau Instrumen Penilaian Budaya Organisasi merupakan alat ukur untuk menilai aspek-aspek budaya organisasi pada perusahaan dan memprediksi kinerja organisasi.</p>
                
                <h4 class="text-center" style="font-weight: bold;">Cara Pengisian</h4>
                <ol>
                    <li>Setiap pernyataan terbagi atas 4 item (A, B, C, D).</li>
                    <li>Setiap item terbagi ke dalam 2 kondisi: 
                        <ul>
                            <li><b>Kondisi Saat Ini:</b> Kondisi yang saat ini terjadi di organisasi Anda.</li>
                            <li><b>Kondisi Ideal:</b> Kondisi yang menurut Anda sebaiknya dicapai oleh organisasi pada tahun mendatang.</li>
                        </ul>
                    </li>
                    <li>Beri nilai menggunakan <b>skala Likert 1-5</b> pada keempat item di setiap kondisi sesuai dengan penilaian Anda terhadap organisasi, dengan ketentuan <b>"1" untuk nilai terendah</b> dan <b>"5" untuk nilai tertinggi</b>.</li>
                    <li>Pastikan semua item diberikan nilai sebelum melanjutkan ke tahapan selanjutnya.</li>
                </ol>
            </div>
        </div>

        <!-- Kolom Kanan - Form -->
         <br>
        <div class="col-md-6">
    <div class="form-group">
        <label for="nama">Nama Karyawan:</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Name" required>
    </div>
    <div class="form-group">
        <label for="department">Departemen:</label>
        <select id="department" name="department" class="form-control" required>
            <option value="">-- Select Department --</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
            @endforeach
        </select>
    </div>
    <div style="text-align: right; margin-top: 20px;">
        <button type="button" id="nextToTableButton" class="btn btn-primary" style="color: white;">
            <i class="fa fa-save"></i> Submit
        </button>
    </div>
</div>

    </div>
</div>



<!-- TABEL 1 -->
<div class="container" id="isi" hidden>
    <table id="dttable" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">I</th>
                <th class="text-center">Karakteristik Organisasi yang Dominan</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini merupakan tempat yang penuh kekeluargaan. Karyawan bersifat terbuka dan senang berbagi dengan sesama rekannya.</td>
                <td><input type="number" name="nilaisaatini11" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
                <td><input type="number" name="nilaiideal11" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini adalah tempat yang dinamis, dan karyawan menunjukkan dedikasi tinggi dan mereka juga berani mengambil risiko tanpa khawatir dengan hukuman.</td>
                <td><input type="number" name="nilaisaatini12" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
                <td><input type="number" name="nilaiideal12" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini sangat berorientasi pada hasil, fokus utama adalah pada penyelesaian pekerjaan. Karyawan sangat kompetitif dan berorientasi pada pencapaian.</td>
                <td><input type="number" name="nilaisaatini13" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
                <td><input type="number" name="nilaiideal13" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini adalah tempat yang sangat terkontrol dan terstruktur. Prosedur-prosedur baku merupakan mekanisme penting dalam mengatur pola dan cara kerja karyawan.</td>
                <td><input type="number" name="nilaisaatini14" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
                <td><input type="number" name="nilaiideal14" min="1" max="5" oninput="validateInput(this, 'dttable')"></td>
            </tr>
            <tr hidden>     
                <td style="text-align:center"></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable11">0</span></td>
                <td><span id="totalnilaitable12">0</span></td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL 2 -->
    <table id="dttable2" hidden class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">II</th>
                <th class="text-center">Kepemimpinan dalam Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam pendampingan, kerja sama, dan pembimbingan.</td>
                <td><input type="number" name="nilaisaatini21" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
                <td><input type="number" name="nilaiideal21" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%; white-space: 2ormal; overflow2 visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam kewirausahaan, inovasi, atau pengambilan risiko.</td>
                <td><input type="number" name="nilaisaatini22" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
                <td><input type="number" name="nilaiideal22" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam ketegasan bersikap, afirmatif, dan berorientasi hasil.</td>
                <td><input type="number" name="nilaisaatini23" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
                <td><input type="number" name="nilaiideal23" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam koordinasi, pengorganisasian, dan efisiensi operasional.</td>
                <td><input type="number" name="nilaisaatini24" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
                <td><input type="number" name="nilaiideal24" min="1" max="5" oninput="validateInput(this, 'dttable2')"></td>
            </tr>
            <tr hidden>     
                <td></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable21">0</span></td>
                <td><span id="totalnilaitable22">0</span></td>
            </tr>
        </tbody>
    </table>



    <!-- TABEL 3 -->
        <table id="dttable3" hidden class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">III</th>
                <th class="text-center">Manajemen Karyawan</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan kerjasama tim, konsensus, dan partisipatif.</td>
                <td><input type="number" name="nilaisaatini31" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
                <td><input type="number" name="nilaiideal31" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan pengambilan risiko individu, inovasi, dan kebebasan.</td>
                <td><input type="number" name="nilaisaatini32" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
                <td><input type="number" name="nilaiideal32" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan cara kerja yang kompetitif, tuntutan kerja yang tinggi dan hasil kerja yang sebaik-baiknya.</td>
                <td><input type="number" name="nilaisaatini33" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
                <td><input type="number" name="nilaiideal33" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditandai dengan keamanan bekerja, keseragaman, dan stabilitas dalam hubungan.</td>
                <td><input type="number" name="nilaisaatini34" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
                <td><input type="number" name="nilaiideal34" min="1" max="5" oninput="validateInput(this, 'dttable3')"></td>
            </tr>
            <tr hidden>
                <td></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable31">0</span></td>
                <td><span id="totalnilaitable32">0</span></td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL 4 -->
        <table id="dttable4" hidden class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">IV</th>
                <th class="text-center">Perekat Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah loyalitas, saling percaya, serta komitmen yang tinggi techadap organisasi.</td>
                <td><input type="number" name="nilaisaatini41" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
                <td><input type="number" name="nilaiideal41" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah komitmen terhadap inovasi, pengembangan, dan usaha terus menerus untuk selalu menjadi yang terdepan.</td>
                <td><input type="number" name="nilaisaatini42" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
                <td><input type="number" name="nilaiideal42" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah penekanan pada pencapaian dan penyelesaian target kerja, baik organisasi dan pribadi.</td>
                <td><input type="number" name="nilaisaatini43" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
                <td><input type="number" name="nilaiideal43" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah aturan dan kebijakan formal, sebagai upaya menjaga operasional perusahan berjalan sempuma.</td>
                <td><input type="number" name="nilaisaatini44" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
                <td><input type="number" name="nilaiideal44" min="1" max="5" oninput="validateInput(this, 'dttable4')"></td>
            </tr>
            <tr hidden>
                <td></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable41">0</span></td>
                <td><span id="totalnilaitable42">0</span></td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL 5 -->
        <table id="dttable5" hidden class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">V</th>
                <th class="text-center">Penekanan Aspek Strategis</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada pengembangan manusia, kepercayaan antarkaryawan, keterbukaan, dan partisipasi yang terus menerus.</td>
                <td><input type="number" name="nilaisaatini51" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
                <td><input type="number" name="nilaiideal51" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada akuisisi sumber daya baru dan menciptakan tantangan baru, selalu mencoba hal baru dan mencari peluang sangat dihargai.</td>
                <td><input type="number" name="nilaisaatini52" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
                <td><input type="number" name="nilaiideal52" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada perilaku kompetitif dan result-oriented untuk mencapai dan menjadi target yang ditetapkan menjadi perusahaan yang dominan.</td>
                <td><input type="number" name="nilaisaatini53" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
                <td><input type="number" name="nilaiideal53" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada keajegan, stabilitas, efisiensi, kontrol, dan operasional yang lancar, terencana dan minim gangguan.</td>
                <td><input type="number" name="nilaisaatini54" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
                <td><input type="number" name="nilaiideal54" min="1" max="5" oninput="validateInput(this, 'dttable5')"></td>
            </tr>
            <tr hidden>
                <td></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable51">0</span></td>
                <td><span id="totalnilaitable52">0</span></td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL 6 -->
        <table id="dttable6" hidden class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">VI</th>
                <th class="text-center">Kriteria Keberhasilan Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">A</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan pengembangan sumber daya manusia, kerja sama tim, komitmen karyawan, dan kepedulian terhadap lingkungan kerja.</td>
                <td><input type="number" name="nilaisaatini61" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
                <td><input type="number" name="nilaiideal61" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
            </tr>
            <tr>
                <td style="text-align:center">B</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan kemampuan penciptaan produk unik atau terbaru, menjadi pelopor dan inovator di industrinya.</td>
                <td><input type="number" name="nilaisaatini62" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
                <td><input type="number" name="nilaiideal62" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
            </tr>
            <tr>
                <td style="text-align:center">C</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan keunggulan kompetitif, produk & inovasi yang unggul dan menjadi pemimpin di pasar kompetitif adalah kunci.</td>
                <td><input type="number" name="nilaisaatini63" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
                <td><input type="number" name="nilaiideal63" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
            </tr>
            <tr>
                <td style="text-align:center">D</td>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan efisiensi, seperti biaya produksi yang rendah, efisiensi pengiriman, penjadwalan kerja yang tepat, teknologi untuk mengurangi tenaga kerja.</td>
                <td><input type="number" name="nilaisaatini64" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
                <td><input type="number" name="nilaiideal64" min="1" max="100" oninput="validateInput(this, 'dttable6')"></td>
            </tr>
            <tr hidden>
                <td></td>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable61">0</span></td>
                <td><span id="totalnilaitable62">0</span></td>
            </tr>
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 20px;">
    <button type="button" id="backButton" class="btn btn-danger" style="color:white; margin-right: 10px;" hidden>
        <i class="fas fa-arrow-left"></i> Back
    </button>
    
    <button type="button" id="nextButton" class="btn btn-primary" style="color:white; margin-right: 10px;" disabled>
        Next <i class="fas fa-arrow-right"></i>
    </button>
    
    <button type="submit" class="btn btn-primary" style="color: white;">
        <i class="fas fa-save"></i> Submit
    </button>
    
    <div id="validationMessage" style="margin-top: 10px; color: red;"></div>  
</div>

    </div>
    </form>

    <script>
        let currentTable = 1;
        const totals = {
            table1: { saatIni: 0, ideal: 0 },
            table2: { saatIni: 0, ideal: 0 },
            table3: { saatIni: 0, ideal: 0 },
            table4: { saatIni: 0, ideal: 0 },
            table5: { saatIni: 0, ideal: 0 },
            table6: { saatIni: 0, ideal: 0 }
        };

        const tables = [
            document.getElementById('dttable'),
            document.getElementById('dttable2'),
            document.getElementById('dttable3'),
            document.getElementById('dttable4'),
            document.getElementById('dttable5'),
            document.getElementById('dttable6')
        ];
      
        const backButton = document.getElementById('backButton');
        const nextButton = document.getElementById('nextButton');

    function updateTables() {
    tables.forEach((table, index) => {
        table.hidden = currentTable !== index + 1;
    });

    backButton.hidden = currentTable === 1;
    nextButton.hidden = currentTable === tables.length;

    
    validateCurrentTable();
    }

    function validateCurrentTable() {
        const currentTableId = `dttable${currentTable}`;
        updateTotals(currentTableId);
    }

    nextButton.disabled = true;
    nextButton.addEventListener('click', function() {
        if (currentTable < tables.length) {
            currentTable++;
            updateTables();
        }
    });
    backButton.addEventListener('click', function() {
        if (currentTable > 1) {
            currentTable--;
            updateTables();
        }
    });
    updateTables(); 

    function validateInput(input, tableId) {
    if (input.value > 5) {
        input.value = 5;
    } else if (input.value < 1) {
        input.value = 1;
    }

    updateTotals(tableId);
    }

    function updateTotals(tableId) {
        const inputsKondisiSaatIni = document.querySelectorAll(`#${tableId} input[name^="nilaisaatini"]`);
        const inputsKondisiIdeal = document.querySelectorAll(`#${tableId} input[name^="nilaiideal"]`);

        let totalKondisiSaatIni = 0;
        let totalKondisiIdeal = 0;
        let allInputsFilled = true;

        inputsKondisiSaatIni.forEach(input => {
            const value = parseFloat(input.value) || 0;
            if (!input.value) allInputsFilled = false; 
            totalKondisiSaatIni += value;
        });

        inputsKondisiIdeal.forEach(input => {
            const value = parseFloat(input.value) || 0;
            if (!input.value) allInputsFilled = false; 
            totalKondisiIdeal += value;
        });

        if (tableId === 'dttable') {
            document.getElementById('totalnilaitable11').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable12').innerText = totalKondisiIdeal;
        } else if (tableId === 'dttable2') {
            document.getElementById('totalnilaitable21').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable22').innerText = totalKondisiIdeal;
        } else if (tableId === 'dttable3') {
            document.getElementById('totalnilaitable31').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable32').innerText = totalKondisiIdeal;
        } else if (tableId === 'dttable4') {
            document.getElementById('totalnilaitable41').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable42').innerText = totalKondisiIdeal;
        } else if (tableId === 'dttable5') {
            document.getElementById('totalnilaitable51').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable52').innerText = totalKondisiIdeal;
        } else if (tableId === 'dttable6') {
            document.getElementById('totalnilaitable61').innerText = totalKondisiSaatIni;
            document.getElementById('totalnilaitable62').innerText = totalKondisiIdeal;
        }

        validateTotal(totalKondisiSaatIni, totalKondisiIdeal, allInputsFilled);
    }

    
    function validateTotal(totalSaatIni, totalIdeal, allInputsFilled) {
        const messageElement = document.getElementById('validationMessage');
        messageElement.innerText = "";

        if (allInputsFilled) {
            nextButton.disabled = false; 
            messageElement.style.color = "green"; 
        } else {
            nextButton.disabled = true; 
            if (!allInputsFilled) {
                messageElement.innerText = "Semua input harus diisi.";
            } 
            messageElement.style.color = "red";
        }
    }

    function checkActiveTable() {
        let activeTableId = $('.table:visible').attr('id'); 
        if (activeTableId === 'dttable6') {
            $('button[type="submit"]').show();
        } else {
            $('button[type="submit"]').hide(); 
        }
    }

    function validateLastTable() {
        const inputsKondisiSaatIni = document.querySelectorAll('#dttable6 input[name^="nilaisaatini"]');
        const inputsKondisiIdeal = document.querySelectorAll('#dttable6 input[name^="nilaiideal"]');

        let totalKondisiSaatIni = 0;
        let totalKondisiIdeal = 0;
        let allInputsFilled = true;

        inputsKondisiSaatIni.forEach(input => {
            const value = parseFloat(input.value) || 0;
            if (!input.value) allInputsFilled = false;
            totalKondisiSaatIni += value;
        });

        inputsKondisiIdeal.forEach(input => {
            const value = parseFloat(input.value) || 0;
            if (!input.value) allInputsFilled = false;
            totalKondisiIdeal += value;
        });

        const submitButton = document.querySelector('button[type="submit"]');
        const messageElement = document.getElementById('validationMessage');

        if (allInputsFilled) {
            submitButton.disabled = false;
            messageElement.innerText = "";
        } 
    }

    checkActiveTable();
    validateLastTable();

    $('#nextButton, #backButton').on('click', function() {
        checkActiveTable(); 
        if (currentTable === tables.length) {
            validateLastTable(); 
        }
    });

    $('#dttable6 input').on('input', function() {
        validateLastTable(); 
    });

    document.getElementById('nextToTableButton').addEventListener('click', function() {
        const nama = document.getElementById('nama').value;
        const department = document.getElementById('department').value;
        
        if (nama && department) {
            document.getElementById('depan').hidden = true;
            document.getElementById('isi').hidden = false;
        } else {
            alert('Harap isi nama dan department.');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    nextButton.disabled = true;

    updateTables();
    validateTable1();

    document.querySelectorAll('#dttable input[name^="nilaisaatini"], #dttable input[name^="nilaiideal"]').forEach(input => {
        input.addEventListener('input', validateTable1);
    });
});

function validateTable1() {
    const inputsKondisiSaatIni = document.querySelectorAll('#dttable input[name^="nilaisaatini"]');
    const inputsKondisiIdeal = document.querySelectorAll('#dttable input[name^="nilaiideal"]');

    let allInputsFilled = true;

    inputsKondisiSaatIni.forEach(input => {
        if (!input.value) allInputsFilled = false;
    });

    inputsKondisiIdeal.forEach(input => {
        if (!input.value) allInputsFilled = false;
    });

    nextButton.disabled = !allInputsFilled;
}
</script>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>

        <script src="{{ asset('vendors/jquery/jquery-3.4.1.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.affix.js') }}"></script>
        <script src="{{ asset('js/rubic.js') }}"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="{{ asset('js/flatpicker.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


        <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

        @yield('script')
        @stack('script')
        <script>
            $(".start_date, .end_date").flatpickr({
                allowInput: true
            });
        </script>
</body>
</html>
