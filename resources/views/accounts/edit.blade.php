<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-admin::global.crud.edit')}} {{__('Account')}} #{{$model->id}}
    </x-slot>
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.accounts.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input label="{{__('Name')}}" name="name" type="text"  placeholder="Name" />
        <x-splade-input label="{{__('Username')}}" name="username" type="text"  placeholder="Username" />
        <x-splade-input label="{{__('LoginBy')}}" name="loginBy" type="text"  placeholder="LoginBy" />
        <x-splade-textarea label="{{__('Address')}}" name="address" placeholder="Address" autosize />
        <x-splade-input label="{{__('Password')}}" name="password" type="password"  placeholder="Password" />
        <x-splade-input name="password_confirmation" type="password"  placeholder="Password Confirmation" />
        <x-splade-input label="{{__('Otp code')}}" name="otp_code" type="text"  placeholder="Otp code" />
        <x-splade-input label="{{__('Last login')}}" placeholder="Last login" name="last_login" date time="{ time_24hr: false }" />

        <x-splade-input label="{{__('Host')}}" name="host" type="text"  placeholder="Host" />
        <x-splade-input label="{{__('Attempts')}}" type='number' name="attempts" placeholder="Attempts" />
        <x-splade-checkbox label="{{__('Login)}}" name="login" label="Login" />
        <x-splade-checkbox label="{{__('Activated)}}" name="activated" label="Activated" />
        <x-splade-checkbox label="{{__('Blocked)}}" name="blocked" label="Blocked" />

        <x-splade-submit label="{{trans('tomato-admin::global.crud.update')}} {{__('Account')}}" :spinner="true" />
    </x-splade-form>
</x-tomato-admin-layout>
