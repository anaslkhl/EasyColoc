<!-- header.html - Shared Housing Platform Header Component -->
<!-- Include this via JS fetch/include or copy into each page -->
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<header class="sticky top-0 z-50 bg-stone-900 border-b border-stone-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #DD2D4A, #C69F89);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <a href="{{ url('home') }}" class="font-serif text-xl text-white tracking-wide hover:text-amber-200 transition-colors">EasyColoc</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('home') }}" class="font-serif text-xl text-white tracking-wide hover:text-amber-200 transition-colors">Home</a>
            </div>
            <!-- Desktop Nav -->
            @auth
            <nav class="hidden md:flex items-center gap-2">
                <!-- Dashboard -->
                <a href="{{ url('dashboard') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-stone-300 
              hover:text-white hover:bg-stone-700 transition-all duration-300 relative group">
                    Dashboard
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-amber-400 transition-all duration-300 group-hover:w-full"></span>
                </a>

                <!-- Colocations -->
                <a href="{{ url('colocations') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-stone-300 
                hover:text-white hover:bg-stone-700 transition-all duration-300">
                    Colocations
                </a>

                <!-- Expenses -->
                <a href="{{ url('expences') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-stone-300 
                hover:text-white hover:bg-stone-700 transition-all duration-300">
                    Expenses
                </a>

                <!-- Balances -->
                <a href="{{ url('settlements') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-stone-300 
              hover:text-white hover:bg-stone-700 transition-all duration-300">
                    Settlements
                </a>

                <!-- Admin -->
                @if(Auth::check() && Auth::user()->role === 'admin')

                <a href="{{ url('admin') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-[#DD2D4A] 
                    hover:bg-[#DD2D4A]/20 hover:text-[#DD2D4A] transition-all duration-300">
                    Admin
                </a>
                @endif
            </nav>
            @endauth

            <!-- User Profile Dropdown -->
            @auth
            <div class="flex items-center gap-3">
                <div class="relative" id="profileDropdown">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-stone-700 transition-all duration-200 group">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold text-stone-900" style="background: #E1BB80;">
                            AL
                        </div>

                        <span class="hidden sm:block text-sm text-stone-300 group-hover:text-white transition-colors">{{Auth::user()->name}}</span>
                        <svg class="w-4 h-4 text-stone-400 transition-transform duration-200" id="dropdownChevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-52 rounded-xl shadow-2xl border border-stone-700 py-1 overflow-hidden" style="background: #1c1917;">
                        <div class="px-4 py-3 border-b border-stone-700">
                            <p class="text-xs text-stone-400">Signed in as</p>
                            <p class="text-sm font-medium text-white">{{Auth::user()->email}}</p>
                        </div>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-stone-300 hover:bg-stone-700 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-stone-300 hover:bg-stone-700 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                        <div class="border-t border-stone-700 mt-1">
                            <a href="{{ url('logout') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-stone-700 transition-all" style="color: #DD2D4A;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Hamburger -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg text-stone-400 hover:text-white hover:bg-stone-700 transition-all">
                    <svg class="w-5 h-5" id="hamburgerIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            @endauth

            @guest
            <a href="{{ url('registerForm') }}"
                class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium
          text-white bg-gradient-to-r from-indigo-600 to-purple-600
          rounded-xl shadow-lg
          hover:from-indigo-500 hover:to-purple-500
          hover:shadow-xl hover:-translate-y-0.5
          active:scale-95
          transition-all duration-300 ease-out">
                Login
            </a>
            @endguest
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-stone-700 px-4 py-3 space-y-1">
        <a href="dashboard.html" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all">Dashboard</a>
        <a href="colocations.html" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all">Colocations</a>
        <a href="expenses.html" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all">Expenses</a>
        <a href="balances.html" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all">Balances</a>
        <a href="admin.html" class="block px-4 py-2.5 rounded-lg text-sm font-medium transition-all" style="color: #DD2D4A;">Admin</a>
    </div>
</header>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        const chevron = document.getElementById('dropdownChevron');
        menu.classList.toggle('hidden');
        chevron.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profileDropdown');
        if (!dropdown.contains(e.target)) {
            document.getElementById('dropdownMenu').classList.add('hidden');
            document.getElementById('dropdownChevron').style.transform = 'rotate(0deg)';
        }
    });
    // Highlight current page
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.href.includes(currentPage)) {
            link.style.background = 'rgba(198,159,137,0.2)';
            link.style.color = '#E1BB80';
        }
    });
</script>