@php
    $show = $column['show']($entry);
@endphp

@if($show)
    <span>{{$entry->contact ? $entry->contact->full_contact : '-'}}</span>
@else
    <span>-</span>
@endif
