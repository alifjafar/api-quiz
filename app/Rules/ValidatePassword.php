<?php

namespace App\Rules;

use App\Models\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ValidatePassword implements Rule
{
    private $client;
    /**
     * Create a new rule instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->client->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The current password you\'ve entered is incorrect';
    }
}
