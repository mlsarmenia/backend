<?php

namespace Tests\Unit\Traits;

use App\Traits\Controllers\AddContactShowColumns;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use ReflectionMethod;
use Tests\TestCase;

class AddContactShowColumnsTest extends TestCase
{
    public function test_info_source_uses_its_direct_relationship_and_name_attribute(): void
    {
        $columns = [];

        CRUD::shouldReceive('addColumn')
            ->andReturnUsing(function (array $column) use (&$columns): void {
                $columns[] = $column;
            });
        CRUD::shouldReceive('getCurrentEntry')
            ->once()
            ->andReturn((object) ['client' => null]);

        $subject = new class
        {
            use AddContactShowColumns;
        };

        $method = new ReflectionMethod($subject, 'addClientShowColumns');
        $method->invoke($subject);

        $infoSourceColumn = collect($columns)->firstWhere('name', 'client.infoSource');

        $this->assertNotNull($infoSourceColumn);
        $this->assertSame('name', $infoSourceColumn['attribute']);
        $this->assertSame('relationship', $infoSourceColumn['type']);
        $this->assertNull(
            collect($columns)->firstWhere('name', 'client.infoSource.contact.fullName')
        );

        $brokerColumn = collect($columns)->firstWhere('name', 'client.broker.contact.fullName');

        $this->assertNotNull($brokerColumn);
        $this->assertSame('name_arm', $brokerColumn['attribute']);
    }
}
