<?php

namespace Botble\ACL\Models;

use Botble\ACL\Traits\PermissionTrait;
use Botble\Base\Models\BaseModel;
use Botble\Slug\Models\Slug;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VendorCompany extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor_companies';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'company_name',
        'user_id',
        'company_address',
        'city',
        'country',
        'latitude',
        'longitude',
        'account_title',
        'bank_name',
        'swift_code',
        'account_iban',
        'about_company'
    ];


    /**
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function companySlug()
    {
        return $this->hasOne(Slug::class,'reference_id')->where('prefix','seller');
    }
}
