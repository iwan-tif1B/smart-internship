@extends('layouts.app')

@section('title', 'Master')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fa-solid fa-gamepad mx-1"></i>Data List Playstation Available
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <input type="date" class="form-control form-control-sm tanggal_booking mt-4"
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>


            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row">
                    @foreach ($masterps as $i_ps)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="name_master"
                                                id="name_master" value="{{ $i_ps->id }}" style="transform: scale(1.5);">
                                            <label class="form-check-label" for="name_master">{{ $i_ps->name }}</label>
                                        </div>
                                    </h5>
                                    <p class="card-text"><i class="fa-solid fa-money-check-dollar"></i> Starting from Rp.
                                        {{ number_format($i_ps->price) }} and addtional on weekend Rp.
                                        {{ number_format($i_ps->additional_fee) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-4 row_data">

                </div>
            </div>
        </section>
    </div>
    <span id="cek_list_details" data-url="/datalist/search_playstation"></span>
    <span id="store_payment" data-url="/datalist/store_payment"></span>
    {{-- <button id="cek_list_details" data-url="/datalist/search_playstation">Search</button> --}}

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $("input[name='name_master']").on("click", function() {
            var date = $(".tanggal_booking").val();
            if (date == null) {
                Swal.fire({
                    title: "Warning ! ",
                    text: "Please Select Date Booking",
                    icon: "warning"
                });
                return;
            }
            var id = $(this).val();
            var url = $("#cek_list_details").data("url") + "?detail_id=" + id + "&date=" + date;
            console.log(url);

            // Get CSRF token from the meta tag
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id,
                    date: date
                },
                headers: {
                    'X-CSRF-TOKEN': token // Add CSRF token to headers
                },
                success: function(res) {
                    var response = res.response.data;
                    $(".row_data").html('');
                    // Loop through each item in the response data
                    response.forEach(function(item) {
                        var html = `<div class="col-lg-3">
                        <div class="card border-success mt-1" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-success"><b>${item.session} [${item.hour}] hour</b></div>
                            <div class="card-body text-primary">
                                <h5 class="card-title">${item.name}</h5>
                                <p class="card-text">${item.duration}</p>
                                <small>${item.note}</small>
                            </div>
                            <div class="card-footer bg-transparent border-success">
                                <button type="button" class="btn-${item.color} booking" ${item.booked}
                                data-price="${item.price}" data-id_details="${item.id}"data-note="${item.note}">
                                    <i class="fa-solid fa-cart-shopping mx-1"></i>Booking Now  ${item.price}</button>
                            </div>
                        </div>
                    </div>`;
                        $(".row_data").append(html);
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Terjadi kesalahan:", error);
                },
                complete: function() {
                    formSubmitted = false;
                },
            });
        });
        $(document).on("click", ".booking", function() {
            var id = $(this).data("id_details");
            var price = $(this).data("price");
            var url = $("#store_payment").data("url");
            var date = $(".tanggal_booking").val();
            var note = $(this).data("note");
            console.log(url);
            Swal.fire({
                title: "Confirmation?",
                text: "You will make a booking worth Rp." + price + " , Continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Continue!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var date = $(".tanggal_booking").val();
                    if (date == null) {
                        Swal.fire({
                            title: "Warning ! ",
                            text: "Please Select Date Booking",
                            icon: "warning"
                        });
                        return;
                    }
                    // Get CSRF token from the meta tag
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            id: id,
                            price: price,
                            date: date,
                            note: note
                        },
                        headers: {
                            'X-CSRF-TOKEN': token // Add CSRF token to headers
                        },
                        success: function(res) {
                            if (res.metadata.code === 200) {
                                Swal.fire({
                                    title: "Submit!",
                                    text: "Thanks for your booking, please make payment immediately :)",
                                    icon: "success"
                                });

                                // Set a delay of 3 seconds (3000 milliseconds) before redirecting
                                setTimeout(function() {
                                    window.location.href = "datalist/detail_booked";
                                }, 3000); // 3000 ms = 3 seconds
                            } else {
                                Swal.fire({
                                    title: "Warning",
                                    text: res.metadata.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Terjadi kesalahan:", error);
                        },
                        complete: function() {
                            formSubmitted = false;
                        },
                    });
                }
            });
        });
    </script>
@endpush
