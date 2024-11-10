<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function faq() {
        return view('pages.faq');
    }
    public function contact() {
        return view('pages.contact');
    }
    public function about() {
        return view('pages.about');
    }
    public function privacypolicy() {
        return view('pages.privacypolicy');
    }
    public function termsofservice() {
        return view('pages.termsofservice');
    }
}
