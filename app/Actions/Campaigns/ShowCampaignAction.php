<?php


namespace App\Actions\Campaigns;


use App\Contracts\CampaignRepository;
use App\Supports\Traits\HasTransformer;
use App\Transformers\CampaignTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ShowCampaignAction
{
    use HasTransformer;

    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $repository)
    {
        $this->campaignRepository = $repository;
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $campaign = $this->campaignRepository->find($id);

            if(!$campaign) {
                throw new BadRequestHttpException;
            }
            DB::commit();
            return $this->httpOK($campaign, CampaignTransformer::class);
        }catch (\Exception $e ) {
            DB::rollBack();
            Log::error("Cannot find {$id} in the Campaign table");
            return $this->httpNotFound([], 404, 'Oops! Something went wrong');
        }

    }
}
