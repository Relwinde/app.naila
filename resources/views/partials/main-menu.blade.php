<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
        <ul class="nav-main">
            <!-- ACCUEIL -->
            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Accueil</span>
                </a>
            </li>

            <!-- ACTIVITÉS -->
            <li class="nav-main-heading">Activités</li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="#">
                    <i class="nav-main-link-icon si si-notebook"></i>
                    <span class="nav-main-link-name">Consultations</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="#">
                    <i class="nav-main-link-icon si si-heart"></i>
                    <span class="nav-main-link-name">Prestations</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('pharmacies') ? 'active' : '' }}" href="{{ route('pharmacies') }}">
                    <i class="nav-main-link-icon si si-basket-loaded"></i>
                    <span class="nav-main-link-name">Pharmacie</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="#">
                    <i class="nav-main-link-icon si si-wallet"></i>
                    <span class="nav-main-link-name">Caisse</span>
                </a>
            </li>

            <!-- OUTILS -->
            <li class="nav-main-heading">Outils</li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('examens') ? 'active' : '' }}" href="{{ route('examens') }}">
                    <i class="nav-main-link-icon si si-magnet"></i>
                    <span class="nav-main-link-name">Examens</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('produits') ? 'active' : '' }}" href="{{ route('produits') }}">
                    <i class="nav-main-link-icon si si-drop"></i>
                    <span class="nav-main-link-name">Produits</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('agents') ? 'active' : '' }}" href="{{ route('agents') }}">
                    <i class="nav-main-link-icon si si-user-follow"></i>
                    <span class="nav-main-link-name">Agents</span>
                </a>
            </li>

            <!-- PARAMÈTRES -->
            <li class="nav-main-heading">Paramètres</li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="#">
                    <i class="nav-main-link-icon si si-shield"></i>
                    <span class="nav-main-link-name">Utilisateurs</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link" href="#">
                    <i class="nav-main-link-icon si si-settings"></i>
                    <span class="nav-main-link-name">Configurations</span>
                </a>
            </li>
        </ul>
    </div>
</div>