<?php

namespace Kirby\Cms;

use Kirby\Exception\DuplicateException;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Toolkit\Str;

/**
 * Validators for all language actions
 *
 * @package   Kirby Cms
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier GmbH
 * @license   https://getkirby.com/license
 */
class LanguageRules
{
    public static function create(Language $language): bool
    {
        static::validLanguageCode($language);
        static::validLanguageName($language);

        if ($language->exists() === true) {
            throw new DuplicateException([
                'key'  => 'language.duplicate',
                'data' => [
                    'code' => $language->code()
                ]
            ]);
        }

        return true;
    }

    public static function update(Language $language)
    {
        static::validLanguageCode($language);
        static::validLanguageName($language);
    }

    public static function validLanguageCode(Language $language): bool
    {
        if (Str::length($language->code()) < 2) {
            throw new InvalidArgumentException([
                'key'  => 'language.code',
                'data' => [
                    'code' => $language->code(),
                    'name' => $language->name()
                ]
            ]);
        }

        return true;
    }

    public static function validLanguageName(Language $language): bool
    {
        if (Str::length($language->name()) < 1) {
            throw new InvalidArgumentException([
                'key'  => 'language.name',
                'data' => [
                    'code' => $language->code(),
                    'name' => $language->name()
                ]
            ]);
        }

        return true;
    }
}
