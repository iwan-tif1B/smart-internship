@extends('layouts.app')

@section('title', 'Master')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ secure_asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>List Booked Users </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Booked</a></div>
                    <div class="breadcrumb-item"><a href="#">listbooked</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Details Booked [ {{ auth()->user()->name }} ]</h2>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="text-custom">All Posts</h4>
                            </div> --}}
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name</th>
                                            <th>Status Bill</th>
                                            <th>Time Order</th>
                                            <th>Time Delivery</th>
                                            <th>Price</th>
                                            <th>Detail Order</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($bill as $i_bill)
                                            <tr>
                                                <?php
                                                $name = $i_bill->quque_session->detail_session->name_playstation;
                                                $time_delivery = $i_bill->quque_session->date;
                                                ?>
                                                <td>{{ $name }} </td>
                                                <td>
                                                    <b
                                                        class="text-<?= $i_bill->status_bill == 'Belum Lunas' ? 'danger' : 'success' ?>">
                                                        {{ $i_bill->status_bill }}
                                                    </b>
                                                </td>
                                                <td>{{ date('d-m-Y H:i:s', strtotime($i_bill->time_order)) }} WIB</td>
                                                <td>{{ date('d-m-Y', strtotime($time_delivery)) }}</td>
                                                <td>{{ number_format($i_bill->total) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        onclick="details('{{ $i_bill->note }}')">
                                                        <i class="fa fa-info-circle"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary pay_booking"
                                                        data-price="{{ $i_bill->total }}">
                                                        <i class="fa-solid fa-money-check-dollar"></i> Pay Now</button>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $bill->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ secure_asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ secure_asset('js/page/features-posts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-W8J9wdfZwoeNFElb"></script>

    <script>
        function details(message) {
            Swal.fire(message);
        }
        $(document).on("click", ".pay_booking", function() {
            // $(".pay_booking").on("click", function() {
            var total = 3000; // Total pembayaran
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/create-transaction', // URL ke endpoint Laravel
                method: 'POST',
                data: {
                    total: total
                },
                headers: {
                    'X-CSRF-TOKEN': token // Add CSRF token to headers
                },
                success: function(response) {
                    // Dapatkan snap_token dari response backend
                    var snapToken = response.snap_token;
                    console.log(snapToken);
                    // Memulai pembayaran dengan Midtrans Snap
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            alert('Pembayaran Berhasil!');
                            console.log(result);
                        },
                        onPending: function(result) {
                            alert('Pembayaran Tertunda!');
                            console.log(result);
                        },
                        onError: function(result) {
                            alert('Pembayaran Gagal!');
                            console.log(result);
                        }
                    });
                },
                error: function(error) {
                    console.error('Gagal membuat transaksi:', error);
                }
            });
        });
    </script>
@endpush
