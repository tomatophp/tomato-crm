<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Group')}} #{{$model->id}}">
    <x-splade-form class="grid grid-cols-2 gap-4" action="{{route('admin.groups.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input label="{{__('Name-en')}}" placeholder="{{__('Name-en')}}" name="name.en" type='text' />
        <x-splade-input label="{{__('Name-ar')}}" placeholder="{{__('Name-ar')}}" name="name.ar" type='text' />

        @if (auth()->user()->user_type === 'admin')
            <x-splade-select class="col-span-2" name="vendor_id" :options="$vendors" option-value="id"
                             option-label="name" label="{{ __('Site Vendor') }}" placeholder="{{ __('Select Vendor')
                             }}"></x-splade-select>
        @endif

        <x-splade-select class="col-span-2" name="accounts[]"
                         label="{{ __('Select Accounts') }}"
                         :options="$accounts"
                         option-label="name"
                         option-value="id"
                         multiple
                         choices
                         relation
        />

        <x-splade-submit class="col-span-2" label="{{trans('tomato-admin::global.crud.update')}} {{__('Customer Group')}}" :spinner="true" />
    </x-splade-form>
</x-tomato-admin-container>
