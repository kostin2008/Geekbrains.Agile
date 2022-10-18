<?php declare(strict_types=1);
namespace App\Service;

use App\Models\User as ModelsUser;
use Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User;

class SocialiteService
{

    public function findOrCreateUser(User $socialiteUser)
    {
        $email = $socialiteUser->getEmail();
        $name = $socialiteUser->getName();
        $avatar = $socialiteUser->getAvatar();
        $password = bcrypt(Str::random(25));
        $data = ['email' => $email, 'password' => $password, 'name' => $name, 'avatar' => $avatar];

        if ($user = $this->findUserByEmail($email)) {
            return $user->fill(['name' => $name, 'avatar' => $avatar]);
        }
        return ModelsUser::create($data);

    }

    public function findUserByEmail($email)
    {
        return !$email ? null : ModelsUser::where('email', $email)->first();
    }
}



