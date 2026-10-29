<?php

namespace Tests\Unit\Views;

use App\Models\Estate;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class PublicEstateShareLinkTest extends TestCase
{
    public function test_published_estate_shows_its_public_link_and_copy_action(): void
    {
        $estate = new Estate;
        $estate->id = 301;
        $estate->is_published = true;

        $html = view('redg.estate.partials.public_share_link', compact('estate'))->render();
        $url = route('estates.show', ['estate' => 301]);

        $this->assertStringContainsString('Ուղարկել հաճախորդին', $html);
        $this->assertStringContainsString('href="'.$url.'"', $html);
        $this->assertStringContainsString('data-estate-public-url="'.$url.'"', $html);
        $this->assertStringContainsString('Պատճենել հանրային հղումը', $html);
    }

    public function test_unpublished_estate_does_not_offer_an_unavailable_link(): void
    {
        $estate = new Estate;
        $estate->id = 302;
        $estate->is_published = false;

        $html = view('redg.estate.partials.public_share_link', compact('estate'))->render();

        $this->assertStringContainsString('Չհրապարակված', $html);
        $this->assertStringNotContainsString('/estates/302', $html);
        $this->assertStringNotContainsString('data-estate-public-url', $html);
    }

    public function test_published_share_link_registers_the_copy_handler(): void
    {
        $estate = new Estate;
        $estate->id = 301;
        $estate->is_published = true;

        $html = Blade::render(
            "@include('redg.estate.partials.public_share_link') @stack('after_scripts')",
            compact('estate')
        );

        $this->assertStringContainsString('navigator.clipboard.writeText(url)', $html);
    }

    public function test_apartment_admin_view_includes_the_share_action(): void
    {
        $template = file_get_contents(resource_path('views/redg/estate/showTabs.blade.php'));

        $this->assertStringContainsString(
            "@include('redg.estate.partials.public_share_link'",
            $template
        );
    }
}
