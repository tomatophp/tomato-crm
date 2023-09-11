<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Contact') }}
    </x-slot:header>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell active>
                    @if($item->active)
                        <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                    @else
                        <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                    @endif
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <Link href="/admin/contacts/{{ $item->id }}" class="px-2 text-blue-500" modal>
                        <div class="flex justify-start space-x-2">
                            <x-heroicon-s-eye class="h-4 w-4 ltr:mr-2 rtl:ml-2"/>
                            <span>{{trans('tomato-admin::global.crud.view')}}</span>
                        </div>
                        </Link>
                        <Link href="/admin/contacts/{{ $item->id }}"
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
