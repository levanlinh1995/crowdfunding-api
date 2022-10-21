<?php


namespace App\Actions\Campaigns;


use App\Contracts\CampaignRepository;
use App\Supports\Traits\HasTransformer;
use App\Transformers\CampaignTransformer;
use Illuminate\Http\JsonResponse;

class IndexCampaignAction
{
    use HasTransformer;

    private CampaignRepository $campaignRepository;

    /**
     * IndexCampaignAction constructor.
     *
     * @param  CampaignRepository  $repository
     */
    public function __construct(CampaignRepository $repository)
    {
        $this->campaignRepository = $repository;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $campaigns = $this->campaignRepository->all();

        return $this->httpOK($campaigns, CampaignTransformer::class);
    }

}
