<div class="flex justify-center">
    <x-tomato-admin-button
        success
        type="icon"
        title="{{trans('tomato-admin::global.crud.view')}}"
        :href="route('admin.accounts.show', $item->id)"
    >
        <i class="bx bxs-show text-2xl"></i>
    </x-tomato-admin-button>
    <x-tomato-admin-button
        warning
        modal
        type="icon"
        title="{{trans('tomato-admin::global.crud.edit')}}"
        :href="route('admin.accounts.edit', $item->id)"
    >
        <i class="bx bxs-edit text-2xl"></i>
    </x-tomato-admin-button>
    <x-tomato-admin-button
        danger
        type="icon"
        icon="bx bxs-lock-alt"
        modal
        title="{{__('Change Password')}}"
        :href="route('admin.accounts.password', $item->id)"
    >
        <i class="bx bxs-edit text-2xl"></i>
    </x-tomato-admin-button>
    @if(class_exists(\Bavix\Wallet\Models\Wallet::class))
        <x-tomato-admin-button
            success
            type="icon"
            icon="bx bxs-wallet"
            modal
            title="{{__('Charge Balance')}}"
            :href="route('admin.wallets.balance', $item->id)"
        >
            <i class="bx bxs-wallet text-2xl"></i>
        </x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.features.notifications'))
        <x-tomato-admin-button
            type="icon"
            icon="bx bxs-bell"
            modal
            title="{{__('Send Notification')}}"
            :href="route('admin.accounts.notifications', $item->id)"
        >
            <i class="bx bxs-bell text-2xl"></i>
        </x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.features.locations'))
        <x-tomato-admin-button
            warning
            type="icon"
            icon="bx bxs-map"
            modal
            title="{{__('Add Address')}}"
            :href="route('admin.locations.create',['account_id' =>  $item->id])"
        >
            <i class="bx bxs-map text-2xl"></i>
        </x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.views.accounts.actions', null))
        @include(config('tomato-crm.views.accounts.actions'))
    @endif
    <x-tomato-admin-button
        danger
        method="DELETE"
        type="icon"
        confirm-danger
        title="{{trans('tomato-admin::global.crud.delete')}}"
        :href="route('admin.accounts.destroy', $item->id)"
        confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
        confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
        confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
        cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
    >
        <i class="bx bxs-trash text-2xl"></i>
    </x-tomato-admin-button>
</div>
