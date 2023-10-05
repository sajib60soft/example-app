@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Notification') }}</div>
                <div class="card-body">
                    <form action="{{ route('notification.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                        </div>
                        <div class="form-group mb-2">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" id="message" placeholder="Message"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script type="text/javascript">
    "use strict";
    $(document).ready(function() {
        var firebaseConfig = {
            apiKey: "AIzaSyDCthiio0WgX1F2CiVlw1Z-kWOKYYi6vQI",
            authDomain: "we-courier-81101.firebaseapp.com",
            projectId: "we-courier-81101",
            storageBucket: "we-courier-81101.appspot.com",
            messagingSenderId: "151878495365",
            appId: "1:151878495365:web:133d9bace19a4846260dec",
            measurementId: "G-V1K1HVXD5G"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        startFCM();
        function startFCM() {
            messaging.requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("token.store") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (result) {
                            console.log(result);
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
                }).catch(function (error) {
                    console.log(error);
                });
        }

        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            Swal.fire({
                imageUrl:payload.notification.image,
                title: title,
                text: payload.notification.body,
                position: 'top',
                showOkButton: true,
                showCancelButton: true,
                confirmButtonText: yes,
                cancelButtonText: cancel,
            }).then((result) => {
                if (result.isConfirmed){
                    console.log('ok');
                }
            })
            new Notification(title, options);
        });
    });
</script> 
@endpush