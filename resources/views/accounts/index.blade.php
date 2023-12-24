<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Account') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.accounts.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Account')}}
        </x-tomato-admin-button>
        @if(config('tomato-crm.views.accounts.buttons', null))
            @include(config('tomato-crm.views.accounts.buttons'))
        @endif
    </x-slot:buttons>
    <x-slot:icon>
        bx bxs-user
    </x-slot:icon>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-slot:actions>
                    <x-tomato-admin-table-action secondary modal href="{{route('admin.accounts.import')}}" label="{{__('Import Accounts')}}" icon="bx bx-import" />
                </x-slot:actions>
                @if(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getTableCells())
                    @include(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getTableCells())
                @endif
                <x-splade-cell name>
                    <div class="flex justify-start gap-4">
                        <div class="flex flex-col items-center justify-center">
                            @if($item->getMedia('avatar')?->first())
                            <div class="bg-cover bg-center rounded-full w-12 h-12" style="background-image: url('{{$item->getMedia('avatar')?->first()->getUrl()}}')">

                            </div>
                            @else
                                <div class="w-12 h-12 border rounded-full border-gray-200 bg-white">
                                    <div class="flex flex-col items-center justify-center mt-3">
                                        <div>
                                            <i class="bx bxs-user text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <x-splade-link :href="route('admin.accounts.show', $item->id)" class="text-lg font-bold">{{$item->name}}</x-splade-link>
                            <a href="mailto:{{$item->email}}" class="text-sm text-gray-400">{{$item->email}}</a>
                            <a href="tel:{{$item->phone}}" class="text-sm text-gray-400">{{$item->phone}}</a>
                            <div class="my-2 grid grid-cols-4">
                                @if(config('tomato-crm.features.groups'))
                                    @foreach($item->groups as $group)
                                        <x-tomato-admin-row type="badge" href="{{url()->current().'?group_id='.$group->id}}" icon="{{$group->icon}}" color="{{$group->color}}" table value="{{$group->name}}" />
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </x-splade-cell>
                <x-splade-cell is_active>
                    <x-tomato-admin-tooltip :text="$item->last_login ? Carbon\Carbon::parse($item->last_login)->diffForHumans() : __('Not Login')">
                        <x-tomato-admin-row table type="bool" :value="$item->is_active" />
                    </x-tomato-admin-tooltip>
                </x-splade-cell>
                <x-splade-cell actions>
                    <x-tomato-admin-dropdown class="text-primary-500" icon="bx bxs-cog bx-sm" label="{{__('Actions')}}" primary>
                        @if(config('tomato-crm.views.accounts.actions', null))
                            @include(config('tomato-crm.views.accounts.actions'))
                        @endif
                        <x-tomato-admin-dropdown-item
                            success
                            type="link"
                            icon="bx bxs-show"
                            label="{{trans('tomato-admin::global.crud.view')}}"
                            :href="route('admin.accounts.show', $item->id)"
                        />
                        <x-tomato-admin-dropdown-item
                            warning
                            modal
                            type="link"
                            icon="bx bxs-edit"
                            label="{{trans('tomato-admin::global.crud.edit')}}"
                            :href="route('admin.accounts.edit', $item->id)"
                        />
                        <x-tomato-admin-dropdown-item
                            danger
                            type="link"
                            icon="bx bxs-lock-alt"
                            modal
                            label="{{__('Change Password')}}"
                            :href="route('admin.accounts.password', $item->id)"
                        />
                        @if(class_exists(\Bavix\Wallet\Models\Wallet::class))
                            <x-tomato-admin-dropdown-item
                                success
                                type="link"
                                icon="bx bxs-wallet"
                                modal
                                label="{{__('Charge Balance')}}"
                                :href="route('admin.wallets.balance', $item->id)"
                            />
                        @endif
                        @if(config('tomato-crm.features.notifications'))
                            <x-tomato-admin-dropdown-item
                                type="link"
                                icon="bx bxs-bell"
                                modal
                                label="{{__('Send Notification')}}"
                                :href="route('admin.accounts.notifications', $item->id)"
                            />
                        @endif
                        @if(config('tomato-crm.features.locations'))
                            <x-tomato-admin-dropdown-item
                                warning
                                type="link"
                                icon="bx bxs-map"
                                modal
                                label="{{__('Add Address')}}"
                                :href="route('admin.locations.create',['account_id' =>  $item->id])"
                            />
                        @endif
                        <x-tomato-admin-dropdown-item
                            danger
                            method="DELETE"
                            type="link"
                            icon="bx bxs-trash"
                            label="{{trans('tomato-admin::global.crud.delete')}}"
                            :href="route('admin.accounts.destroy', $item->id)"
                            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                        />
                    </x-tomato-admin-dropdown>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
