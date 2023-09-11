<x-splade-modal>
    <h1 class="text-2xl font-bold mb-4"> {{__('Add Balance')}} # {{$model->name}} [<span class="text-green-400">{{$model->wallets()->orderBy('id', 'desc')->first()?->balance_after ?? 0}}<small>{{setting('site_currency')}}</small></span>]  </h1>

   <x-splade-data :default="['balance' => $model->Balance]">
       <x-splade-form confirm class="grid grid-cols-2 gap-4" action="{{route('admin.accounts.update', $model->id)}}" method="post" :default="$model">
           <x-splade-input label="{{__('Total Amount')}}" name="new_balance" type="number"
                           placeholder="{{__('Total Amount')}}" @keypress="$helpers.onlyNumber" />
           <x-splade-select :options="[
                   'refund' => __('Refund'),
                   'charge' => __('Charge')
            ]" choices label="{{__('Select Type')}}" name="type"  placeholder="{{__('Type')}}"/>
           <x-splade-select class="col-span-2" remote-url="/admin/state-types/api" remote-root="model.data" option-label="name.en" option-value="id" choices label="{{__('Select Reason')}}" name="reason_state_id"  placeholder="{{__('Select Reason')}}"/>
           <x-splade-textarea class="col-span-2" label="{{__('Reason')}}" name="reason"  placeholder="{{__('Reason')}}"/>

           <x-splade-submit class="col-span-2" label="{{__('Add New Balance')}}" :spinner="true" />
       </x-splade-form>
   </x-splade-data>
</x-splade-modal>
