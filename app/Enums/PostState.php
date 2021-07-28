<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DRAFT()
 * @method static static PUBLISHED()
 */
final class PostState extends Enum
{
    const DRAFT = 0;
    const PUBLISHED = 1;
}
