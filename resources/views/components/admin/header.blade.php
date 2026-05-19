<div 
    class='bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b 
    border-slate-200/50 dark:border-slate-700/50 px-6 py-4 '>
      <div 
      class='flex items-center justify-between '>
        <!-- Left Section -->
        <div 
        class='flex items-center space-x-4'>
            <button 
            class='p-2 rounded-lg text-slate-600 dark:text-slate-300
        hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors'>
        
                <i data-lucide="menu" class='w-5 h-5'></i>
            </button>

            <div 
            class='hidden md:block'>
                <h1 
                class='text-2xl font-black text-slate-800 dark:text-white'>Dashboard</h1>
                <p 
                class='text-slate-800 dark:text-white'>Welcome back, Amal </p>
            </div>
        </div>

        <!-- Center -->
        <div class='flex-1 max-w-md mx-8 '>
            <div class='relative'>
                <i data-lucide="search" class='w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400'></i>

                <input type="text" placeholder='Search Anything'
                
                class='w-full pl-10 py-2.5 bg-slate-100 dark:bg-slate-800 border 
                border-slate-200 dark:border-slate-700 rounded-xl text-slate-800
                dark:text-white placeholder-slate-500 focus:outline-none focus:ring-2
                focus:ring-blue-500 focus:border-transparent transition-all' />
                <button 
                class='absolute right-2 top-1/2 transform -translate-y-1/2 p-1.5
                text-slate-400 hover:text-slate-600 dark:hover:text-slate-300'>
                    <i data-lucide="filter"></i>
                </button>
            </div>
        </div>
        
        <!-- Right -->
        <div 
        class='flex items-center space-x-3 '>
            <!-- Quick Action -->
            <button 
            class='hidden lg:flex items-center space-x-2 py-2 px-4 
            bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl 
            hover:shadow transition-all '>
                <i data-lucide="plus" class='w-4 h-4'></i>
                <span 
                class='text-sm font-medium'>New</span>
            </button>

            <!-- Toggle -->
            <button id="themeToggle" 
            class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 
            hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">

                <i id="themeIcon" data-lucide="sun" class="w-5 h-5"></i>
            </button>
            <!-- Notification  -->
            <button 
            class='relative p-2.5 rounded-xl text-slate-600 dark:text-slate-300 
            hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors '>
                <i data-lucide="bell" class='w-5 h-5'></i>
                <span 
                class='absolute -top-1 w-5 h-5 bg-red-500 text-white text-xs 
                rounded-full flex items-center justify-center'>3</span>
            </button>

            <!-- Settings -->
            <button 
            class='p-2.5 rounded-xl text-slate-600 dark:text-slate-300 
            hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors'>
                <i data-lucide="settings" class='w-5 h-5'></i>
            </button>

            <!-- User profile -->
            <div 
            class='flex items-center space-x-3 pl-3 border-l border-slate-200
             dark:border-slate-700 '>
                <img src={tech} alt="user" 
                
                class='w-8 h-8 rounded-full ring-2 ring-blue-500'/>
                <div 
                class='hidden md:block'>
                    <p 
                    class='text-sm font-medium text-slate-500 dark:text-slate-400'>
                        Amal Ismail </p>
                     <p 
                     class='text-xs text-slate-500 dark:text-slate-400'>
                        Adminstrator
                     </p>
                </div>
                <i data-lucide="chevron-down" class='w-4 h-4 text-slate-400'></i>
            </div>
            <div>

            </div>
        </div>
      </div>
    </div>

     