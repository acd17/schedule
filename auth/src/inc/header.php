<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title><?= $title ?? 'Home' ?></title>
    <link rel="website icon" type="jpg" href="./aset/logo.jpg">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="bg-white sticky top-0 z-50 float-left">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div x-data="{ sidebarOpen: false }">
              <!-- Tombol untuk membuka/menutup sidebar -->
              <button @click="sidebarOpen = !sidebarOpen" class="menu p-3 mt-1 flex rounded-full">
                  <img class="h-8 w-auto" src="./aset/menu.png" alt="Your Company">
              </button>
          
              <!-- Sidebar -->
              <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed left-0 top-0 h-full w-64 bg-white opacity-95 transition-transform duration-300 ease-in-out transform z-10 shadow-lg">
                  <!-- Isi sidebar Anda di sini -->
                  <ul class="p-4 w-64">
                      <li>
                        <div class="relative p-3 group" x-data="{ open: false }">
                           <button @click="open = !open" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                               <span class="absolute -inset-1.5"></span>
                               <span class="sr-only">Open user menu</span>
                               <img class="users h-10 w-10 rounded-full" src="./aset/user.png" alt="">
                               <a href="#" class="block px-4 py-2 text-lg text-black hover:shadow-lg font-bold"><?= current_user() ?></a>
                           </button>
                           <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                               <!-- <a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a> -->
                               <!-- <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a> -->
                               <a href="./logout.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                           </div>
                       </div></li>
                      <li><a href="./index.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-5">
                        <img src="./aset/list.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Task List</a></li>
                      <li><a href="./lesson_plan.php" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-4">
                        <img src="./aset/book.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                        Lesson Plan</a></li>
                      <!-- <li><a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-2">About Us</a></li>
                      <li><a href="#" class="block px-4 py-2 text-sm text-black hover:shadow-lg mt-2">Menu</a></li> -->
                  </ul>
              </div>
          </div>          
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
            <div class="logoNiku hidden  sm:block items-end flex mt-3">
                <div class="logos flex flex-row items-center"> 
                    <a class="font-bold text-black p-2">TIMECRAFT</a>
                    <img class="h-8 w-auto" src="./aset/logo.jpg" alt="logo">
                </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

    
            <!-- Profile dropdown -->
            <!-- <div class="relative ml-3 group" x-data="{ open: false }">
               <button @click="open = !open" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                   <span class="absolute -inset-1.5"></span>
                   <span class="sr-only">Open user menu</span>
                   <img class="h-8 w-8 rounded-full" src="./aset/user.png" alt="">
               </button>
               <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                   <a href="#" class="block px-4 py-2 text-sm text-stone-300" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
               </div>
           </div> -->
           
           <!-- Sertakan script Tailwind CSS dan Alpine.js jika diperlukan -->
           <script src="path/to/your/tailwind.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
          </div>
        </div>
      </div>
    </nav>
</body>
<main>
<?php flash() ?>
