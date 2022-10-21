<?php


namespace App\Actions\Campaigns;


use App\Contracts\CampaignRepository;
use App\Supports\Traits\HasTransformer;
use App\Transformers\CampaignTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UpdateCampaignAction
{
    use HasTransformer;

    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $repository)
    {
        $this->campaignRepository = $repository;
    }

    public function __invoke(array $data, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $campaign = $this->campaignRepository->find($id);
            if(!$campaign) {
                throw new BadRequestHttpException;
            }
            $campaign->update($data);
            $campaign->refresh();
            DB::commit();

            return $this->httpOK($campaign, CampaignTransformer::class);

        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cannot update data in the Campaign table', [$e->getMessage()]);
            return $this->httpBadRequest('Oops! Something went wrong');
        }
    }
}
