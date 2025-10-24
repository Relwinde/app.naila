<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
        <ul class="nav-main">
            <!-- ACCUEIL -->
            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-home"></i>
                    <span class="nav-main-link-name">Accueil</span>
                </a>
            </li>

            <!-- ACTIVITÉS -->
            <li class="nav-main-heading">Activités</li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('prestations') ? 'active' : '' }}" href="{{ route('prestations') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-notebook"></i>
                    <span class="nav-main-link-name">Prestations</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('pharmacies') ? 'active' : '' }}" href="{{ route('pharmacies') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-basket-loaded"></i>
                    <span class="nav-main-link-name">Pharmacie</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('caisse') ? 'active' : '' }}" href="{{ route('caisse') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-wallet"></i>
                    <span class="nav-main-link-name">Caisse</span>
                </a>
            </li>

            <!-- OUTILS -->
            <li class="nav-main-heading">Outils</li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('examens') ? 'active' : '' }}" href="{{ route('examens') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-magnet"></i>
                    <span class="nav-main-link-name">Examens</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('consultations') ? 'active' : '' }}" href="{{ route('consultations') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-heart"></i>
                    <span class="nav-main-link-name">Consultations</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('produits') ? 'active' : '' }}" href="{{ route('produits') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-drop"></i>
                    <span class="nav-main-link-name">Produits</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('approvisionnements') ? 'active' : '' }}" href="{{ route('approvisionnements') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-bag"></i>
                    <span class="nav-main-link-name">Approvisionnements</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('agents') ? 'active' : '' }}" href="{{ route('agents') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-user-follow"></i>
                    <span class="nav-main-link-name">Agents</span>
                </a>
            </li>

            <!-- PARAMÈTRES -->
            <li class="nav-main-heading">Paramètres</li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('utilisateurs') ? 'active' : '' }}" href="{{ route('utilisateurs') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">Utilisateurs</span>
                </a>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('profils') ? 'active' : '' }}" href="{{ route('profils') }}" wire:navigate>
                    <i class="nav-main-link-icon si si-user"></i>
                    <span class="nav-main-link-name">Profiles</span>
                </a>
            </li>
        </ul>
    </div>
</div>