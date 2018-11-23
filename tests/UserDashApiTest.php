<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDashApiTest extends TestCase
{
    use MakeUserDashTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserDash()
    {
        $userDash = $this->fakeUserDashData();
        $this->json('POST', '/api/v1/userDashes', $userDash);

        $this->assertApiResponse($userDash);
    }

    /**
     * @test
     */
    public function testReadUserDash()
    {
        $userDash = $this->makeUserDash();
        $this->json('GET', '/api/v1/userDashes/'.$userDash->id);

        $this->assertApiResponse($userDash->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserDash()
    {
        $userDash = $this->makeUserDash();
        $editedUserDash = $this->fakeUserDashData();

        $this->json('PUT', '/api/v1/userDashes/'.$userDash->id, $editedUserDash);

        $this->assertApiResponse($editedUserDash);
    }

    /**
     * @test
     */
    public function testDeleteUserDash()
    {
        $userDash = $this->makeUserDash();
        $this->json('DELETE', '/api/v1/userDashes/'.$userDash->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userDashes/'.$userDash->id);

        $this->assertResponseStatus(404);
    }
}
