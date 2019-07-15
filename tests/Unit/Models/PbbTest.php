<?php

namespace Tests\Unit\Models;

use App\User;
use App\Pbb;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PbbTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_pbb_has_name_link_attribute()
    {
        $pbb = factory(Pbb::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $pbb->name, 'type' => __('pbb.pbb'),
        ]);
        $link = '<a href="'.route('pbbs.show', $pbb).'"';
        $link .= ' title="'.$title.'">';
        $link .= $pbb->name;
        $link .= '</a>';

        $this->assertEquals($link, $pbb->name_link);
    }

    /** @test */
    public function an_pbb_has_belongs_to_creator_relation()
    {
        $pbb = factory(Pbb::class)->make();

        $this->assertInstanceOf(User::class, $pbb->creator);
        $this->assertEquals($pbb->creator_id, $pbb->creator->id);
    }

    /** @test */
    public function an_pbb_has_coordinate_attribute()
    {
        $pbb = factory(Pbb::class)->make(['latitude' => '-4.0108498551', 'longitude' => '119.638366699']);
        $this->assertEquals($pbb->latitude.', '.$pbb->longitude, $pbb->coordinate);

        $pbb = factory(Pbb::class)->make(['latitude' => null, 'longitude' => null]);
        $this->assertNull($pbb->coordinate);

        $pbb = factory(Pbb::class)->make(['latitude' => null, 'longitude' => '114.583333']);
        $this->assertNull($pbb->coordinate);
    }

    /** @test */
    public function an_pbb_has_map_popup_content_attribute()
    {
        $pbb = factory(Pbb::class)->make(['lat' => '-4.0108498551', 'long' => '119.638366699']);

        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('pbb.kelurahan').':</strong><br>'.$pbb->kelurahan.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('pbb.coordinate').':</strong><br>'.$pbb->coordinate.'</div>';

        $this->assertEquals($mapPopupContent, $pbb->map_popup_content);
    }
}
