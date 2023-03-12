<?php

namespace App\Repositories;

use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth2;
use Laravel\Socialite\Two\User as UserTwo;

class UserRepository
{
    public function getUserBySocId(UserOAuth2 $user, string $socName) {
        
        // Проверка - есть ли такой пользователь в БД
        $userInSystem = User::query()
            ->where('id_in_social', $user->id)
            ->where('type_auth', $socName)
            ->first();

        if (is_null($userInSystem)) {
            $userInSystem = new User();

        $name = null;
        $surname = null;

        if (!strpos($user->getName(), ' ')) {
            $name = !empty($user->getName())? $user->getName():'';
            $surname = '';
        } else {
            $name = stristr(!empty($user->getName()) ? $user->getName():'', ' ', true);
            $surname = trim(stristr(!empty($user->getName()) ? $user->getName():'', ' '));
        }

            $userInSystem->fill([
                'name' => $name,
                'surname' => $surname,
                'email' => !empty($user->getEmail()) ? $user->getEmail():'',
                'password' => '',
                'id_in_social' => !empty($user->getId()) ? $user->getId():'',
                'type_auth' => $socName,
                'email_verified_at' => now(),
                'avatar' => !empty($user->getAvatar())? $user->getAvatar():'',

            ]);
            $userInSystem->save();
        }

        return $userInSystem;
    }



    public function getUserBySocIdTwo(UserTwo $user, string $socName) {
     
        // Проверка - есть ли такой пользователь в БД
        $userInSystem = User::query()
            ->where('id_in_social', $user->id)
            ->where('type_auth', $socName)
            ->first();

        if (is_null($userInSystem)) {
            $userInSystem = new User();

        $name = null;
        $surname = null;

            $userInSystem->fill([
                'name' => !empty($user->getNickname())? $user->getNickname():'',
                'surname' => !empty($user->getName())? $user->getName():'',
                'email' => !empty($user->getEmail())? $user->getEmail():'',
                'password' => '',
                'id_in_social' => !empty($user->getId())? $user->getId():'',
                'type_auth' => $socName,
                'email_verified_at' => now(),
                'avatar' => !empty($user->getAvatar())? $user->getAvatar():'',
            ]);

            $userInSystem->save();
        }

        return $userInSystem;
    }
}