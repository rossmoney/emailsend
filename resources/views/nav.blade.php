<nav class="bg-indigo-500">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.
  
              Heroicon name: outline/menu
  
              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
              Icon when menu is open.
  
              Heroicon name: outline/x
  
              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="hidden sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              @php 
              $activeClass = 'bg-indigo-900 text-white';
              $notActiveClass = 'text-white hover:bg-indigo-700';
              @endphp
              <a href="{{ route('home') }}" class="{{ (request()->route()->getName() == 'home') ? $activeClass : $notActiveClass }} px-3 py-2 rounded-md text-sm font-medium">Send Message</a>
  
              <a href="{{ route('messages.index') }}" class="{{ (request()->route()->getName() == 'messages.index') ? $activeClass : $notActiveClass }} px-3 py-2 rounded-md text-sm font-medium">Messages</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="{{ route('home') }}" class="{{ (request()->route()->getName() == 'home') ? $activeClass : $notActiveClass }} block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Send Message</a>
  
        <a href="{{ route('messages.index') }}" class="{{ (request()->route()->getName() == 'messages.index') ? $activeClass : $notActiveClass }} block px-3 py-2 rounded-md text-base font-medium">Messages</a>
      </div>
    </div>
</nav>

<div class="absolute top-0 right-0 mt-4 mr-4">
    @if (Route::has('login'))
        <div class="space-x-4">
            @auth
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="font-medium text-white hover:text-gray-300 focus:outline-none focus:underline transition ease-in-out duration-150"
                >
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
