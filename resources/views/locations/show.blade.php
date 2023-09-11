<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{ __('Location') }} #{{$model->id}}</h1>

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
                      {{__('Street')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->street}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Area')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->area?->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('City')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->city?->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Country')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->country?->name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Home number')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->home_number}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Flat number')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->flat_number}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Floor number')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->floor_number}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Mark')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->mark}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Map url')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->map_url}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Note')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->note}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Lat')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->lat}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Lng')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->lng}}
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
