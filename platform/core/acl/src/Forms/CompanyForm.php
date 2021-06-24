<?php

namespace Botble\ACL\Forms;

use Botble\ACL\Http\Requests\UpdateCompanyProfileRequest;
use Botble\ACL\Models\VendorCompany;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Ecommerce\Supports\EcommerceHelper;

class CompanyForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new VendorCompany)
            ->setFormOption('template', 'core/base::forms.form-no-wrap')
            ->setFormOption('id', 'company-form')
            ->setFormOption('class', 'row')
            ->setValidatorClass(UpdateCompanyProfileRequest::class)
            ->withCustomFields()
            ->add('company_name', 'text', [
                'label'      => trans('core/acl::users.info.company_name'),
                'label_attr' => ['class' => 'control-label required'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('company_address', 'text', [
                'label'      => trans('core/acl::users.info.company_address'),
                'label_attr' => ['class' => 'control-label required'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('country', 'select', [
                'label'      => trans('core/acl::users.info.country'),
                'label_attr' => ['class' => 'control-label required'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'choices'    => ['' => __('Select Country')] + EcommerceHelper::getCountries(),
            ])
            ->add('city', 'select', [
                'label'      => trans('core/acl::users.info.city'),
                'label_attr' => ['class' => 'control-label required'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
                'choices'    => ['' => __('Select City')] + EcommerceHelper::getAvailableCities(),
            ])
            ->add('about_company', 'textarea', [
                'label'      => trans('core/acl::users.info.about_company'),
                'label_attr' => ['class' => 'control-label required'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-12',
                ],
            ])
            ->add('bank_name', 'text', [
                'label'      => trans('core/acl::users.info.bank_name'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('account_title', 'text', [
                'label'      => trans('core/acl::users.info.account_title'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('swift_code', 'text', [
                'label'      => trans('core/acl::users.info.swift_code'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('account_iban', 'text', [
                'label'      => trans('core/acl::users.info.account_iban'),
                'label_attr' => ['class' => 'control-label'],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->setActionButtons(view('core/acl::users.profile.actions')->render());
    }
}
