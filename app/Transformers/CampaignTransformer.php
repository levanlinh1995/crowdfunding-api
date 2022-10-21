<?php

namespace App\Transformers;

use App\Models\Campaign;
use Flugg\Responder\Transformers\Transformer;

class CampaignTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Campaign $campaign
     * @return array
     */
    public function transform(Campaign $campaign)
    {
        return [
            'id'                => (int) $campaign->id,
            'title'             => $campaign->title,
            'description'       => $campaign->description,
            'short_description' => $campaign->short_description,
            'status'            => $campaign->status
        ];
    }
}
