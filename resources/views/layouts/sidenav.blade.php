<ul class="nav">
    <li class="{{ active( 'home' ) }} ">
        <a href="{{route('home')}}">
            <i class="nc-icon nc-bank"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="{{ active('profile/*') }}">
        <a href="{{ url('profile') }}">
            <i class="nc-icon nc-single-02"></i>
            <p>My Profile</p>
        </a>
    </li>


    <li class="{{ active( '/downlines' ) }}">
        <a href="{{ route('user.downlines') }}">
            <i class="nc-icon nc-tile-56"></i>
            <p>Downlines</p>
        </a>
    </li>
    <li class="{{ active('user.transactions') }}">
        <a href="{{ route('user.transactions') }}">
            <i class="nc-icon nc-money-coins"></i>
            <p>Transactions</p>
        </a>
    </li>

    <li class="{{ active('cashout.show') }}">
        <a href="{{ route('cashout.show') }}">
            <i class="nc-icon nc-bag-16"></i>
            <p>Cashouts</p>
        </a>
    </li>

    {{--<li>--}}
        {{--<a href="./map.html">--}}
            {{--<i class="nc-icon nc-pin-3"></i>--}}
            {{--<p>Maps</p>--}}
        {{--</a>--}}
    {{--</li>--}}

    {{--<li>--}}
        {{--<a href="./notifications.html">--}}
            {{--<i class="nc-icon nc-bell-55"></i>--}}
            {{--<p>Notifications</p>--}}
        {{--</a>--}}
    {{--</li>--}}


    {{--<li>--}}
        {{--<a href="./typography.html">--}}
            {{--<i class="nc-icon nc-caps-small"></i>--}}
            {{--<p>Typography</p>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--<li class="active-pro">--}}
        {{--<a href="./upgrade.html">--}}
            {{--<i class="nc-icon nc-spaceship"></i>--}}
            {{--<p>Upgrade to PRO</p>--}}
        {{--</a>--}}
    {{--</li>--}}
</ul>
