<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class MaxPosts implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get The Logged in User
        $user = Auth::user();

        // Count the number of posts created by the user
        $postCount = Post::where('user_id', $user->id)->count();
        // If the user already has 3 posts, add a validation failure
        if ($postCount >= 3) {
            $fail('You can only create a maximum of 3 posts.');
        }
    }
}
