<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.create')}} {{__('AccountsMeta')}}</h1>

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.accounts-metas.store')}}" method="post">
        
          <x-splade-select label="{{__('account')}}" placeholder="Account id" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-`value=`"id" choices/>
          
          <x-splade-input label="{{__('Model type')}}" name="model_type" type="text"  placeholder="Model type" />
          <x-splade-input label="{{__('Key')}}" name="key" type="text"  placeholder="Key" />
          

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{__('AccountsMeta')}}" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
