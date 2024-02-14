<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Str;
use Illuminate\Support\Facades\Auth;

class ShortLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()

    {   
        $shortLinks = ShortLink::where('user_id', Auth::id())->latest()->get();
        
        return view ('shortenLink',compact('shortLinks')); 


    }
    public function store(Request $request)
    {
        
        $request->validate(['link' => 'required|url']);
    
        // Generate a unique short code
        $unique = false;
        do {
            $code = Str::random(6); // Adjust length as needed
            $existingLink = ShortLink::where('code', $code)->first();
            if (!$existingLink) {
                $unique = true;
            }
        } while (!$unique);
    
        
        $shortLink = ShortLink::create([
            'user_id' => Auth::id(), 
            'link' => $request->link,
            'code' => $code,
        ]);
      
        
        $shortUrl = url('/s/' . $code); 

    
        return redirect()->route('generate.shorten.link')->with('success', 'Short URL has been generated: ' . $shortUrl);
    }
    
    
    


    public function redirect($code)
    {
        $find = ShortLink::where('code', $code)->firstOrFail();
        $find->increment('clicks'); // Increment clicks count
        return redirect($find->link);
    }


}

    



    //

