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
    <div style="text-align:center">
    <h4>Instrumen Penilaian Budaya Organisasi (OCAI)<h4>
    </div>
    <br>

   <!-- TABEL 1 -->
<div class="container">
    <table id="dttable" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">Karakteristik Organisasi yang Dominan</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini merupakan tempat yang penuh kekeluargaan. Karyawan bersifat terbuka dan senang berbagi dengan sesama rekannya.</td>
                <td><input type="number" name="nilai11" min="0" max="100" value="0" ></td>
                <td><input type="number" name="nilai21" min="0" max="100" value="0" ></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini adalah tempat yang dinamis, dan karyawan menunjukkan dedikasi tinggi dan mereka juga berani mengambil risiko tanpa khawatir dengan hukuman.</td>
                <td><input type="number" name="nilai12" min="0" max="100" value="0" ></td>
                <td><input type="number" name="nilai22" min="0" max="100" value="0" ></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini sangat berorientasi pada hasil, fokus utama adalah pada penyelesaian pekerjaan. Karyawan sangat kompetitif dan berorientasi pada pencapaian.</td>
                <td><input type="number" name="nilai13" min="0" max="100" value="0" ></td>
                <td><input type="number" name="nilai23" min="0" max="100" value="0" ></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Organisasi ini adalah tempat yang sangat terkontrol dan terstruktur. Prosedur-prosedur baku merupakan mekanisme penting dalam mengatur pola dan cara kerja karyawan.</td>
                <td><input type="number" name="nilai24" min="0" max="100" value="0" ></td>
                <td><input type="number" name="nilai25" min="0" max="100" value="0" ></td>
            </tr>
            <tr>
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
                <th class="text-center">Kepemimpinan dalam Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam pendampingan, kerja sama, dan pembimbingan.</td>
                <td><input type="number" name="nilai21" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai22" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: 2ormal; overflow2 visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam kewirausahaan, inovasi, atau pengambilan risiko.</td>
                <td><input type="number" name="nila23" min="0" max="100" value="0"></td>
                <td><input type="number" name="nila24" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam ketegasan bersikap, afirmatif, dan berorientasi hasil.</td>
                <td><input type="number" name="nilai25" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai26" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%; white-space: normal; overflow: visible; text-overflow: clip;">Kepemimpinan dalam organisasi menjadi contoh dan teladan dalam koordinasi, pengorganisasian, dan efisiensi operasional.</td>
                <td><input type="number" name="nilai27" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai28" min="0" max="100" value="0"></td>
            </tr>
            <tr>
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
                <th class="text-center">Manajemen Karyawan</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan kerjasama tim, konsensus, dan partisipatif.</td>
                <td><input type="number" name="nilai31" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai32" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan pengambilan risiko individu, inovasi, dan kebebasan.</td>
                <td><input type="number" name="nilai33" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai34" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditunjukkan dengan cara kerja yang kompetitif, tuntutan kerja yang tinggi dan hasil kerja yang sebaik-baiknya.</td>
                <td><input type="number" name="nilai35" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai36" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Gaya manajemen di organisasi ini ditandai dengan keamanan bekerja, keseragaman, dan stabilitas dalam hubungan.</td>
                <td><input type="number" name="nilai37" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai38" min="0" max="100" value="0"></td>
            </tr>
            <tr>
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
                <th class="text-center">Perekat Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah loyalitas, saling percaya, serta komitmen yang tinggi techadap organisasi.</td>
                <td><input type="number" name="nilai41" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai42" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah komitmen terhadap inovasi, pengembangan, dan usaha terus menerus untuk selalu menjadi yang terdepan.</td>
                <td><input type="number" name="nilai44" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai44" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah penekanan pada pencapaian dan penyelesaian target kerja, baik organisasi dan pribadi.</td>
                <td><input type="number" name="nilai45" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai46" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Faktor yang merekatkan organisasi adalah aturan dan kebijakan formal, sebagai upaya menjaga operasional perusahan berjalan sempuma.</td>
                <td><input type="number" name="nilai47" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai48" min="0" max="100" value="0"></td>
            </tr>
            <tr>
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
                <th class="text-center">Penekanan Aspek Strategis</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada pengembangan manusia, kepercayaan antarkaryawan, keterbukaan, dan partisipasi yang terus menerus.</td>
                <td><input type="number" name="nilai51" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai52" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada akuisisi sumber daya baru dan menciptakan tantangan baru, selalu mencoba hal baru dan mencari peluang sangat dihargai.</td>
                <td><input type="number" name="nilai53" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai55" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada perilaku kompetitif dan result-oriented untuk mencapai dan menjadi target yang ditetapkan menjadi perusahaan yang dominan.</td>
                <td><input type="number" name="nilai55" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai56" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi menekankan pada keajegan, stabilitas, efisiensi, kontrol, dan operasional yang lancar, terencana dan minim gangguan.</td>
                <td><input type="number" name="nilai57" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai58" min="0" max="100" value="0"></td>
            </tr>
            <tr>
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
                <th class="text-center">Kriteria Keberhasilan Organisasi</th>
                <th class="text-center">Kondisi Saat Ini</th>
                <th class="text-center">Kondisi Ideal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan pengembangan sumber daya manusia, kerja sama tim, komitmen karyawan, dan kepedulian terhadap lingkungan kerja.</td>
                <td><input type="number" name="nilai61" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai62" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan kemampuan penciptaan produk unik atau terbaru, menjadi pelopor dan inovator di industrinya.</td>
                <td><input type="number" name="nilai63" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai64" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan keunggulan kompetitif, produk & inovasi yang unggul dan menjadi pemimpin di pasar kompetitif adalah kunci.</td>
                <td><input type="number" name="nilai65" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai66" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="width: 80%;  white-space: normal; overflow: visible; text-overflow: clip;">Organisasi mendefinisikan keberhasilan berdasarkan efisiensi, seperti biaya produksi yang rendah, efisiensi pengiriman, penjadwalan kerja yang tepat, teknologi untuk mengurangi tenaga kerja.</td>
                <td><input type="number" name="nilai67" min="0" max="100" value="0"></td>
                <td><input type="number" name="nilai68" min="0" max="100" value="0"></td>
            </tr>
            <tr>
                <td style="text-align:center">Total</td>
                <td><span id="totalnilaitable61">0</span></td>
                <td><span id="totalnilaitable62">0</span></td>
            </tr>
        </tbody>
    </table>
    <div>
        <button id="backButton" class="btn btn-danger" hidden>Back</button>
        <button id="nextButton" class="btn btn-primary">Next</button>
    </div>
    </div>

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

        <script>
        let currentTable = 1;

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
        }

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


        </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function calculateTotal() {
            // Mengambil nilai input untuk kolom pertama
            let nilai11 = parseInt(document.querySelector('input[name="nilai11"]').value) || 0;
            let nilai12 = parseInt(document.querySelector('input[name="nilai12"]').value) || 0;
            let nilai13 = parseInt(document.querySelector('input[name="nilai13"]').value) || 0;
            let nilai14 = parseInt(document.querySelector('input[name="nilai14"]').value) || 0;

            // Menghitung total untuk kolom pertama
            let total1 = nilai11 + nilai12 + nilai13 + nilai14;

            // Mengambil nilai input untuk kolom kedua
            let nilai21 = parseInt(document.querySelector('input[name="nilai21"]').value) || 0;
            let nilai22 = parseInt(document.querySelector('input[name="nilai22"]').value) || 0;
            let nilai23 = parseInt(document.querySelector('input[name="nilai23"]').value) || 0;
            let nilai24 = parseInt(document.querySelector('input[name="nilai24"]').value) || 0;

            // Menghitung total untuk kolom kedua
            let total2 = nilai21 + nilai22 + nilai23 + nilai24;

            // Menampilkan total di span
            document.getElementById('totalnilaitable11').innerText = total1;
            document.getElementById('totalnilaitable12').innerText = total2;
        }

        // Menambahkan event listener ke semua input dengan type="number"
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Hitung total saat halaman pertama kali dimuat
        calculateTotal();
    });
</script>
        <script>
            $(".start_date, .end_date").flatpickr({
                allowInput: true
            });
        </script>
</body>
</html>
