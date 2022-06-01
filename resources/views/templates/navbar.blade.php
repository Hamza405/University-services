
<ul class="ttr-header-navigation" style="position: absolute;right: 5rem;">
    @if(Auth::user()->role == 'Admin')
        <li>
            <a href="{{ url('/home') }}" class="ttr-material-button ttr-submenu-toggle">الرئيسية</a>
        </li>
    @endif
    <li>
        <a href="{{ url('/logout') }}" class="ttr-material-button ttr-submenu-toggle" style="padding-right:0px">تسجيل خروج</a>
    </li>

</ul>