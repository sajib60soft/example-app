@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('SMS') }}</div>
                <div class="card-body">
                    <form action="{{ route('sms.send') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="phone_number">Email address</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Phone Number">
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