
<ul class="ttr-header-navigation" style="position: absolute;right: 5rem;">
    <li>
        <a href="{{ url('/adminDash') }}" class="ttr-material-button ttr-submenu-toggle" style="padding:0px 8px;">القسم : <span style="padding:0px 8px; color:white"> {{Auth::user()->section}} </span> </a>
    </li>
    @if(Auth::user()->role == 'Admin')
        <li>
            <a href="{{ url('/home') }}" class="ttr-material-button ttr-submenu-toggle">الرئيسية</a>
        </li>
    @endif
    <li>
        <a href="{{ url('/logout') }}" class="ttr-material-button ttr-submenu-toggle" style="padding-right:0px">تسجيل خروج</a>
    </li>
    

</ul>