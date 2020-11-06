<ul id="slide-nav" class="sidenav sidemenu">
    <li class="menu-close"><i class="mdi mdi-close"></i></li>
    <li class="user-wrap">
        <div class="user-view row">

            <div class="col s9 infoarea">
                <a href="ui-app-profile.html"><span class="name">{{mb_strtoupper(session()->get('name'))}}</span></a>
                <a href="ui-app-profile.html"><span class="email">{{mb_strtoupper(session()->get('email'))}}</span></a>
            </div>
        </div>
    </li>
    <li class="menulinks">
        <ul class="collapsible">
            <li class="sh-wrap">
                <div class="subheader">Navigation</div>
            </li>
            <li class="lvl1 ">
                <div class=" waves-effect ">
                    <a href="sub-home.html">
                        <i class="mdi mdi-home-outline"></i>
                        <span class="title">Home Pages</span>
                    </a>
                </div>
            </li>

            <li class="sep-wrap">
                <div class="divider"></div>
            </li>
            <li class="sh-wrap">
                <div class="subheader">Get in Touch</div>
            </li>
            <li class="lvl1 ">
                <div class="waves-effect ">
                    <a href="mailto:email@example.com">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="title">Email</span> </a>
                </div>
            </li>
            <li class="lvl1 ">
                <div class="waves-effect ">
                    <a href="tel:+1 234 567 890">
                        <i class="mdi mdi-cellphone-basic"></i>
                        <span class="title">Phone</span> </a>
                </div>
            </li>
            <li class="lvl1 ">
                <div class="waves-effect ">
                    <a href="sms:+1 234 567 890">
                        <i class="mdi mdi-message-text-outline"></i>
                        <span class="title">Message</span> </a>
                </div>
            </li>
            </li>
        </ul>
    </li>
    <li class="copy-spacer"></li>
    <li class="copy-wrap">
        <div class="copyright">&copy; Copyright @ ZeroTechnology</div>
    </li>
</ul>
