<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.edit')}} {{__('Activity')}} #{{$model->id}}</h1>

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.activities.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-select label="{{__('account')}}" placeholder="Account id" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-`value=`"id" choices/>
          <x-splade-input label="{{__('Type')}}" name="type" type="text"  placeholder="Type" />
          

        <x-splade-submit label="{{trans('tomato-admin::global.crud.update')}} {{__('Activity')}}" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
