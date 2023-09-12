<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Account')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.accounts.update', $model->id)}}" method="post" :default="$model">

        <x-splade-select  label="{{__('Account Type')}}" placeholder="{{__('Account Type')}}" name="type_id" choices>
            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </x-splade-select>


        <div class="grid grid-cols-2 gap-4">
            <x-splade-input label="{{__('Name')}}" name="name" type="text"  placeholder="Name" />
            <x-splade-input label="{{__('Email')}}" name="email" type="email"  placeholder="Email" />
            <x-splade-input label="{{__('Phone')}}" name="phone" type="tel"  placeholder="Phone" />
            <x-splade-select choices label="{{__('Login By')}}" name="loginBy" type="text"  placeholder="LoginBy">
                <option value="email">{{__('Email')}}</option>
                <option value="phone">{{__('Phone')}}</option>
            </x-splade-select>
        </div>
        <x-splade-textarea label="{{__('Address')}}" name="address" placeholder="Address" autosize />

        <x-splade-checkbox label="{{  __('Activated') }}" name="is_active" label="Activated" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
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
    </x-splade-form>
</x-tomato-admin-container>
