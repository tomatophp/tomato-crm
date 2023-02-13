<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.create')}} {{__('Location')}}</h1>

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.locations.store')}}" method="post">
        
          <x-splade-select label="{{__('account')}}" placeholder="Account id" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-`value=`"id" choices/>
          <x-splade-input label="{{__('Street')}}" name="street" type="text"  placeholder="Street" />
          <x-splade-input label="{{__('Area')}}" name="area" type="text"  placeholder="Area" />
          <x-splade-input label="{{__('City')}}" name="city" type="text"  placeholder="City" />
          <x-splade-input label="{{__('Country')}}" name="country" type="text"  placeholder="Country" />
          <x-splade-input label="{{__('Home number')}}" type='number' name="home_number" placeholder="Home number" />
          <x-splade-input label="{{__('Flat number')}}" type='number' name="flat_number" placeholder="Flat number" />
          <x-splade-input label="{{__('Floor number')}}" type='number' name="floor_number" placeholder="Floor number" />
          <x-splade-input label="{{__('Mark')}}" name="mark" type="text"  placeholder="Mark" />
          <x-splade-textarea label="{{__('Map url')}}" name="map_url" placeholder="Map url" autosize />
          <x-splade-input label="{{__('Note')}}" name="note" type="text"  placeholder="Note" />
          <x-splade-input label="{{__('Lat')}}" name="lat" type="text"  placeholder="Lat" />
          <x-splade-input label="{{__('Lng')}}" name="lng" type="text"  placeholder="Lng" />

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{__('Location')}}" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
