<?php

namespace Tests\Feature;

use App\Pbb;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ManagePbbTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_pbb_list_in_pbb_index_page()
    {
        $pbb = factory(Pbb::class)->create();

        $this->loginAsUser();
        $this->visitRoute('pbbs.index');
        $this->see($pbb->kelurahan);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'kelurahan'      => 'Pbb 1 kelurahan',
            'jenis_bangunan'      => 'Rumah Hunian',
            'luas_tanah'      => '1200m^2',
            'luas_bangunan'      => '1200m^2',
            'jumlah_bangunan'      => '2',
            'address'   => 'Pbb 1 address',
            'keterangan'      => 'Banyaknya tunggakan pajak',
            'latitude'  => '-4.0108498551',
            'longitude' => '119.638366699',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_pbb()
    {
        $this->loginAsUser();
        $this->visitRoute('pbbs.index');

        $this->click(__('pbb.create'));
        $this->seeRouteIs('pbbs.create');

        $this->submitForm(__('pbb.create'), $this->getCreateFields());

        $this->seeRouteIs('pbbs.show', Pbb::first());

        $this->seeInDatabase('pbbs', $this->getCreateFields());
    }

    /** @test */
    public function validate_pbb_kelurahan_is_required()
    {
        $this->loginAsUser();

        // kelurahan empty
        $this->post(route('pbbs.store'), $this->getCreateFields(['kelurahan' => '']));
        $this->assertSessionHasErrors('kelurahan');
    }

    /** @test */
    public function validate_pbb_kelurahan_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // kelurahan 70 characters
        $this->post(route('pbbs.store'), $this->getCreateFields([
            'kelurahan' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('kelurahan');
    }

    /** @test */
    public function validate_pbb_address_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // address 256 characters
        $this->post(route('pbbs.store'), $this->getCreateFields([
            'address' => str_repeat('Long pbb address', 16),
        ]));
        $this->assertSessionHasErrors('address');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'kelurahan'      => 'Pbb 1 kelurahan',
            'jenis_bangunan'      => 'Rumah Hunian',
            'luas_tanah'      => '1200m^2',
            'luas_bangunan'      => '1200m^2',
            'jumlah_bangunan'      => '2',
            'address'   => 'Pbb 1 address',
            'keterangan'      => 'Banyaknya tunggakan pajak',
            'latitude'  => '-4.0108498551',
            'longitude' => '119.638366699',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_pbb()
    {
        $this->loginAsUser();
        $pbb = factory(Pbb::class)->create(['kelurahan' => 'Testing 123']);

        $this->visitRoute('pbbs.show', $pbb);
        $this->click('edit-pbb-'.$pbb->id);
        $this->seeRouteIs('pbbs.edit', $pbb);

        $this->submitForm(__('pbb.update'), $this->getEditFields());

        $this->seeRouteIs('pbbs.show', $pbb);

        $this->seeInDatabase('pbbs', $this->getEditFields([
            'id' => $pbb->id,
        ]));
    }

    /** @test */
    public function validate_pbb_kelurahan_update_is_required()
    {
        $this->loginAsUser();
        $pbb = factory(Pbb::class)->create(['kelurahan' => 'Testing 123']);

        // kelurahan empty
        $this->patch(route('pbbs.update', $pbb), $this->getEditFields(['kelurahan' => '']));
        $this->assertSessionHasErrors('kelurahan');
    }

    /** @test */
    public function validate_pbb_kelurahan_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $pbb = factory(Pbb::class)->create(['kelurahan' => 'Testing 123']);

        // kelurahan 70 characters
        $this->patch(route('pbbs.update', $pbb), $this->getEditFields([
            'kelurahan' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('kelurahan');
    }

    /** @test */
    public function validate_pbb_address_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $pbb = factory(Pbb::class)->create(['kelurahan' => 'Testing 123']);

        // address 256 characters
        $this->patch(route('pbbs.update', $pbb), $this->getEditFields([
            'address' => str_repeat('Long pbb address', 16),
        ]));
        $this->assertSessionHasErrors('address');
    }

    /** @test */
    public function user_can_delete_a_pbb()
    {
        $this->loginAsUser();
        $pbb = factory(Pbb::class)->create();
        factory(Pbb::class)->create();

        $this->visitRoute('pbbs.edit', $pbb);
        $this->click('del-pbb-'.$pbb->id);
        $this->seeRouteIs('pbbs.edit', [$pbb, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('pbbs', [
            'id' => $pbb->id,
        ]);
    }
}
