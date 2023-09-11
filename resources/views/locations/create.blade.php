<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Location')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.locations.store')}}" method="post" :default="[
        'account_id' => $account_id,
    ]">
        <div class="grid grid-cols-3 gap-4">
            <x-splade-input label="{{__('Home number')}}" type='number' name="home_number" placeholder="Home number" />
            <x-splade-input label="{{__('Flat number')}}" type='number' name="flat_number" placeholder="Flat number" />
            <x-splade-input label="{{__('Floor number')}}" type='number' name="floor_number" placeholder="Floor number" />
        </div>
        <x-splade-input label="{{__('Street')}}" name="street" type="text"  placeholder="Street" />
        <x-tomato-location />
        <x-splade-input label="{{__('Mark')}}" name="mark" type="text"  placeholder="Mark" />
        <x-splade-textarea label="{{__('Map url')}}" name="map_url" placeholder="Map url" autosize />
        <x-splade-input label="{{__('Note')}}" name="note" type="text"  placeholder="Note" />

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{__('Location')}}" :spinner="true" />
    </x-splade-form>

</x-tomato-admin-container>
