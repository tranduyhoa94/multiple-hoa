<?php

use App\Models\UserDash;
use App\Repositories\UserDashRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDashRepositoryTest extends TestCase
{
    use MakeUserDashTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserDashRepository
     */
    protected $userDashRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userDashRepo = App::make(UserDashRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserDash()
    {
        $userDash = $this->fakeUserDashData();
        $createdUserDash = $this->userDashRepo->create($userDash);
        $createdUserDash = $createdUserDash->toArray();
        $this->assertArrayHasKey('id', $createdUserDash);
        $this->assertNotNull($createdUserDash['id'], 'Created UserDash must have id specified');
        $this->assertNotNull(UserDash::find($createdUserDash['id']), 'UserDash with given id must be in DB');
        $this->assertModelData($userDash, $createdUserDash);
    }

    /**
     * @test read
     */
    public function testReadUserDash()
    {
        $userDash = $this->makeUserDash();
        $dbUserDash = $this->userDashRepo->find($userDash->id);
        $dbUserDash = $dbUserDash->toArray();
        $this->assertModelData($userDash->toArray(), $dbUserDash);
    }

    /**
     * @test update
     */
    public function testUpdateUserDash()
    {
        $userDash = $this->makeUserDash();
        $fakeUserDash = $this->fakeUserDashData();
        $updatedUserDash = $this->userDashRepo->update($fakeUserDash, $userDash->id);
        $this->assertModelData($fakeUserDash, $updatedUserDash->toArray());
        $dbUserDash = $this->userDashRepo->find($userDash->id);
        $this->assertModelData($fakeUserDash, $dbUserDash->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserDash()
    {
        $userDash = $this->makeUserDash();
        $resp = $this->userDashRepo->delete($userDash->id);
        $this->assertTrue($resp);
        $this->assertNull(UserDash::find($userDash->id), 'UserDash should not exist in DB');
    }
}
