<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function __invoke($lang = 'en'){
        request()->session()->put('locale',$lang);
        return redirect()->back();
    }
}
