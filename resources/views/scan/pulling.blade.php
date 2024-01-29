@extends('layouts.app')
@section('content')
    <div class="p-2 ">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">SELAMAT DATANG DI DELIVERY AISIN INDONESIA AUTOMOTIVE</div>
                <div class="card-body">
                    <h5 class="card-title">TOTAL SCAN :</h5>
                    <p class="card-text"><input type="text"
                            class="form-control form-control-lg form-control-plaintext text-center"
                            style="width: 100%; height: 200px; font-size: 200px;" name="total_delivery" id="total_delivery"
                            readonly></p>
                    <input type="text" class="form-control" id="part">
                </div>
                <div class="card-footer">
                        <button class="btn btn-success btn-selesai" data-bs-toggle="modal" data-bs-target="#finishModal" data-uuid="1">SELESAI PULLING</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="finishModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Selesai Pulling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin untuk menyelesaikan pulling ini?
                    <input type="text" readonly class="form-control-plaintext" id="device">
                    <input type="hidden" id="uuid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="btn-approve">Yes, Approve!</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .card {
            cursor: pointer;
        }

        .selected-card {
            /* border: 2px solid #5387d5 !important;
                          background-color: #5387d5 !important; */
            border: 2px solid #DE4250 !important;
            background-color: #DE4250 !important;
            color: white !important;
        }

        .bg-default {
            background-color: #F5F5F5;
            color: black;
        }

        .bg-sky {
            background-color: #DEEBFF;
            color: black !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Mendapatkan elemen input dengan id 'part'
            var partInput = $('#part');

            // Mendapatkan elemen input dengan id 'total_delivery'
            var totalDeliveryInput = $('#total_delivery');

            // Mendapatkan nilai terakhir dari localStorage (jika ada)
            var scannedItems = JSON.parse(localStorage.getItem('scannedItems')) || [];

            // Menetapkan fokus pada input 'part' ketika halaman dimuat
            partInput.focus();

            // Menangani klik pada elemen selain input 'part'
            $(document).on('click', function(event) {
                // Mendapatkan elemen yang diklik
                var clickedElement = $(event.target);

                // Memeriksa apakah elemen yang diklik bukanlah input 'part'
                if (!clickedElement.is(partInput)) {
                    // Menetapkan fokus kembali pada input 'part'
                    partInput.focus();
                }
            });

            // Menangani input dari alat scanner
            partInput.on('input', function() {
                // Mendapatkan nilai dari input 'part'
                var scannedValue = partInput.val();

                // (Opsional) Lakukan tindakan yang diperlukan saat nilai input berubah
                // Contoh: Menampilkan data yang sedang diketik

                // Memperbarui nilai terakhir yang diinput
                localStorage.setItem('lastScannedValue', scannedValue);
            });

            // Menangani kejadian "Enter" pada input 'part'
            partInput.on('keydown', function(event) {
                if (event.key === 'Enter') {
                    // Mencegah form dari submit (jika ada form di halaman)
                    event.preventDefault();

                    // Mendapatkan nilai terakhir yang diinput
                    var lastScannedValue = localStorage.getItem('lastScannedValue');

                    // (Opsional) Menyaring data yang sama sebelum ditambahkan ke array
                    if (lastScannedValue && !scannedItems.includes(lastScannedValue)) {
                        // Menambahkan nilai baru ke scannedItems
                        scannedItems.push(lastScannedValue);

                        // Menetapkan nilai ke input 'total_delivery'
                        totalDeliveryInput.val(scannedItems.length);

                        // Menyimpan scannedItems ke localStorage
                        localStorage.setItem('scannedItems', JSON.stringify(scannedItems));
                    }

                    // Mengosongkan input 'part'
                    partInput.val('');

                    // Menetapkan fokus kembali pada input 'part' untuk pemindaian berikutnya
                    partInput.focus();
                }
            });
        });
    </script>
@endpush
