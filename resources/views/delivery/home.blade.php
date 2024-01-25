@extends('layouts.app')
@section('content')
<div class="p-2 ">
    <div class="row">
        <div class="col-md-8">
            <div class="containerw">
                <div class="bg-light border p-2 rounded mb-1 fw-bold">
                    1. Pilih Destinasi
                </div>
                <div class="row">
                    @foreach($destinations as $destination)
                    <div class="col-md-4 mb-2">
                        <div class="card card-customer" data-uuid="{{ $destination->uuid }}">
                            <div class="card-header">
                                {{ $destination->name }}
                            </div>
                            <div class="card-body">
                                <p class="fw-bold mb-0">{{ $destination->other_name }}/{{ $destination->dock }}</p>
                                <p class="fw-light mb-0" style="font-size: 10pt;">Logistic: {{ $destination->logistic }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="bg-light border p-2 rounded mb-1 fw-bold">
                    2. Pilih Cycle
                </div>
                <div class="row">
                    @for($i=1;$i<=12;$i++)
                    <div class="col-md-2 mb-1">
                        <div class="card card-cycle p-1" data-cycle="{{ $i}}">
                            <div class="card-body m-0 p-0">
                                <p class="fs-5 fw-bold text-center mb-0">C{{$i}}</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-light border p-2 rounded mb-1 fw-bold">
                        3. Foto Selfie
                    </div>
                    <div id="webcam" class="" style="height:300px">
                    </div>
                    <img id="captured-photo" style="display: none;">
                    <div class="text-center">
                        <button class="take-photo btn btn-dark mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                            Ambil Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <form action="{{ route('delivery.start') }}" method="post">
                @csrf
                <input type="hidden" name="cycle" id="cycle">
                <input type="hidden" name="photo" id="photo">
                <input type="hidden" name="uuid" id="uuid">
            <button class="btn btn-success w-100 py-2 fw-bold fs-5">
                Lanjut ke Pulling
            </button>
            </form>
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
    .bg-sky{
        background-color: #DEEBFF;
        color: black !important;
    }
  </style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi WebcamJS
        Webcam.set({
            // width: 300,
            height: 450,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#webcam');

        // Fungsi untuk mengambil foto
        $('.take-photo').on('click', function() {
            Webcam.snap(function(data_uri) {
                // Berhenti dari mode live view kamera
                Webcam.reset();
                $('#webcam').css('display','none');
                // Tampilkan foto yang diambil
                $('#captured-photo').attr('src', data_uri).css('display', 'block');

                //Set to value FOrm
                $('#photo').val(data_uri);
            });
        });

        $(".card-customer").click(function() {
            $(".card-customer").removeClass("selected-card");
            $(this).addClass("selected-card");
            $('#uuid').val($(this).data('uuid'));
        });

        // Optional: Handle radio button state
        $("input[type=radio]").change(function() {
            $(".card-customer").removeClass("selected-card");
            $("#" + $(this).attr("id").replace("color", "card-customer")).addClass("selected-card");
        });

        $(".card-cycle").click(function() {
            $(".card-cycle").removeClass("selected-card");
            $(this).addClass("selected-card");
            $('#cycle').val($(this).data('cycle'));
        });

        // Optional: Handle radio button state
        $("input[type=radio]").change(function() {
            $(".card-cycle").removeClass("selected-card");
            $("#" + $(this).attr("id").replace("color", "card-cycle")).addClass("selected-card");
        });
    });
</script>
@endpush