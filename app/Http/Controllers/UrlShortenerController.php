<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $shortCd = Str::random(8);

        $urlShortner = UrlShortener::create([
            'user_id' => auth()->id(),
            'long_url' => $request->url,
            'short_code' => $shortCd,
        ]);

        return response()->json([
            'shortUrl' => url('/' . $shortCd),
            'longUrl' => $request->url,
        ]);
    }

    public function redirect($code)
    {
        $urlShortener = UrlShortener::where('short_code', $code)->firstOrFail();
        $urlShortener->increment('click_count');
        return redirect($urlShortener->long_url);
    }

    public function userUrls()
    {
        $urls = UrlShortener::where('user_id', auth()->id())->get();
        return view('urls', ['urls' => $urls]);
    }
}
