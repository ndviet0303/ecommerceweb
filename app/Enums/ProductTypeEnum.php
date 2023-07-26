<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductTypeEnum extends Enum
{
    public const LIFETIME = 0;
    public const HOUR = 1;
    public const DAY = 2;
    public const WEEK = 3;
    public const MONTH = 4;
    public const YEAR = 5;

    public static function getArrayView(): array {
        return [
            'Vĩnh Viễn' => self::LIFETIME,
            'Giờ' => self::HOUR,
            'Ngày' => self::DAY,
            'Tuần' => self::WEEK,
            'Tháng' => self::MONTH,
            'Năm' => self::YEAR,
        ];
    }
}
