<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = 'Categories';
        $data['templates'] = Template::get();
        $data['jury_list'] = User::where('role_id', 3)->get();

        return view('pages.templates', $data);
    }


    public function store(Request $request, $type)
    {
        $templete_id = $request->templete_id;
        $member_id = $request->member_id;

        $templete = Template::find($templete_id);
        $jury_members = (!empty($templete->jury_members)) ? $templete->jury_members : [];


        if ($type == "add") {
            if (!in_array($member_id, $jury_members)) {
                $jury_members[] = $member_id;
            }
        }

        if ($type == "remove") {
            $jury_members = array_diff($jury_members, array($member_id));
        }

        $templete->update([
            'jury_members' => $jury_members,
        ]);

        return response()->json(['message' => 'Template updated successfully', 'template' => $templete, 'status' => 200], 200);
    }


    public function store_api_test(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jury_members' => 'nullable|array',
        ]);


        $press_release = Template::create($validatedData);
        return response()->json($press_release, 201);

        // $templete = Template::findOrFail($id);
        // $templete->update($validatedData);

        // return response()->json($templete, 200);
    }


    public function templete_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'structure' => 'nullable|array',
        ]);

        $template = Template::find($id);
        $template->update($validatedData);

        return response()->json($template, 200);
    }
}
