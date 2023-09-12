<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Group')}}">
    <x-splade-form
                   action="{{route('admin.groups.store')}}"
                   method="post"
    >
        <div class="grid grid-cols-2 gap-4">
            <x-tomato-translation label="{{__('Name')}}" placeholder="{{__('Name')}}" name="name" />
            <x-tomato-translation label="{{__('Description')}}" placeholder="{{__('Description')}}" name="description" />
        </div>

        <div class="flex justifiy-between gap-4 my-4">
            <div class="w-full">
                <x-splade-input label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
            </div>
            <x-tomato-admin-color label="{{__('Color')}}" placeholder="{{__('Color')}}" name="color" />

        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.groups.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
