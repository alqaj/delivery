@extends('layouts.app')
@section('content')
    <div class="container px-5">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-end my-1">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h4>{{ $destination->name }}</h4>
                            <p class="fs-4 fw-bold">{{ $destination->other_name }} / {{ $destination->dock }}</p>
                            <p class="fs-5 text-muted">Logistic: {{ $destination->logistic }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Durasi Pulling:</h4>
                        <h1 id="waktu">00:00:00</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Jumlah Part Delivery yg Ter-Scan:</h4>
                        <h1 id="total_delivery">Loading...</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <form action="{{ route('delivery.finish') }}" method="post">
                    @csrf
                    <input type="hidden" name="uuid" id="uuid" value="{{ $delivery->uuid }}" />
                    <button class="btn-finish btn btn-danger w-100 p-2">Selesai</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var startTime = new Date().getTime();

            function updateWaktu() {
                var currentTime = new Date().getTime();
                var elapsedTime = currentTime - startTime;

                var hours = Math.floor(elapsedTime / 3600000);
                var minutes = Math.floor((elapsedTime % 3600000) / 60000);
                var seconds = Math.floor((elapsedTime % 60000) / 1000);

                // Format waktu menjadi hh:mm:ss
                var formattedTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);

                // Tampilkan waktu di dalam elemen dengan id "waktu"
                $("#waktu").text(formattedTime);
            }

            function pad(number) {
                return (number < 10 ? '0' : '') + number;
            }

            // Panggil fungsi updateWaktu setiap detik
            setInterval(updateWaktu, 1000);

            function updateTotalDelivery() {
                // Make an API request to get the total delivery count from the Zebra FX9600
                $.ajax({
                    url: 'http://172.18.12.37/api/getTotalDelivery', // Update the URL with the actual API endpoint
                    method: 'GET',
                    success: function (data) {
                        // Update the content of the total_delivery element
                        $('#total_delivery').text(data.total);
                    },
                    error: function (error) {
                        console.error('Error fetching total delivery:', error);
                    }
                });
            }

            updateTotalDelivery();
        })
    </script>
@endpush
