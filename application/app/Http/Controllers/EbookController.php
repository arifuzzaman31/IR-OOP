<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Helpers\CustomHelper;
use App\Models\Circular;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    public function writings(Request $request)
    {
        $page_title = "Ebook List";
        $jury_list = User::where('role_id', 3)->get();
        if (Auth::user()->role_id == 4) {
            // $ebooks = Ebook::where(['approval_status' => "Writing", 'jury_members' => Auth::user()->id])->orderBy('id', 'DESC')->get();
            $ebooks = Ebook::where(['approval_status' => "Writing", 'author_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();
        } else {
            $ebooks = Ebook::where(['approval_status' => "Writing"])->orderBy('id', 'DESC')->get();
        }
        return view('pages.ebook.writing_list', ['page_title' => $page_title, 'ebooks' => $ebooks, 'jury_list' => $jury_list]);
    }
    public function index(Request $request)
    {
        $page_title = "Ebook List";
        $jury_list = User::where('role_id', 3)->get();
        $ebooks = Ebook::whereNot('approval_status', "Writing")->whereNot('approval_status', "Published")->orderBy('id', 'DESC')->get();
        return view('pages.ebook.ebook_list', ['page_title' => $page_title, 'ebooks' => $ebooks, 'jury_list' => $jury_list]);
    }


    // Depricated 
    public function ebook_templete($method, $templete_type, $slug = null)
    {
        $type = '';
        switch ($templete_type) {
            case 'study':
                $template_id = 1;
                $type = 'Study';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'research':
                $template_id = 2;
                $type = 'Research';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'article':
                $template_id = 3;
                $type = 'Article';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'innovative_idea':
                $template_id = 4;
                $type = 'Innovative Idea';
                $page = 'pages.ebook.create.templete_innovative_idea';
                break;
            case 'case_story':
                $template_id = 5;
                $type = 'Case Story';
                $page = 'pages.ebook.create.templete_case_story';
                break;
            case 'success_story':
                $template_id = 6;
                $type = 'Sucesss Story';
                $page = 'pages.ebook.create.templete_case_story';
                break;
            case 'proomising_practices':
                $template_id = 7;
                $type = 'Promising Practices';
                $page = 'pages.ebook.create.templete_promising_practices';
                break;
            default:
                # code...
                break;
        }

        if ($method == "edit") {
            $data['ebook'] = $ebook = Ebook::where('slug', $slug)->first();
            $data['ebook_form_data'] = $ebook?->form_data;
            // $data['ebook_form_data'] = json_encode($ebook?->form_data);
            // dd($data);
            // $data['page_title'] = "Ebook - " . $ebook?->title;
            $data['page_title'] = "Ebook - " . $type;
            $data['post_url'] = '/admin/ebook_update/' . $slug;
        } else {
            $data['page_title'] = "Create Ebook - " . $type;
            $data['post_url'] = '/admin/ebook_store/';
        }

        $data['type'] = $type;
        $data['method'] = $method;
        $data['template_id'] = $template_id;
        $data['templete_type'] = $templete_type;
        $data['templete'] = Template::findOrFail($template_id);

        // dd($data);
        return view($page, $data);
    }
    
    
    // Active for ebook create and edit
    public function circular_ebook($method, $templete_type, $circular_slug, $slug = null)
    {
        $type = '';
        switch ($templete_type) {
            case 'study':
                $template_id = 1;
                $type = 'Study';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'research':
                $template_id = 2;
                $type = 'Research';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'article':
                $template_id = 3;
                $type = 'Article';
                $page = 'pages.ebook.create.templete_study_create';
                break;
            case 'innovative_idea':
                $template_id = 4;
                $type = 'Innovative Idea';
                $page = 'pages.ebook.create.templete_innovative_idea';
                break;
            case 'case_story':
                $template_id = 5;
                $type = 'Case Story';
                $page = 'pages.ebook.create.templete_case_story';
                break;
            case 'success_story':
                $template_id = 6;
                $type = 'Sucesss Story';
                $page = 'pages.ebook.create.templete_case_story';
                break;
            case 'proomising_practices':
                $template_id = 7;
                $type = 'Promising Practices';
                $page = 'pages.ebook.create.templete_promising_practices';
                break;
            default:
                # code...
                break;
        }

        if ($method == "edit") {
            $data['ebook'] = $ebook = Ebook::where('slug', $slug)->first();
            $data['ebook_form_data'] = $ebook?->form_data;
            // $data['ebook_form_data'] = json_encode($ebook?->form_data);
            // dd($data);
            $data['page_title'] = "Ebook - " .  $type;
            $data['post_url'] = '/admin/ebook_update/' . $slug;
        } else {
            $data['page_title'] = "Create Ebook - " . $type;
            $data['post_url'] = '/admin/ebook_store/';
        }

        $data['type'] = $type;
        $data['method'] = $method;
        $data['template_id'] = $template_id;
        $data['templete_type'] = $templete_type;
        $data['templete'] = Template::findOrFail($template_id);
        $data['circular'] = Circular::where('slug', $circular_slug)->first();

        // dd($data);
        return view($page, $data);
    }


    public function ebook_store(Request $request)
    {
        // dd($request->submit);
        // dd($request->all());

        // Validate and save data
        $validatedData = $request->validate([
            // 'cover_image' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:204800',
            // 'ebook' => 'nullable|string',
            'cover_image_id' => 'nullable|string',
        ]);
        $validatedData['title'] = $request->input('ebook_title');
        $validatedData['author_name'] = $request->input('ebook_author_name');
        $validatedData['date'] = $request->input('ebook_date');
        $validatedData['form_data'] = $request->input();

        if (!empty($request->cover_image_id)) {
            $validatedData['cover_image_id'] = $request->cover_image_id;
        }



        // if ($request->file('cover_image')) {
        //     $file = $request->file('cover_image');
        //     $media = CustomHelper::upload_media_file($file);
        //     $validatedData['cover_image_id'] = $media->id;
        // }

        // unset($form_data['_token']);
        // unset($form_data['type']);
        // unset($form_data['templete_type']);
        $validatedData['approval_status'] = $request->submission_type == "save" ? "Writing" : "Pending";



        if ($request->method == "edit") {
            $ebook = Ebook::where('slug', $request->slug);
            $ebook->update($validatedData);
        } else {
            $validatedData['slug'] = rand(100, 999) . time();
            $validatedData['template_id'] = $request->input('template_id');
            $validatedData['circular_id'] = $request->input('circular_id');
            $validatedData['author_id'] = $request->user()?->id ?: null;
            $validatedData['status'] = 1;
            $ebook = Ebook::create($validatedData);
        }
        return response()->json($ebook, 201);
    }

    public function ebook_edit(Request $request, $slug)
    {
        $data['page_title'] = "Ebook - Edit";
        $data['ebook'] = Ebook::where('slug', $slug)->first();
        return view('pages.ebook.ebook_edit', $data);
    }

    public function ebook_status_update(Request $request, $slug)
    {
        $ebook = Ebook::where('slug', $slug)->first();

        $validatedData = $request->validate([
            'approval_status' => 'sometimes',
            'approved_by' => 'sometimes',
            'approved_at' => 'sometimes'
        ]);

        $ebook->update($validatedData);

        return response()->json($ebook, 200);
    }


    public function ebook_delete(Request $request, $slug = null)
    {
        $item = Ebook::where('slug', $slug)->first();
        $status = $item->delete();
        return redirect()->back();
    }



    public function update_jury_member(Request $request, $type)
    {
        $ebook_id = $request->ebook_id;
        $member_id = $request->member_id;

        $ebook = Ebook::find($ebook_id);
        $jury_members = (!empty($ebook->jury_members)) ? $ebook->jury_members : [];


        if ($type == "add") {
            if (!in_array($member_id, $jury_members)) {
                $jury_members[] = $member_id;
            }
        }

        if ($type == "remove") {
            $jury_members = array_diff($jury_members, array($member_id));
        }

        $ebook->update([
            'jury_members' => $jury_members,
        ]);

        return response()->json(['message' => 'Ebook updated successfully', 'ebook' => $ebook, 'status' => 200], 200);
    }
}
