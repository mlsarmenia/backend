<?php

namespace Tests\Unit\Services;

use App\Models\Estate;
use App\Services\EstateMainImageService;
use PHPUnit\Framework\TestCase;

class EstateMainImageServiceTest extends TestCase
{
    public function test_deferred_photo_becomes_the_estate_main_image(): void
    {
        $estate = new Estate;
        $estate->id = 42;

        $applied = (new EstateMainImageService)->applyDeferredSelection(
            $estate,
            ['uploads/tmp/front.jpg', 'uploads/tmp/kitchen.jpg'],
            'uploads/tmp/kitchen.jpg'
        );

        $this->assertTrue($applied);
        $this->assertSame('kitchen.jpg', $estate->main_image_file_name);
        $this->assertSame('42/kitchen.jpg', $estate->main_image_file_path);
        $this->assertSame('42/kitchen.jpg', $estate->main_image_file_path_thumb);
    }

    public function test_selection_must_be_part_of_the_submitted_photo_list(): void
    {
        $estate = new Estate;
        $estate->id = 42;
        $estate->main_image_file_name = 'existing.jpg';
        $estate->main_image_file_path = '42/existing.jpg';
        $estate->main_image_file_path_thumb = '42/existing.jpg';

        $applied = (new EstateMainImageService)->applyDeferredSelection(
            $estate,
            ['uploads/tmp/front.jpg'],
            'uploads/tmp/not-submitted.jpg'
        );

        $this->assertFalse($applied);
        $this->assertSame('existing.jpg', $estate->main_image_file_name);
        $this->assertSame('42/existing.jpg', $estate->main_image_file_path);
        $this->assertSame('42/existing.jpg', $estate->main_image_file_path_thumb);
    }

    public function test_malformed_selection_is_ignored(): void
    {
        $estate = new Estate;
        $estate->id = 42;

        $applied = (new EstateMainImageService)->applyDeferredSelection(
            $estate,
            ['uploads/tmp/front.jpg'],
            ['uploads/tmp/front.jpg']
        );

        $this->assertFalse($applied);
        $this->assertNull($estate->main_image_file_path);
    }
}
