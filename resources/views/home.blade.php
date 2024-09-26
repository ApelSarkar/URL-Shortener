<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>URL Shortener</h1>
        <div class="row">
            <div class="col-md-8">
                <form id="urlShortenerForm">
                    @csrf
                    <div class="form-group">
                        <label for="url">Enter your long URL:</label>
                        <input type="url" id="url" name="url" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Shorten URL</button>
                </form>
                <div id="result" class="mt-3" style="display: none;">
                    <p>Long URL: <span id="longUrl"></span></p>
                    <p>Short URL: <a href="#" id="shortUrl" target="_blank"></a></p>
                </div>
            </div>
            <div class="col-md-4 text-end" style="margin-top: 10px;">
                <a href="/user/urls" class="btn btn-info mt-2">See details</a>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('urlShortenerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('shorten') }}", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('result').style.display = 'block';
                    document.getElementById('longUrl').textContent = data.longUrl;
                    let shortUrl = document.getElementById('shortUrl');
                    shortUrl.textContent = data.shortUrl;
                    shortUrl.href = data.shortUrl;
                })
                .catch(error => console.log(error));
        });
    </script>
@endsection
