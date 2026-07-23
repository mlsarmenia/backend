<?php

namespace Tests\Unit\Admin;

use App\Http\Controllers\Admin\AgentCrudController;
use App\Http\Controllers\Admin\BuyerCrudController;
use App\Http\Controllers\Admin\OwnerCrudController;
use App\Http\Controllers\Admin\RenterCrudController;
use App\Http\Controllers\Admin\SellerCrudController;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionMethod;
use Tests\TestCase;

class ContactSubtypeCrudPermissionsTest extends TestCase
{
    #[DataProvider('contactCrudControllers')]
    public function test_view_permission_grants_list_and_show_access(string $controllerClass): void
    {
        Gate::shouldReceive('allows')
            ->once()
            ->with('view', Contact::class)
            ->andReturnTrue();
        Gate::shouldReceive('allows')
            ->once()
            ->with('create', Contact::class)
            ->andReturnFalse();

        $crud = Mockery::mock();
        $crud->shouldReceive('denyAccess')
            ->once()
            ->with(['list', 'show', 'create', 'update']);
        $crud->shouldReceive('allowAccess')
            ->once()
            ->with(['list', 'show']);

        $this->invokeSetPermissions($controllerClass, $crud);
    }

    #[DataProvider('contactCrudControllers')]
    public function test_missing_view_permission_keeps_list_and_show_denied(string $controllerClass): void
    {
        Gate::shouldReceive('allows')
            ->once()
            ->with('view', Contact::class)
            ->andReturnFalse();
        Gate::shouldReceive('allows')
            ->once()
            ->with('create', Contact::class)
            ->andReturnFalse();

        $crud = Mockery::mock();
        $crud->shouldReceive('denyAccess')
            ->once()
            ->with(['list', 'show', 'create', 'update']);
        $crud->shouldNotReceive('allowAccess');

        $this->invokeSetPermissions($controllerClass, $crud);
    }

    #[DataProvider('contactCrudControllers')]
    public function test_create_permission_still_grants_only_create_access(string $controllerClass): void
    {
        Gate::shouldReceive('allows')
            ->once()
            ->with('view', Contact::class)
            ->andReturnFalse();
        Gate::shouldReceive('allows')
            ->once()
            ->with('create', Contact::class)
            ->andReturnTrue();

        $crud = Mockery::mock();
        $crud->shouldReceive('denyAccess')
            ->once()
            ->with(['list', 'show', 'create', 'update']);
        $crud->shouldReceive('allowAccess')
            ->once()
            ->with('create');

        $this->invokeSetPermissions($controllerClass, $crud);
    }

    public static function contactCrudControllers(): array
    {
        return [
            'seller' => [SellerCrudController::class],
            'owner' => [OwnerCrudController::class],
            'buyer' => [BuyerCrudController::class],
            'agent' => [AgentCrudController::class],
            'renter' => [RenterCrudController::class],
        ];
    }

    private function invokeSetPermissions(string $controllerClass, object $crud): void
    {
        $controller = new $controllerClass;
        $controller->crud = $crud;

        $method = new ReflectionMethod($controllerClass, 'setPermissions');
        $method->invoke($controller);
    }
}
