<?php

namespace App\Services;

use App\Models\Orders;
use App\Models\Candidate;
use App\Models\Project;

class ProjectService
{

    public function addProject(int $candidateId,$startDate): void
    {
        $candidate = Candidate::find($candidateId);
        $order_id = $candidate->order_id;
        $order = Orders::find($order_id);
        if (!$candidate) {
            throw new \Exception('Candidate not found', 404);
        }
        if (!$order) {
            throw new \Exception('Order not found', 404);
        }

        $project = new Project();
        $project->candidate_id = $candidateId;
        $project->project_title = $order->topic;
        $project->project_description = $order->description;
        $project->customer_id = $order->customer_id;
        $project->start_time = $startDate;
        $project->project_link = "";
        $project->save();


        $candidate->is_working = Candidate::STATUS_WORKING;
        $candidate->save();

    }
}
