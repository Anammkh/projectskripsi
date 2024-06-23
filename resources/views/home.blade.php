@extends('layouts.template')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Jumlah User -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #e3f2fd; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #0d47a1;">Jumlah User</span>
                            <h3 class="mb-0" style="color: #0d47a1;">{{ $jumlahUser }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Lowongan -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #e8f5e9; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #1b5e20;">Jumlah Lowongan</span>
                            <h3 class="mb-0" style="color: #1b5e20;">{{ $jumlahLowongan }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-briefcase fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Mitra -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #fff3e0; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #ef6c00;">Jumlah Mitra</span>
                            <h3 class="mb-0" style="color: #ef6c00;">{{ $jumlahMitra }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-handshake fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Jurusan -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #ffebee; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #b71c1c;">Jumlah Jurusan</span>
                            <h3 class="mb-0" style="color: #b71c1c;">{{ $jumlahJurusan }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-book fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Skill -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #e0f7fa; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #006064;">Jumlah Skill</span>
                            <h3 class="mb-0" style="color: #006064;">{{ $jumlahSkill }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-tools fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Lamaran -->
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="background-color: #f3e5f5; border: 1px solid #000;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="text-uppercase fs-12 fw-bold" style="color: #6a1b9a;">Jumlah Lamaran</span>
                            <h3 class="mb-0" style="color: #6a1b9a;">{{ $jumlahlamaran }}</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-file-alt fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
