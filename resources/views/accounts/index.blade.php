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


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                @if(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getTableCells())
                    @include(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getTableCells())
                @endif
                <x-splade-cell groups>
                    @if(config('tomato-crm.features.groups'))
                        @foreach($item->groups as $group)
                            <x-tomato-admin-row type="badge" href="{{url()->current().'?group_id='.$group->id}}" icon="{{$group->icon}}" color="{{$group->color}}" table value="{{$group->name}}" />
                        @endforeach
                    @endif
                </x-splade-cell>
                <x-splade-cell username>
                    @if($item->loginBy === 'email')
                        <x-tomato-admin-row table type="email" :value="$item->username" />
                    @else
                        <x-tomato-admin-row table type="tel" :value="$item->username" />
                    @endif
                </x-splade-cell>
                <x-splade-cell last_login>
                    @if($item->last_login)
                        {{  Carbon\Carbon::parse($item->last_login)->diffForHumans() }}
                    @else
                        -
                    @endif
                </x-splade-cell>
                <x-splade-cell is_active>
                    @if($item->is_active)
                        <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                    @else
                        <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                    @endif
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        @if(config('tomato-crm.views.accounts.actions', null))
                            @include(config('tomato-crm.views.accounts.actions'))
                        @endif
                        @if(class_exists(\Bavix\Wallet\Models\Wallet::class))
                            <x-tomato-admin-button modal type="icon" :href="route('admin.wallets.balance', $item->id)" title="{{__('Charge Balance')}}">
                                <x-heroicon-s-currency-dollar class="h-6 w-6"/>
                            </x-tomato-admin-button>
                        @endif
                        <x-tomato-admin-button danger modal type="icon" :href="route('admin.accounts.password', $item->id)" title="{{__('Change Password')}}">
                            <x-heroicon-s-lock-closed class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        @if(config('tomato-crm.features.notifications'))
                        <x-tomato-admin-button  modal type="icon" :href="route('admin.accounts.notifications', $item->id)" title="{{__('Send Notification')}}">
                            <x-heroicon-s-bell class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        @endif
                        @if(config('tomato-crm.features.locations'))
                        <x-tomato-admin-button warning  modal type="icon" :href="route('admin.locations.create',['account_id' =>  $item->id])" title="{{__('Add Address')}}">
                            <x-heroicon-s-map-pin class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        @endif
                        <x-tomato-admin-button success type="icon" :href="route('admin.accounts.show', $item->id)" title="{{trans('tomato-admin::global.crud.view')}}">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning modal type="icon" :href="route('admin.accounts.edit', $item->id)" title="{{trans('tomato-admin::global.crud.edit')}}">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon"
                                               :href="route('admin.accounts.destroy', $item->id)"
                                               title="{{trans('tomato-admin::global.crud.edit')}}"
                                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                               class="px-2 text-red-500"
                                               method="delete"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
