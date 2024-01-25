@extends('layouts.app')
@section('content')
<div class="p-2 mb-2 bg-default">
    <div class="row">
        @foreach($destinations as $destination)
        <div class="col-md-3 mb-2">
            <div class="card card-customer">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <img src="{{ asset('img/' . $destination->logo )}}" alt="Sample Image" class="img-fluid" width="75px">
                            </div>
                            <div class="media-body text-right ms-auto">
                                <span class="fw-bold">{{ $destination->name }}</span>
                                <h5>{{ $destination->other_name }}/{{ $destination->dock }}</h5>
                                <span class="text-muted">Logistic: {{ $destination->logistic }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <hr/>
    <div class="row mb-2">
        @for($i=1;$i<=12;$i++)
        <div class="col-md-1 mb-2">
            <div class="card card-cycle">
                <div class="card-body">
                    <h4 class="text-center">C-{{$i}}</h4>
                </div>
            </div>
        </div>
        @endfor
    </div>
    
    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <button class="btn btn-success w-100 p-3 fw-bold">LANJUT PULLING</button>
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
      border: 2px solid #5387d5 !important;
      background-color: #5387d5 !important;
      color: white !important;
    }
    .bg-default {
        background-color: #F5F5F5;
        color: black;
    }
  </style>
@endpush