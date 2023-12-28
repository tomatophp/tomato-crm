<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('AccountRequest')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.account-requests.store')}}" method="post">
        
          <x-splade-select :label="__('Account id')" :placeholder="__('Account id')" name="account_id" remote-url="/admin/accounts/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-input :label="__('Type')" name="type" type="text"  :placeholder="__('Type')" />
          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />
          <x-splade-checkbox :label="__('Is approved')" name="is_approved" label="Is approved" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.account-requests.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
