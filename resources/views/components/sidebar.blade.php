<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}"><i class="fa-brands fa-playstation"></i> Rent Playstation </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PB</a>
        </div>
        <ul class="sidebar-menu">
            <?php
                if(auth()->user()->role=="admin"){?>
            <li class="nav-item ">
                <a href="{{ route('masterps.index') }}" class="nav-link ">
                    <i class="fa-solid fa-warehouse" style="color: #183153;"></i><span>Master Data PS</span></a>
            </li>
            <?php }
                ?>

            <li class="nav-item ">
                <a href="{{ route('datalist.index') }}" class="nav-link ">
                    <i class="fa-solid fa-gamepad" style="color: #183153;"></i><span>List Data PS</span></a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('datalist.detail_booked') }}" class="nav-link ">
                    <i class="fa-solid fa-clock-rotate-left" style="color: #183153;"></i><span>History Booked</span></a>
            </li>
    </aside>
</div>
