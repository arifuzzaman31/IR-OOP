<?php

namespace App\Http\Controllers;

use Mail;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Helpers\CustomHelper;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public function counting_jury_pending_review()
    {
        $juryMemberId = strval(Auth::user()->id);
        $currentDate = Carbon::today();

        $ebooks = \App\Models\Ebook::where('approval_status', 'InReview')
            ->with('circular_mave')
            ->whereHas('circular_mave', function ($query) use ($currentDate, $juryMemberId) {
                $query->where('deadline', '>=', $currentDate)->whereJsonContains('jury_members', $juryMemberId);
            })->get();

        $reviewed = 0;
        $pending_review = 0;

        foreach ($ebooks as $ebook) {
            $evaluation = \App\Models\Evaluation::where('ebook_id', $ebook->id)
                ->where('jury_id', $juryMemberId)
                ->first();

            if ($evaluation) {
                $reviewed++;
            } else {
                $pending_review++;
            }
        }

        return response()->json([$ebooks, $reviewed, $pending_review], 200);
    }

    public function jury_auth_check(Request $request, $ebook_id, $jury_id)
    {
        // $result = CustomHelper::jury_evaluation_auth($ebook_id, $jury_id);
        $result = CustomHelper::jury_evaluated_check($ebook_id, $jury_id);

        return response()->json($result, 200);
    }

    public function jury_circular_evaluation_auth(Request $request, $circular_id, $ebook_id, $jury_id)
    {
        // $result = CustomHelper::jury_evaluation_auth($ebook_id, $jury_id);
        $result = CustomHelper::jury_circular_evaluation_auth($circular_id, $ebook_id, $jury_id);

        return response()->json($result, 200);
    }

    public function test_email()
    {
        $email = "Zeeshan.akhtar@webable.digital";
        $token = \Str::random(60);
        $details = [
            'backUri' => url('/'),
            'token' => $token,
            'email' => $email
        ];

        $result = \Mail::to($email)->send(new \App\Mail\ResetPasswordMail($details));

        return response()->json($result, 200);
    }
}
