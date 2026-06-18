<?php

namespace App\Providers;

use App\Models\CBuildingFloorType;
use App\Models\CBuildingProjectType;
use App\Models\CBuildingStructureType;
use App\Models\CBuildingType;
use App\Models\CCeilingHeightType;
use App\Models\CCommercialPurposeType;
use App\Models\CCommunicationType;
use App\Models\CCurrency;
use App\Models\CElevatorType;
use App\Models\CEntranceDoorPosition;
use App\Models\CEntranceDoorType;
use App\Models\CEntranceType;
use App\Models\CExteriorDesignType;
use App\Models\CFenceType;
use App\Models\CFrontWithStreet;
use App\Models\CHeatingSystemType;
use App\Models\CHouseFloorsType;
use App\Models\CLandStructureType;
use App\Models\CLandType;
use App\Models\CLandUseType;
use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationCountry;
use App\Models\CLocationProvince;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Models\CParkingType;
use App\Models\CRegisteredRight;
use App\Models\CRepairingType;
use App\Models\CRoadWayType;
use App\Models\CRoofMaterialType;
use App\Models\CRoofType;
use App\Models\CSeparateEntranceType;
use App\Models\CServiceFeeType;
use App\Models\CStructureType;
use App\Models\CVitrageType;
use App\Models\CWindowsView;
use App\Models\CYear;
use App\Models\Estate;
use App\Models\Message;
use App\Models\Organization;
use App\Models\RealtorUser;
use App\Models\User;
use App\Policies\OrganizationPolicy;
use App\Policies\UserPolicy;
use Backpack\PermissionManager\app\Models\Role;
use App\Policies\ActivityLogPolicy;
use App\Policies\CLocationCityPolicy;
use App\Policies\CLocationCommunityPolicy;
use App\Policies\CLocationCountryPolicy;
use App\Policies\CLocationProvincePolicy;
use App\Policies\CLocationStreetPolicy;
use App\Policies\ContactPolicy;
use App\Policies\CYearPolicy;
use App\Policies\EstatePolicy;
use App\Policies\MessagePolicy;
use App\Policies\RealtorUserPolicy;
use App\Policies\RolePolicy;
use Backpack\ActivityLog\Models\ActivityLog;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Estate::class => EstatePolicy::class,
        Contact::class => ContactPolicy::class,
        RealtorUser::class => RealtorUserPolicy::class,
        Message::class => MessagePolicy::class,
        CLocationCity::class => CLocationCityPolicy::class,
        CLocationCountry::class => CLocationCountryPolicy::class,
        CLocationProvince::class => CLocationProvincePolicy::class,
        CLocationStreet::class => CLocationStreetPolicy::class,
        CLocationCommunity::class => CLocationCommunityPolicy::class,
        ActivityLog::class => ActivityLogPolicy::class,
        CYear::class => CYearPolicy::class,
        CCurrency::class => CYearPolicy::class,
        CCommercialPurposeType::class => CYearPolicy::class,
        CLandUseType::class => CYearPolicy::class,
        CRegisteredRight::class => CYearPolicy::class,
        CCommunicationType::class => CYearPolicy::class,
        CBuildingType::class => CYearPolicy::class,
        CElevatorType::class => CYearPolicy::class,
        CEntranceDoorPosition::class => CYearPolicy::class,
        CEntranceDoorType::class => CYearPolicy::class,
        CEntranceType::class => CYearPolicy::class,
        CExteriorDesignType::class => CYearPolicy::class,
        CFenceType::class => CYearPolicy::class,
        CFrontWithStreet::class => CYearPolicy::class,
        CHeatingSystemType::class => CYearPolicy::class,
        CLandStructureType::class => CYearPolicy::class,
        CLandType::class => CYearPolicy::class,
        CParkingType::class => CYearPolicy::class,
        CRepairingType::class => CYearPolicy::class,
        CRoadWayType::class => CYearPolicy::class,
        CRoofMaterialType::class => CYearPolicy::class,
        CRoofType::class => CYearPolicy::class,
        CServiceFeeType::class => CYearPolicy::class,
        CWindowsView::class => CYearPolicy::class,
        CHouseFloorsType::class => CYearPolicy::class,
        CBuildingProjectType::class => CYearPolicy::class,
        CStructureType::class => CYearPolicy::class,
        CCeilingHeightType::class => CYearPolicy::class,
        CBuildingStructureType::class => CYearPolicy::class,
        CBuildingFloorType::class => CYearPolicy::class,
        CVitrageType::class => CYearPolicy::class,
        CSeparateEntranceType::class => CYearPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Organization::class => OrganizationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //
    }
}
