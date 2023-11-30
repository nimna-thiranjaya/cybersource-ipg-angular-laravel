<!-- <div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{
                URL::to('/dashboard')
              }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>







            <li class="nav-item">
                <a class="nav-link" href="{{
                URL::to('/addnote')
              }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Add Note</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{
                URL::to('/favourites')
              }}">
                    <i class="icon-heart menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Favourites</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{
                URL::to('/drafts')
              }}">
                    <i class="icon-file menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Drafts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{
                URL::to('/trash')
              }}">
                    <i class="icon-trash menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Trash</span>
                </a>
            </li>
        </ul>
    </nav> -->

<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item {{ (request()->is('dashboard/*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{
                URL::to('/dashboard')
              }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('addnote*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{
                URL::to('/addnote')
              }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Add Note</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('favourites*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{
                URL::to('/favourites')
              }}">
                    <i class="icon-heart menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Favourites</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('drafts*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{
                URL::to('/drafts')
              }}">
                    <i class="icon-file menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Drafts</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('trash*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{
                URL::to('/trash')
              }}">
                    <i class="icon-trash menu-icon"></i>
                    <span class="menu-title" style="margin-top: 5px">Trash</span>
                </a>
            </li>
        </ul>
    </nav>