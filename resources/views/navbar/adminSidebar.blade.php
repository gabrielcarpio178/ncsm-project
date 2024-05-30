<section>
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-md" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <div class="w-full h-70 flex flex-col items-center gap-2 mt-5">
                <div class="w-40 h-40">
                    <img src="/images/nolitc.png" alt="Nolitc Logo">
                </div>
                <h2 class="text-center text-2xl font-black">ADMIN</h2>
            </div>
           <ul class="mt-4 space-y-2 font-medium">
              <li>
                 <a href="{{route('admin')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="ms-3">Dashboard</span>
                 </a>
              </li>
              <li>
                 <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-registered"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Registered Students</span>
                 </a>
              </li>
              <li>
                 <a href="{{route('settings')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-gear"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Account Settings</span>
                 </a>
              </li>
              <li>
                 <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-upload"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Upload Profile</span>
                 </a>
              </li>
              <li>
                 <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Programs</span>
                 </a>
              </li>
              <li>
                 <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Nolitc Update</span>
                 </a>
              </li>
              <li>
                 <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-star"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Score Cards</span>
                 </a>
              </li>
              <li>
                <form action="{{route('signoutAction')}}" method="POST">
                    @method("POST")
                    @csrf
                    <button class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" type="submit">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                    </button>
                </form>
              </li>
           </ul>
        </div>
     </aside>
</section>
