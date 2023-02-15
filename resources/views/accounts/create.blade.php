<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-admin::global.crud.create')}} {{__('Account')}}
    </x-slot>

    <x-splade-form :default="['loginBy' => 'email']" class="flex flex-col space-y-4" action="{{route('admin.accounts.store')}}" method="post">

        <x-splade-select label="{{__('Content Type')}}" placeholder="Post, Page, Ads" name="type_id" choices>
            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </x-splade-select>

        <x-splade-input label="{{__('Name')}}" name="name" type="text"  placeholder="Name" />
        <x-splade-input label="{{__('Email')}}" name="email" type="email"  placeholder="Email" />
        <x-tomato-tel label="{{__('Phone')}}" name="phone" type="tel"  placeholder="Phone" />
        <x-splade-select label="{{__('Login By')}}" name="loginBy" type="text"  placeholder="LoginBy">
            <option value="email">Email</option>
            <option value="phone">Phone</option>
        </x-splade-select>
        <x-splade-textarea label="{{__('Address')}}" name="address" placeholder="Address" autosize />

        <x-splade-checkbox label="{{  __('Login') }}" name="login" label="Login" />

        <div v-if="form.login">
            <div class="flex flex-col space-y-4">
                <x-splade-input label="{{__('Password')}}" name="password" type="password"  placeholder="Password" />
                <x-splade-input name="password_confirmation" type="password"  placeholder="Password Confirmation" />
            </div>
        </div>



        <x-splade-checkbox label="{{  __('Activated') }}" name="activated" label="Activated" />
        <x-splade-checkbox label="{{  __('Blocked') }}" name="blocked" label="Blocked" />

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{__('Account')}}" :spinner="true" />
    </x-splade-form>
</x-tomato-admin-layout>
