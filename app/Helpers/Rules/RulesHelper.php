<?php

namespace App\Helpers\Rules;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

final class RulesHelper
{
    // Email
    public const EMAIL = [self::STRING, 'email:strict,dns'];

    // Formats
    public const DATETIME_FORMAT = ['date_format:Y-m-d H:i:s'];
    public const DATE_FORMAT = ['date_format:Y-m-d'];

    // Keys
    public const REQUIRED = 'required';
    public const REQUIRED_IF = 'required_if';
    public const SOMETIMES = 'sometimes';
    public const NULLABLE = 'nullable';
    public const EXISTS = 'exists';
    public const STRING = 'string';
    public const ARRAY = 'array';
    public const JSON = 'json';
    public const BOOLEAN = 'boolean';
    public const INTEGER = 'integer';
    public const UNIQUE = 'unique';
    public const IN = 'in:';
    public const URL = 'url';
    public const REGEX = 'regex:';
    public const CONFIRMED = 'confirmed';

    // Files
    public const FILE = 'file';
    public const PICTURES = ['jpg','jpeg','bmp','png','gif'];
    public const DOCUMENTS = ['webp', 'pdf', 'doc', 'docx'];

    private const FIELDS = 'fields';

    /* @see https://laravel.com/docs/9.x/validation#rule-exists */
    public static function existsOnDatabase(string $table, string $column): Exists
    {
        return Rule::exists($table, $column);
    }

    /* @see https://laravel.com/docs/9.x/validation#rule-unique */
    public static function uniqueOnDatabase(string $table, string $column): Unique
    {
        return Rule::unique($table, $column);
    }

    public function uniqueOnDatabaseWhere(string $table, string $column, array $whereArguments): Unique
    {
        return Rule::unique($table, $column)
            ->where(fn(Builder $query) => $query->where(...$whereArguments));
    }

    public function uniqueOnDatabaseMultipleWhere(string $table, string $column, array $whereArguments): Unique
    {
        return Rule::unique($table, $column)
            ->where(function (Builder $query) use ($whereArguments) {
                foreach ($whereArguments as $whereArgument) {
                    $query->where(...$whereArgument);
                }
                return $query;
            });
    }

    /* @see https://laravel.com/docs/9.x/validation#rule-required-if */
    public static function requiredIfOther(string $anotherField, string|int $value): string
    {
        return self::REQUIRED_IF . ':' . implode(',', [$anotherField, $value]);
    }

    public static function getFieldsRules(): array
    {
        return [
            self::FIELDS => [self::SOMETIMES, self::ARRAY],
            implode('.', [self::FIELDS, '*']) => [self::STRING],
        ];
    }

    /* @see https://laravel.com/docs/9.x/validation#rule-after-or-equal */
    public static function afterOrEqual(string $date): string
    {
        return 'after_or_equal:' . $date;
    }

    public static function min(int $min): string
    {
        return 'min:' . $min;
    }

    public static function max(int $max): string
    {
        return 'max:' . $max;
    }

    public static function mimes(array $fileTypes): string
    {
        return 'mimes:' . implode(',', $fileTypes);
    }
}
