
<ul class="ttr-header-navigation">
    @if(Auth::user()->role == 'Admin')
        <li>
            <a href="{{ url('/home') }}" class="ttr-material-button ttr-submenu-toggle">HOME</a>
        </li>
    @endif
    <li>
        <a href="{{ url('/logout') }}" class="ttr-material-button ttr-submenu-toggle" style="padding-right:0px">LOGOUT</a>
    </li>

</ul>