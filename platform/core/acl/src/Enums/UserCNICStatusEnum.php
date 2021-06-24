<?php

namespace Botble\ACL\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static UserCNICStatusEnum ACTIVATED()
 * @method static UserCNICStatusEnum DEACTIVATED()
 */
class UserCNICStatusEnum extends Enum
{
    public const VERIFIED = 'verified';
    public const NOTVERIFIED = 'not_verified';

    /**
     * @var string
     */
    public static $langPath = 'core/acl::users.cnic_statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::VERIFIED:
                return Html::tag('span', self::VERIFIED()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::NOTVERIFIED:
                return Html::tag('span', self::NOTVERIFIED()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            default:
                return parent::toHtml();
        }
    }
}
