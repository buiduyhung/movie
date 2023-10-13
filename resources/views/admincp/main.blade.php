@extends('layouts.backend')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">TỔNG QUAN</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Tổng quan</li>
        </ol>
        <div class="row">
            @php
                $countEpisode = session('countEpisode');
                $countCategory = session('countCategory');
                $countCountry = session('countCountry');
                $countGenre = session('countGenre');
            @endphp

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Danh mục</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">

                        <h3 class="text-white stretched-link"> {{ $countCategory }} </h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Thể loại</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="text-white stretched-link">{{ $countGenre }} </h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Quốc gia</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="text-white stretched-link">{{ $countCountry }} </h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Phim</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="text-white stretched-link">{{ $countEpisode }} </h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Lượng truy cập
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        View
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>

    </div>
@endsection

