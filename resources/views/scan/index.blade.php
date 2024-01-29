@extends('layouts.app')
@section('content')
    <div class="p-2 ">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">SELAMAT DATANG DI DELIVERY AISIN INDONESIA AUTOMOTIVE</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $delivery->destinasi }}</h5>
                    <p class="card-text">Dock : {{ $delivery->dock }}</p>
                    <p class="card-text">Cycle : {{ $delivery->cycle }}</p>
                    <p class="card-text">Logistic : {{ $delivery->logistic }}</p>
                </div>
                <div class="card-footer"><a href="{{ route('delivery.pulling') }}" class="btn btn-success">MULAI PULLING</a>
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
@endpush
