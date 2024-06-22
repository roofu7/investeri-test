<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data :class="$store.darkMode.on && 'dark'">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @moonShineAssets
</head>
<x-moonshine::layout>
    <x-moonshine::layout.flash/>

    <x-moonshine::layout.top-bar :home_route="route('home')">

        <x-slot:profile>
            @auth()
                <x-moonshine::layout.profile
{{--                    action="{{ route('userinfo', parameters: ) }}"--}}
                    route="/user"
                    :log-out-route="route('logout')"
                />
            @elseguest()
                <a href="{{ route('login') }}"><p>вход</p></a>
                <a href="{{ route('register') }}"><p>регистрация</p></a>
            @endauth()
        </x-slot:profile>
        @foreach ( $page as $pages )
            <a href="{{ $pages->slug }}"><p>{{ $pages->title }}</p></a>
        @endforeach
    </x-moonshine::layout.top-bar>
    <main class="layout-page">
        <x-moonshine::grid>
            <x-moonshine::column>

            </x-moonshine::column>
        </x-moonshine::grid>
    </main>
</x-moonshine::layout>
</html>
