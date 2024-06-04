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

    <x-moonshine::layout.side-bar :home_route="route('home')">

        <x-moonshine::layout.menu>
{{--            <x-moonshine::breadcrumbs--}}
{{--                :items="[--}}
{{--             '/' => 'Home',--}}
{{--             '/articles' => 'Articles'--}}
{{--                ]"--}}
{{--            />--}}
            <x-moonshine::layout.profile
                route="/user_info"
                :log-out-route="route('logout')">
            </x-moonshine::layout.profile>
        </x-moonshine::layout.menu>

    </x-moonshine::layout.side-bar>

    <main class="layout-page">
        <x-moonshine::grid>
            <x-moonshine::column>
                <x-moonshine::layout.header
                    :notifications="false"
                    :locales="false"
                />
                <x-moonshine::layout.content/>
            </x-moonshine::column>
        </x-moonshine::grid>
    </main>

</x-moonshine::layout>

</html>
