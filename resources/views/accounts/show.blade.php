<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Account') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text" />
        <x-tomato-admin-row :label="__('Username')" :value="$model->username" type="text" />
        <x-tomato-admin-row :label="__('Login By')" :value="$model->loginBy" type="text" />
        <x-tomato-admin-row :label="__('Address')" :value="$model->address" type="text" />
        <x-tomato-admin-row :label="__('Last login')" :value="$model->last_login?->diffForHumans()" type="text" />
        <x-tomato-admin-row :label="__('Host')" :value="$model->host" type="text" />
        <x-tomato-admin-row :label="__('Login')" :value="$model->is_login" type="bool" />
        <x-tomato-admin-row :label="__('Activated')" :value="$model->is_active" type="bool" />
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning :href="route('admin.accounts.edit', $model->id)">
            {{__('Edit')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button
            danger
            :href="route('admin.accounts.destroy', $model->id)"
            title="{{trans('tomato-admin::global.crud.edit')}}"
            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
            class="px-2 text-red-500"
            method="delete"
        >
            {{__('Delete')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
