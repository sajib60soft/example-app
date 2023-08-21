@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email') }}</div>
                <div class="card-body">
                    <form action="{{ route('mail.send') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="email@example.com">
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