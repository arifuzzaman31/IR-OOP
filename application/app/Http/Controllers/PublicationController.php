<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Ebook;
use Illuminate\Http\Request;


class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $page_title = "Publication List";
        $publications = Ebook::where('approval_status', 'Published')->orderBy('id', 'DESC')->get();
        return view('pages.publication.publication_list', ['page_title' => $page_title, 'publications' => $publications]);
    }

    public function publication_view(Request $request, $slug)
    {
        $publication = Ebook::where('slug', $slug)->first();
        $page_title = $publication->title;
        // return view('pages.publication.publication_view', ['page_title' => $page_title, 'publication' => $publication]);     
        return view('pages.publication.publication_dflip_view', ['page_title' => $page_title, 'publication' => $publication]);
    }


    public function publication_generate_pdf(Request $request, $slug)
    {
        $publication = Ebook::where('slug', $slug)->first();
        $data = ['publication' => $publication];

        // Instantiate Dompdf with options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content from blade view
        $html = view('pages.pdf.publication_templete', $data)->render();

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (optional: save to file or stream)
        $dompdf->render();

        // Stream PDF to browser
        $dompdf->stream('document.pdf', array("Attachment" => false));
        exit(0);
    }
}
