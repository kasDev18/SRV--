<?php

namespace App\Services;

use App\Models\Orders;
use App\Models\Candidate;

class OrderService
{
    public function saveOrder(int $candidateId): void
    {
        $candidate = Candidate::find($candidateId);
        if (!$candidate) {
            throw new \Exception('Candidate not found', 404);
        }

        Orders::create([
            'candidate_id' => $candidateId
        ]);
    }

    public function assignOrder(int $candidateId,$orderId): void
    {
        $candidate = Candidate::find($candidateId);
        $order = Orders::find($orderId);
        if (!$candidate) {
            throw new \Exception('Candidate not found', 404);
        }
        if (!$order) {
            throw new \Exception('Order not found', 404);
        }

        $candidate->order_id = $orderId;
        $candidate->is_working = Candidate::STATUS_DURING_RECRUITMENT;
        $candidate->save();

    }
}
