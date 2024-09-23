<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Ebook;
use App\Models\Media;
use App\Models\Circular;
use App\Models\Evaluation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CustomHelper
{

    public function __construct() {}

    public static function upload_media_file($file)
    {
        $file_size = $file->getSize();

        // Generate a title based on the original file name
        $originalName = $file->getClientOriginalName();

        $title = pathinfo($originalName, PATHINFO_FILENAME);
        $generatedTitle = "mave_" . Str::random(6);

        // Rename the media
        $mediaName = $generatedTitle . '.' . $file->extension();

        // Move the file to the public/media directory
        $file->move(public_path('media'), $mediaName);

        // Create a new Media record in the database
        $media = Media::create([
            'title' => $originalName,
            'file_name' => $mediaName,
            'file_type' => $file->getClientMimeType(),
            'file_path' => 'media/' . $mediaName,
            'size' => $file_size
        ]);

        return $media;
    }

    public  static  function abbr_to_full_state($abbr)
    {

        $states = [
            'ebook_title' => 'Title',
            'ebook_date' => 'Date',

            // Study/Research/Article----Template 
            'ebook_abstract' => 'Abstract (200 word)',
            'ebook_intro' => 'Introduction and Objective (200 word)',
            'ebook_literature_review' => 'Literature Review (500 word)',
            'ebook_method' => 'Methodology (300 word)',
            'ebook_rd' => 'Results & Discussions including figures and tables (2000 word)',
            'ebook_cr' => 'Conclusion and Recommendations (300 word)',
            'ebook_reference' => 'References (500 word)',

            // Innovative Idea--- Template 
            'problem' => 'What is the problem?',
            'why_innovative' => 'Why is it innovative (200 word)?',
            'participants' => 'Who are the participants (100 word)?',
            'how_work' => 'How will it work (200 word)?',
            'look_like' => 'What will it look like (200 word)?',
            'benifits_participants' => 'What is the benefit for the participants (100 word)?',
            'benefit_organization' => 'What is the benefit for the organization (100 word)?',
            'scale_up' => 'How can be sustainable of your idea or scale up (100 word)?',

            // Case Story/Success Story---- Template 
            'introduction' => 'Introduction/Background (150 word)',
            'problem_solution' => 'Problem & Solution (300 word)',
            'organization_contribution' => 'Organization contribution (100 word)',
            'community_contribution' => 'Community contribution (100 word)',
            'sustain_success' => 'Sustainability of success (250 word)',
            'participants_quotes' => 'Participants quotes (100)',
            'action_photo' => 'Action photo (with caption)',

            // Case Story/Success Story---- Template 
            'problem' => 'Introduction/Background (150 word)',
            'key_achievement' => 'Key achievement (250 word)',
            'participants_benifited' => 'How participants benefited (200 word)',
            'strategy' => 'Which strategy have used (200 word)',
            'leason_learned' => 'What lessons learned generated (200 word)',
        ];

        $full_state = array_key_exists($abbr, $states) ? $states[$abbr] :  $abbr;

        return $full_state;
    }


    public static function jury_evaluation_auth($ebook_id, $user_id)
    {
        $user_id = strval($user_id);
        $ebooks = Ebook::where('id', $ebook_id)->whereJsonContains('jury_members', $user_id)->exists();
        return $ebooks;
    }

    public static function jury_circular_evaluation_auth($circular_id, $user_id)
    {
        $user_id = strval($user_id);
        $circular_count = Circular::where('id', $circular_id)->whereJsonContains('jury_members', $user_id)->count();
        // return $circular_count > 0 ? true : false;
        return $circular_count;
    }

    public static function jury_evaluated_check($ebook_id, $user_id)
    {
        $ebook_id = (int)$ebook_id;
        $user_id = (int)$user_id;

        $matchThese = ['ebook_id' => $ebook_id, 'jury_id' => $user_id];
        $evaluation_exists = Evaluation::where($matchThese)->count();

        // True == Not evaluated, false = already evaluated
        return $evaluation_exists > 0 ? false : true;
    }
    

    public static function counting_this_jury_pending_evaluation($jury_id)
    {
        $juryMemberId = strval($jury_id);
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

        return $pending_review;
    }


    public static function cu_evaluation_title($score)
    {
        $cul_title = '';
        switch ($score) {
            case (50 <= $score && $score <= 59):
                $cul_title = 'Poor';
                break;
            case (60 <= $score && $score <= 69):
                $cul_title = 'Moderate';
                break;
            case (70 <= $score && $score <= 79):
                $cul_title = 'Good';
                break;
            case (80 <= $score && $score <= 89):
                $cul_title = 'Excellent';
                break;
            case (90 <= $score && $score <= 100):
                $cul_title = 'Outstanding';
                break;

            default:
                $cul_title = 'Invalid Score';
                break;
        }

        return $cul_title;
    }
}
