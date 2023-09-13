<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Account')}}">
    <x-splade-form :default="['loginBy' => 'email']" class="flex flex-col space-y-4" action="{{route('admin.accounts.store')}}" method="post">

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

        <x-splade-checkbox label="{{  __('Login') }}" name="is_login" label="Login" />

        <div v-if="form.is_login">
            <div class="flex flex-col space-y-4">
                <x-splade-input label="{{__('Password')}}" name="password" type="password"  placeholder="Password" />
                <x-splade-input name="password_confirmation" type="password"  placeholder="Password Confirmation" />
            </div>
        </div>

        @if(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getCreateForm())
            @include(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getCreateForm())
        @endif

        @foreach(\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getCreateInputs() as $key=>$item)
            @if($item['type'] === 'date')
                <x-splade-input date label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'datetime')
                <x-splade-input date time label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'time')
                <x-splade-input time label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'textarea')
                <x-splade-textarea label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'checkbox')
                <x-splade-checkbox label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @else
                <x-splade-input :type="$item['type']" label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
             @endif
        @endforeach

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
