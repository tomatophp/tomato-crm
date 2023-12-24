<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Location') }}
    </x-slot:header>
    <x-slot:icon>
        bx bxs-map
    </x-slot:icon>

    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success modal type="icon" :href="route('admin.locations.show', $item->id)" title="{{trans('tomato-admin::global.crud.view')}}">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning modal type="icon" :href="route('admin.locations.edit', $item->id)" title="{{trans('tomato-admin::global.crud.edit')}}">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon"
                                               :href="route('admin.locations.destroy', $item->id)"
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
