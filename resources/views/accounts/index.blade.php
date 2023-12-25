<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Account') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.accounts.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Account')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button warning :modal="true" :href="route('admin.accounts.import')" type="link">
            <x-tomato-admin-tooltip :text="__('Import Accounts')">
                <i class="bx bx-import"></i>
            </x-tomato-admin-tooltip>
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
                <x-slot:header>
                    @if(config('tomato-crm.features.groups'))
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-3">
                            @foreach($groups as $group)
                                <div class="relative border border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-4 rounded-lg bg-white @if(isset(request()->get('filter')['group_id']) && request()->get('filter')['group_id'] == $group->id) ring-2 ring-primary-500 @endif">
                                    <x-splade-link :href="route('admin.groups.edit', $group->id)" modal class="absolute top-3 rtl:right-3 ltr:left-3 text-warning-500">
                                        <i class="bx bx-edit"></i>
                                    </x-splade-link>

                                    <div @click.prevent="table.updateQuery('filter[group_id]', @js($group->id))" class="flex flex-col items-center justify-center cursor-pointer">
                                        <i class="{{$group->icon}} bx-lg" style="color: {{$group->color}}"></i>
                                        <h1 class="font-bold text-2xl">{{$group->name}}</h1>
                                        <h1 class="text-gray-400 text-sm">{{$group->accounts()->count()}} {{__('Customer')}}</h1>
                                    </div>
                                </div>
                            @endforeach
                            <x-splade-link modal :href="route('admin.groups.create')" class="border border-gray-200 dark:border-gray-700 px-4 py-8 rounded-lg bg-primary-500 text-white flex flex-col items-center justify-center">
                                <i class="bx bx-plus-circle bx-lg"></i>
                                <h1 class="font-bold text-xl">{{__('Create New Group')}}</h1>
                            </x-splade-link>
                        </div>
                    @endif
                </x-slot:header>
                <x-slot:actions>
                    <x-tomato-admin-table-action secondary href="{{route('admin.types.accounts.type.index')}}" label="{{__('Accounts Types')}}" icon="bx bx-category" />
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
                                <div class="w-12 h-12 border rounded-full border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                                    <div class="flex flex-col items-center justify-center mt-3">
                                        <div>
                                            @if($item->type === 'customer')
                                                <i class="bx bxs-group text-xl"></i>
                                            @elseif($item->type === 'supplier')
                                                <i class="bx bxs-briefcase text-xl"></i>
                                            @elseif($item->type === 'lead')
                                                <i class="bx bxs-traffic text-xl"></i>
                                            @else
                                                <i class="bx bxs-user text-xl"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <x-splade-link :href="route('admin.accounts.show', $item->id)" class="text-lg font-bold">{{$item->name}}</x-splade-link>
                            <a href="mailto:{{$item->email}}" class="text-sm text-gray-400">{{$item->email}}</a>
                            <a href="tel:{{$item->phone}}" class="text-sm text-gray-400">{{$item->phone}}</a>
                            @if(config('tomato-crm.features.groups'))
                            <div class="my-2 grid grid-cols-4 gap-2">
                                @foreach($item->groups as $group)
                                    <x-tomato-admin-row type="badge" href="#" icon="{{$group->icon}}" color="{{$group->color}}" table value="{{$group->name}}" />
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </x-splade-cell>
                <x-splade-cell is_active>
                    <x-tomato-admin-tooltip :text="$item->last_login ? Carbon\Carbon::parse($item->last_login)->diffForHumans() : __('Not Login')">
                        <x-tomato-admin-row table type="bool" :value="$item->is_active" />
                    </x-tomato-admin-tooltip>
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-center">
                        <x-tomato-admin-dropdown class="text-primary-500" icon="bx bx-dots-vertical-rounded bx-sm" label="{{__('Actions')}}" primary>
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
                            @if(config('tomato-crm.views.accounts.actions', null))
                                @include(config('tomato-crm.views.accounts.actions'))
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
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
