<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{ __('Account') }} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">
        
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
                      {{__('Username')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->username}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('LoginBy')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->loginBy}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Address')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->address}}
                  </h3>
              </div>
          </div>

          
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Otp code')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->otp_code}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Last login')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->last_login}}
                  </h3>
              </div>
          </div>

          
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Host')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->host}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Attempts')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->attempts}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Login')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->login}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Activated')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->activated}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Blocked')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->blocked}}
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
