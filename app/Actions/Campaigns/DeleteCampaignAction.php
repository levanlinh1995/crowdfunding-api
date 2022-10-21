<?php


namespace App\Actions\Campaigns;


use App\Contracts\CampaignRepository;
use App\Supports\Traits\HasTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use function dd;

class DeleteCampaignAction
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

            if($this->campaignRepository->delete($id)) {
                DB::commit();
                return $this->httpNoContent();
            }
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cannot delete data from the Campaign table', [$e->getMessage()]);
            return $this->httpBadRequest('Oops! Something went wrong');
        }

    }
}
