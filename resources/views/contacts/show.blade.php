<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{ __('Contact') }} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Type')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->Type->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Status')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->Status->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Email')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->email}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Phone')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->phone}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Subject')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->subject}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Message')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->message}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Active')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      @if($model->active)
                          <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @else
                          <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @endif
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
