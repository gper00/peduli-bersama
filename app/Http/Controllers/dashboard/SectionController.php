<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        return view('dashboard.partial.section.index', [
            'sections' => Section::orderBy('id', 'asc')->get(),
            'sectionPage' => true,
            'partialsPage' => true,
        ]);
    }


    public function edit(Section $section)
    {
        return view('dashboard.partial.section.edit', [
            'section' => $section,
            'sectionPage' => true,
            'partialsPage' => true,
        ]);
    }


    public function update(Request $request, Section $section)
    {
        return $request;
    }
}
