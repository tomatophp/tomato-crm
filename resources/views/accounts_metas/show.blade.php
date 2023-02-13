<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{ __('AccountsMeta') }} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">
        
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Account')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->Account->name}}
                  </h3>
              </div>
          </div>

          
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Model type')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->model_type}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Key')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->key}}
                  </h3>
              </div>
          </div>

          
    </div>
</x-splade-modal>
