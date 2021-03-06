<?php

namespace Botble\Marketplace\Http\Controllers;

use Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Setting\Supports\SettingStore;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketplaceController extends BaseController
{
    /**
     * @var SettingStore
     */
    protected $settingStore;

    /**
     * MarketplaceController constructor.
     * @param SettingStore $storeLocatorRepository
     */
    public function __construct(SettingStore $settingStore)
    {
        $this->settingStore = $settingStore;
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @param SettingStore $settingStore
     * @return Factory|View
     */
    public function settings(Request $request, BaseHttpResponse $response)
    {
        if ($request->method() == 'POST') {
            return $this->postSettings($request, $response);
        }
        page_title()->setTitle(trans('plugins/marketplace::marketplace.settings.name'));

        return view('plugins/marketplace::settings.index');
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    private function postSettings($request, $response) {
        $settingKey = get_marketplace_setting_key();
        $filtered = collect($request->all())->filter(function ($value, $key) use ($settingKey) {
            return Str::startsWith($key, $settingKey);
        });

        foreach ($filtered as $key => $settingValue) {
            switch ($key) {
                case $settingKey . 'fee_per_order':
                    $settingValue = $settingValue < 0 ? 0 : ($settingValue > 100 ? 100 : $settingValue);
                    break;
            }
            $this->settingStore->set($key, $settingValue);
        }

        $this->settingStore->save();

        return $response
            ->setNextUrl(route('marketplace.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
