<?php

namespace Tests\Unit\Controllers;

use App\Traits\Controllers\AddEstateCreateCommonFields;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Tests\TestCase;

class EstatePublishDefaultTest extends TestCase
{
    public function test_new_estates_default_to_published(): void
    {
        $fields = $this->additionalFieldsFor(null);

        $this->assertSame('switch', $fields['is_published']['type']);
        $this->assertSame(1, $fields['is_published']['default']);
    }

    public function test_existing_unpublished_estates_do_not_default_to_published(): void
    {
        $fields = $this->additionalFieldsFor((object) [
            'id' => 301,
            'is_published' => null,
            'price_amd' => 0,
            'contract_type_id' => 1,
        ]);

        $this->assertSame(0, $fields['is_published']['default']);
    }

    private function additionalFieldsFor(?object $entry): array
    {
        $fields = [];
        CRUD::shouldReceive('addField')->andReturnUsing(function (array $field) use (&$fields) {
            $fields[$field['name']] = $field;
        });
        CRUD::shouldReceive('getCurrentEntry')->andReturn($entry);

        $controller = new class
        {
            use AddEstateCreateCommonFields {
                addCreateAdditionalFields as public addAdditionalFieldsForTest;
            }

            public $crud;

        };
        $controller->crud = new class ($entry)
        {
            public function __construct(public ?object $entry)
            {
            }

            public function getCurrentEntry(): ?object
            {
                return $this->entry;
            }
        };

        $controller->addAdditionalFieldsForTest();

        return $fields;
    }
}
