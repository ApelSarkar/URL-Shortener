@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('home') }}" class="btn btn-primary mt-2">Dashboard</a>
        <h1>Your Shortened URLs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Long URL</th>
                    <th>Short URL</th>
                    <th>Click Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($urls as $url)
                    <tr>
                        <td>{{ $url->long_url }}</td>
                        <td><a href="{{ url($url->short_code) }}" target="_blank">{{ url($url->short_code) }}</a></td>
                        <td>{{ $url->click_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
