<?php

use Faker\Factory as Faker;
use App\Models\UserDash;
use App\Repositories\UserDashRepository;

trait MakeUserDashTrait
{
    /**
     * Create fake instance of UserDash and save it in database
     *
     * @param array $userDashFields
     * @return UserDash
     */
    public function makeUserDash($userDashFields = [])
    {
        /** @var UserDashRepository $userDashRepo */
        $userDashRepo = App::make(UserDashRepository::class);
        $theme = $this->fakeUserDashData($userDashFields);
        return $userDashRepo->create($theme);
    }

    /**
     * Get fake instance of UserDash
     *
     * @param array $userDashFields
     * @return UserDash
     */
    public function fakeUserDash($userDashFields = [])
    {
        return new UserDash($this->fakeUserDashData($userDashFields));
    }

    /**
     * Get fake data of UserDash
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserDashData($userDashFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'column_id' => $fake->randomDigitNotNull,
            'sort_no' => $fake->randomDigitNotNull,
            'collapsed' => $fake->randomDigitNotNull,
            'height' => $fake->randomDigitNotNull,
            'email' => $fake->word,
            'widget' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $userDashFields);
    }
}
