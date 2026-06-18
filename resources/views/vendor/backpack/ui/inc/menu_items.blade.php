{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

@can('view', \App\Models\Estate::class)
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('estate') . '?apartment=true' }}"><i class="nav-icon la la-home"></i>Անշարժ Գույք</a></li>
@endcan
@can('view', \App\Models\Contact::class)
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('contact') }}"><i class="nav-icon la la-user"></i>Հաճախորդներ</a></li>
@endcan
@can('view', \App\Models\RealtorUser::class)
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('professional') }}"><i class="nav-icon la la-user"></i>Մասնագետներ</a></li>
@endcan
@can('view', \App\Models\Message::class)
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('message') }}"><i class="nav-icon la la-envelope"></i>Նամակներ</a></li>
@endcan
@can('view', \App\Models\CLocationCountry::class)
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-search-location"></i>Տարածաշրջան</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('c-location-country') }}"><i class="nav-icon la la-cog"></i> Երկրներ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('c-location-province') }}"><i class="nav-icon la la-cog"></i> Մարզեր</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('c-location-city') }}"><i class="nav-icon la la-cog"></i> Քաղաքներ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('c-location-street') }}"><i class="nav-icon la la-cog"></i> Փողոցներ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('c-location-community') }}"><i class="nav-icon la la-cog"></i> Համայնքներ</a></li>
    </ul>
</li>
@endcan

@can('view', \App\Models\User::class)
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-user-alt"></i>Օգտատերեր</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-cog"></i> Օգտատերեր</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-cog"></i> Roles</a></li>
    </ul>
</li>
@endcan

@can('view', \Backpack\ActivityLog\Models\ActivityLog::class)
<li class="nav-item mt-3"><a class="nav-link" href="{{ backpack_url('activity-log') }}"><i class="nav-icon la la-cog"></i> Փոփոխություններ</a></li>
@endcan

@can('view', \App\Models\CYear::class)
<li class="nav-item nav-dropdown mt-3">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-cogs"></i>Կարգավորումներ</a>
    <ul class="nav-dropdown-items">
        <x-backpack::menu-item title="Years" icon="las la-cog" :link="backpack_url('c-year')" />
        <x-backpack::menu-item title="Currencies" icon="las la-cog" :link="backpack_url('c-currency')" />
        <x-backpack::menu-item title="Commercial purpose types" icon="las la-cog" :link="backpack_url('c-commercial-purpose-type')" />
        <x-backpack::menu-item title="Land use types" icon="las la-cog" :link="backpack_url('c-land-use-type')" />
        <x-backpack::menu-item title="Registered rights" icon="las la-cog" :link="backpack_url('c-registered-right')" />
        <x-backpack::menu-item title="Communication types" icon="las la-cog" :link="backpack_url('c-communication-type')" />
        <x-backpack::menu-item title="Building types" icon="las la-cog" :link="backpack_url('c-building-type')" />
        <x-backpack::menu-item title="Elevator types" icon="las la-cog" :link="backpack_url('c-elevator-type')" />
        <x-backpack::menu-item title="Entrance door positions" icon="las la-cog" :link="backpack_url('c-entrance-door-position')" />
        <x-backpack::menu-item title="Entrance door types" icon="las la-cog" :link="backpack_url('c-entrance-door-type')" />
        <x-backpack::menu-item title="Entrance types" icon="las la-cog" :link="backpack_url('c-entrance-type')" />
        <x-backpack::menu-item title="Exterior design types" icon="las la-cog" :link="backpack_url('c-exterior-design-type')" />
        <x-backpack::menu-item title="Fence types" icon="las la-cog" :link="backpack_url('c-fence-type')" />
        <x-backpack::menu-item title="Front with streets" icon="las la-cog" :link="backpack_url('c-front-with-street')" />
        <x-backpack::menu-item title="Heating system types" icon="las la-cog" :link="backpack_url('c-heating-system-type')" />
        <x-backpack::menu-item title="House building types" icon="las la-cog" :link="backpack_url('c-house-building-type')" />
        <x-backpack::menu-item title="Land structure types" icon="las la-cog" :link="backpack_url('c-land-structure-type')" />
        <x-backpack::menu-item title="Land types" icon="las la-cog" :link="backpack_url('c-land-type')" />
        <x-backpack::menu-item title="Parking types" icon="las la-cog" :link="backpack_url('c-parking-type')" />
        <x-backpack::menu-item title="Repairing types" icon="las la-cog" :link="backpack_url('c-repairing-type')" />
        <x-backpack::menu-item title="Road way types" icon="las la-cog" :link="backpack_url('c-road-way-type')" />
        <x-backpack::menu-item title="Roof material types" icon="las la-cog" :link="backpack_url('c-roof-material-type')" />
        <x-backpack::menu-item title="Roof types" icon="las la-cog" :link="backpack_url('c-roof-type')" />
        <x-backpack::menu-item title="Service fee types" icon="las la-cog" :link="backpack_url('c-service-fee-type')" />
        <x-backpack::menu-item title="Windows views" icon="las la-cog" :link="backpack_url('c-windows-view')" />
        <x-backpack::menu-item title="House floors types" icon="las la-cog" :link="backpack_url('c-house-floors-type')" />
        <x-backpack::menu-item title="Building project types" icon="las la-cog" :link="backpack_url('c-building-project-type')" />
        <x-backpack::menu-item title="Structure types" icon="las la-cog" :link="backpack_url('c-structure-type')" />
        <x-backpack::menu-item title="Ceiling height types" icon="las la-cog" :link="backpack_url('c-ceiling-height-type')" />
        <x-backpack::menu-item title="Building structure types" icon="las la-cog" :link="backpack_url('c-building-structure-type')" />
        <x-backpack::menu-item title="Building floor types" icon="las la-cog" :link="backpack_url('c-building-floor-type')" />
        <x-backpack::menu-item title="Vitrage types" icon="las la-cog" :link="backpack_url('c-vitrage-type')" />
        <x-backpack::menu-item title="Separate entrance types" icon="las la-cog" :link="backpack_url('c-separate-entrance-type')" />
    </ul>
</li>
@endcan

@can('view', \App\Models\Organization::class)
    <x-backpack::menu-item title="Կազմակերպություններ" icon="las la-building" :link="backpack_url('organization')" />
@endcan
