<?php


namespace App\Repositories;


use App\Contracts\CampaignRepository;
use App\Models\Campaign;
use Illuminate\Container\Container as Application;

class EloquentCampaignRepository extends EloquentBaseRepository implements CampaignRepository
{

    public function model(): string
    {
        return Campaign::class;
    }

    public function __construct(Application $app)
    {
        parent::__construct($app);

    }
}
