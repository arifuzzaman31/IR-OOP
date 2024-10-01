<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Template;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // return "dhfdgh";
        $data['page_title'] = "Dashboard";


        $data['templates'] = Template::get();
        $data['ebook_count'] = Ebook::whereIn('approval_status', array('Pending', 'InReview'))->select('template_id', DB::raw('COUNT(template_id) as ebooks'))->groupBy('template_id')->get();
        $data['publication_count'] = Ebook::where('approval_status', 'Published')->select('template_id', DB::raw('COUNT(template_id) as publications'))->groupBy('template_id')->get();

        $data['jury_count'] = User::where('role_id', 3)->count();
        $data['user_count'] = User::where('role_id', 4)->count();

        $data['latest_publications'] = Ebook::where('approval_status', 'Published')->orderBy('created_at', 'desc')->get();

        return view('pages.dashboard', $data);
    }
}
