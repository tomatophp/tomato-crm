<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Activity') }}
    </x-slot:header>

    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <Link href="/admin/activities/{{ $item->id }}" class="px-2 text-blue-500" slideover>
                        <div class="flex justify-start space-x-2">
                            <x-heroicon-s-eye class="h-4 w-4 ltr:mr-2 rtl:ml-2"/>
                            <span>{{trans('tomato-admin::global.crud.view')}}</span>
                        </div>
                        </Link>
                        <Link href="/admin/activities/{{ $item->id }}/edit" class="px-2 text-yellow-400" slideover>
                        <div class="flex justify-start space-x-2">
                            <x-heroicon-s-pencil class="h-4 w-4 ltr:mr-2 rtl:ml-2"/>
                            <span>{{trans('tomato-admin::global.crud.edit')}}</span>
                        </div>
                        </Link>
                        <Link href="/admin/activities/{{ $item->id }}"
                              confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                              confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                              confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                              cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                              class="px-2 text-red-500"
                              method="delete"

                        >
                        <div class="flex justify-start space-x-2">
                            <x-heroicon-s-trash class="h-4 w-4 ltr:mr-2 rtl:ml-2"/>
                            <span>{{trans('tomato-admin::global.crud.delete')}}</span>
                        </div>
                        </Link>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
