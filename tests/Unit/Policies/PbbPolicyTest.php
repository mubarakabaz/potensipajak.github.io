<?php

namespace Tests\Unit\Policies;

use App\Pbb;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\BrowserKitTest as TestCase;

class PbbPolicyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_create_pbb()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Pbb));
    }

    /** @test */
    public function user_can_view_pbb()
    {
        $user = $this->createUser();
        $pbb = factory(Pbb::class)->create();
        $this->assertTrue($user->can('view', $pbb));
    }

    /** @test */
    public function user_can_update_pbbt()
    {
        $user = $this->createUser();
        $pbb = factory(Pbb::class)->create();
        $this->assertTrue($user->can('update', $pbb));
    }

    /** @test */
    public function user_can_delete_pbb()
    {
        $user = $this->createUser();
        $pbb = factory(Pbb::class)->create();
        $this->assertTrue($user->can('delete', $pbb));
    }
}
