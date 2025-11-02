// app/Rules/UserRules.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserRules
{
    public static function register(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public static function login(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
