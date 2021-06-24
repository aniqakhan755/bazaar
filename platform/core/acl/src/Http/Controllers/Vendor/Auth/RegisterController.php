<?php

namespace Botble\ACL\Http\Controllers\Vendor\Auth;
use Assets;
use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Http\Requests\CreateVendorRequest;
use Botble\ACL\Models\VendorCompany;
use Botble\ACL\Services\CreateUserService;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Models\Product;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;
use SlugHelper;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Botble\Slug\Services\SlugService;


class RegisterController extends BaseController
{
    public function showRegistrationForm()
    {
        page_title()->setTitle(trans('core/acl::auth.register_title'));

        Assets::addScripts(['jquery-validation'])

            ->addStylesDirectly('vendor/core/core/acl/css/login.css')
            ->removeStyles([
                'select2',
                'fancybox',
                'spectrum',
                'simple-line-icons',
                'custom-scrollbar',
                'datepicker',
            ])
            ->removeScripts([
                'select2',
                'fancybox',
                'cookie',
            ]);

        return view('core/acl::auth.vendor-register');
    }
    public function register(CreateVendorRequest $request, CreateUserService $service, BaseHttpResponse $response){


        $request->request->add(['role_id' => '1']);

        $user = $service->execute($request);
        $request['user_id'] = $user->id;

        $company = VendorCompany::create($request->all());
        $slugService = new SlugService(app(SlugInterface::class));
        $slug = $slugService->create($company->company_name,0,VendorCompany::class);

        Slug::create([
            'reference_type' => VendorCompany::class,
            'reference_id'   => $company->id,
            'key'            => $slug,
            'prefix'         => SlugHelper::getPrefix(VendorCompany::class),
        ]);

        event(new CreatedContentEvent(USER_MODULE_SCREEN_NAME, $request, $user));

        return $response
//            ->setPreviousUrl(route('users.index'))
            ->setNextUrl(route('vendor.register-success'))
            ->setMessage(trans('core/base::notices.create_success_message'));

    }
    public function registerSuccess(){
        return view('core/acl::auth.register-success');
    }

}
