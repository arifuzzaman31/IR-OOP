<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\Circular;
use App\Models\Template;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Raw;

class CircularController extends Controller
{
    public function index(Request $request)
    {
        $page_title = "Circular List";
        $jury_list = User::where('role_id', 3)->get();
        if (Auth::user()->role_id == 3) {
            $circular = Circular::whereJsonContains('jury_members', strval(Auth::user()->id))->orderBy('id', 'DESC')->get();
        } else {
            $circular = Circular::orderBy('id', 'DESC')->get();
        }
        // dd(Auth::user()->id);
        // dd($circular[0]['template_mave']);
        return view('pages.circular.circular_list', ['page_title' => $page_title, 'circular' => $circular, 'jury_list' => $jury_list]);
    }


    public function create(Request $request)
    {
        $page_title = "Create Circular";
        $jury_list = User::where('role_id', 3)->get();
        $template_list = Template::orderBy('title', 'ASC')->get();
        return view('pages.circular.circular_create', ['page_title' => $page_title, 'jury_list' => $jury_list, 'template_list' => $template_list, "method" => "create"]);
    }

    public function store(Request $request)
    {
        // dd($request->post());
        $validateData = $request->validate([
            'template_id' => 'nullable',
            'title' => 'nullable',
            'description' => 'nullable',
            'deadline' => 'nullable',
            'jury_members' => 'nullable',
            'cover_image_id' => 'nullable'
        ]);
        $validateData['slug'] = rand(100, 999) . time();
        $validateData['status'] = 1;

        $circular = Circular::create($validateData);

        // $recipients = array_map('trim', explode(',', $request->jury_members));
        // foreach ($request->jury_members as $jury_id) {
        //     $recipients[] = User::findOrFail($jury_id)->email;
        // }

        // Sending Mail to Authors & Jury on circular creation
        $user_list = User::where('role_id', 4)->get();
        foreach ($user_list as $user) {
            $recipients[] = $user->email;
        }

        foreach ($circular->jury_members_mave as $jury_member) {
            $recipients[] = $jury_member->email;
        }

        $sendemail = Mail::to($recipients)->send(new CustomMail(ucwords("Ebook Circular - Invitation"), $circular, "email.circulation_invite"));
        // try {
        // } catch (Exception $e) {
        //     return response()->json(['message' => 'Something went wrong', 'status' => 400], 400);
        // }

        return response()->json(['message' => 'Circular Created successfully', 'circular' => $circular, 'status' => 201], 201);
    }

    public function edit(Request $request, $id)
    {
        $page_title = "Circular";
        $jury_list = User::where('role_id', 3)->get();
        $circular = Circular::findOrFail($id);
        $template_list = Template::orderBy('title', 'ASC')->get();
        return view('pages.circular.circular_edit', ['page_title' => $page_title, 'circular' => $circular, 'jury_list' => $jury_list, 'template_list' => $template_list, "method" => "edit"]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'template_id' => 'nullable',
            'title' => 'nullable',
            'description' => 'nullable',
            'deadline' => 'nullable',
            'cover_image_id' => 'nullable',
            'status' => 'nullable'
        ]);

        $circular = Circular::findOrFail($id);
        $circular->update($validateData);
        return response()->json(['message' => 'Circular Updated successfully', 'circular' => $circular, 'status' => 200], 200);
    }


    public function circular_delete(Request $request, $id)
    {
        $item = Circular::where('slug', $id);
        $status = $item->delete();
        return redirect()->to(
            url('admin/circulars')
        );
    }



    public function update_jury_member(Request $request, $type)
    {
        $circular_id = $request->ebook_id;
        $member_id = $request->member_id;

        $circular = Circular::find($circular_id);
        $jury_members = (!empty($circular->jury_members)) ? $circular->jury_members : [];


        // $recipient = User::findOrFail($member_id)->email;
        // dd($recipient);
        // $recipient = "Zeeshan0811@gmail.com";
        // $sendemail = Mail::to($recipient)->send(new CustomMail(ucwords("Ebook Circulation - Invitation"), $circular, "email.circulation_invite"));
        // return response()->json(['email' => $sendemail, 'status' => 200],200);



        $circular = Circular::find($circular_id);
        $jury_members = (!empty($circular->jury_members)) ? $circular->jury_members : [];

        // dd($circular);


        if ($type == "add") {
            if (!in_array($member_id, $jury_members)) {
                $jury_members[] = $member_id;

                $recipient = User::findOrFail($member_id)->email;
                $sendemail = Mail::to($recipient)->send(new CustomMail(ucwords("Ebook Circular - Invitation"), $circular, "email.circulation_invite"));

                // dd($sendemail);
            }
        }

        if ($type == "remove") {
            $jury_members = array_diff($jury_members, array($member_id));
        }

        $circular->update([
            'jury_members' => $jury_members,
        ]);

        return response()->json(['message' => 'Circular updated successfully', 'circular' => $circular, 'status' => 200], 200);
    }
}
