<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Group')}}">
    <x-splade-form
        class="flex flex-col gap-4"
        action="{{route('admin.groups.store')}}"
        method="post"
    >
        <x-splade-input  label="{{__('Name [AR]')}}" placeholder="{{__('Name [AR]')}}" name="name.ar" />
        <x-splade-input  label="{{__('Name [EN]')}}" placeholder="{{__('Name [EN]')}}" name="name.en" />
        <x-splade-textarea label="{{__('Description [AR]')}}" placeholder="{{__('Description [AR]')}}" name="description.ar" />
        <x-splade-textarea label="{{__('Description [EN]')}}" placeholder="{{__('Description [EN]')}}" name="description.en" />

        <div class="flex justifiy-between gap-4 my-4">
            <div class="w-full">
                <x-tomato-admin-icon label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
            </div>
            <x-tomato-admin-color label="{{__('Color')}}" placeholder="{{__('Color')}}" name="color" />

        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" type="button" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
