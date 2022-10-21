<?php


namespace App\Actions\Campaigns;


use App\Contracts\CampaignRepository;
use App\Supports\Traits\HasTransformer;
use App\Transformers\CampaignTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreCampaignAction
{
    use HasTransformer;


    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $repository)
    {
        $this->campaignRepository = $repository;
    }

    /**
     * @param  array  $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(array $data): JsonResponse
    {
        DB::beginTransaction();

        try {
            $campaign = $this->campaignRepository->create($data);

            DB::commit();

            return $this->httpCreated($campaign, CampaignTransformer::class);

        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cannot insert data into the Campaign table', [$e->getMessage()]);
        }
    }
}
