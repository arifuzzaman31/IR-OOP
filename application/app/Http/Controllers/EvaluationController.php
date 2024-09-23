<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Helpers\CustomHelper;
use App\Models\Evaluation;

class EvaluationController extends Controller
{

    public function index(Request $request, $slug)
    {
        // $user_role = Auth::user()->id;
        $data['ebook'] = $ebook = Ebook::with('circular_mave')->where('slug', $slug)->first();
        $data['ebook_templete'] = $ebook->templates_mave;
        $data['ebook_templete_structure'] = $ebook->templates_mave['structure'];
        $data['evaluations'] = Evaluation::where('ebook_id', $ebook['id'])->get();
        $data['evaluation_total_marks'] = Evaluation::where('ebook_id', $ebook['id'])->sum('total_mark');

        $data['juries'] = $ebook['circular_mave']['jury_members_mave'];

        return view('pages.evaluation.evaluation_list', $data);
    }

    public function create(Request $request, $slug)
    {
        $data['ebook'] = $ebook = Ebook::where('slug', $slug)->first();
        $data['page_title'] = "Ebook - " . $ebook->templates_mave->title . " - Evaluation";

        switch ($ebook->template_id) {
            case '1':
            case '2':
            case '3':
                $page = 'pages.evaluation.evaluation_study';
                break;

            case '4':
                $page = 'pages.evaluation.evaluation_innovative';
                break;
            case '5':
            case '6':
                $page = 'pages.evaluation.evaluation_case_story';
                break;

            case '7':
                $page = 'pages.evaluation.evaluation_promising_practices';
                break;

            default:
                $page = 'pages.evaluation.evaluation_case_story';
                break;
        }

        // dd($data);
        return view($page, $data);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jury_id' => 'nullable',
            'ebook_id' => 'nullable',
        ]);

        $evaluation = Evaluation::firstOrNew($validateData);
        $evaluation->evaluation =  $request->evaluation;
        $evaluation->total_mark =  $request->total_mark;
        $evaluation->status =  $request->status;

        $evaluation->save();

        return response()->json(['message' => 'Evaluation updated successfully', 'evaluation' => $evaluation, 'status' => 200], 200);
    }
}
