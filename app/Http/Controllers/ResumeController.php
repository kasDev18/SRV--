<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class ResumeController extends Controller
{
    public function showForm()
    {
        return view('cv.create_cv');
    }

    public function generateCv(Request $request)
    {
        $data = $request->all();

        // Generate PDF
        $pdf = PDF::loadView('cv.template_cv', $data);
        $filename = $data['name'] . '.pdf';

        return $pdf->download($filename);
    }

    public function generateEnCv(Request $request)
    {
        $data = $request->all();
        $old_locale = App::getLocale();

        App::setLocale('en');
        $pdf = PDF::loadView('cv.template_cv', $data);
        $filename = $data['name'] ?? 'CV';
        $filename = $filename . '-EN.pdf';
        App::setLocale($old_locale);

        return $pdf->download($filename);
    }
}
