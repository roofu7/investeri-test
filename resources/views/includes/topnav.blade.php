<div class="logo"></div>
<nav>
    @auth()
        <x-moonshine::layout.profile
            route="/user_info"
            :log-out-route="route('logout')"
        />
    @elseguest()
        <a href=""><p>вход</p></a>
        <a href="{{ route('register') }}"><p>регистрация</p></a>
    @endauth()
    @foreach ( $page as $pages )
        <a href="{{ $pages->slug }}"><p>{{ $pages->title }}</p></a>
    @endforeach
</nav>
