<?php

namespace App\Http\Controllers\Campaigns;

use App\Actions\Campaigns\DeleteCampaignAction;
use App\Actions\Campaigns\IndexCampaignAction;
use App\Actions\Campaigns\ShowCampaignAction;
use App\Actions\Campaigns\StoreCampaignAction;
use App\Actions\Campaigns\UpdateCampaignAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * @param  \App\Actions\Campaigns\IndexCampaignAction  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexCampaignAction $action): JsonResponse
    {
        return ($action)();
    }

    /**
     * @param  StoreCampaignRequest  $request
     * @param  StoreCampaignAction  $action
     *
     * @return JsonResponse
     */
    public function store(StoreCampaignRequest  $request, StoreCampaignAction $action): JsonResponse
    {

        return ($action)($request->validated());
    }


    /**
     * @param  int  $id
     * @param  ShowCampaignAction  $action
     *
     * @return JsonResponse
     */
    public function show(int $id, ShowCampaignAction $action): JsonResponse
    {
        return ($action)($id);
    }

    /**
     * @param  UpdateCampaignRequest  $request
     * @param  int  $id
     * @param  UpdateCampaignAction  $action
     *
     * @return JsonResponse
     */
    public function update(UpdateCampaignRequest $request, int $id, UpdateCampaignAction $action): JsonResponse
    {
        return ($action)($request->validated(), $id);
    }

    public function destroy(int $id, DeleteCampaignAction $action)
    {
        return ($action)($id);
    }

}
