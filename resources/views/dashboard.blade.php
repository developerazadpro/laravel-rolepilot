<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ Greeting --}}
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-lg rounded-2xl p-6">
                <h3 class="text-2xl font-semibold mb-2">Welcome back, {{ Auth::user()->name ?? 'User' }} 👋</h3>
                <p class="text-sm opacity-90">You’re logged in and ready to manage your application.</p>
            </div>

            {{-- ✅ Overview Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-gray-500 font-medium">Total Users</h4>
                        <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold px-2 py-1 rounded-full">+5%</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">1,240</p>
                    <p class="text-sm text-gray-400 mt-1">Since last month</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-gray-500 font-medium">Total Orders</h4>
                        <span class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">3,580</p>
                    <p class="text-sm text-gray-400 mt-1">This month</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-gray-500 font-medium">Revenue</h4>
                        <span class="bg-yellow-100 text-yellow-600 text-xs font-semibold px-2 py-1 rounded-full">+8%</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">$24,500</p>
                    <p class="text-sm text-gray-400 mt-1">This quarter</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-gray-500 font-medium">Pending Tickets</h4>
                        <span class="bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded-full">-3%</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">42</p>
                    <p class="text-sm text-gray-400 mt-1">Customer support</p>
                </div>
            </div>

            {{-- ✅ Activity Section --}}
            <div class="bg-white shadow rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>

                <ul class="divide-y divide-gray-100">
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-gray-800 font-medium">New user registered</p>
                            <p class="text-sm text-gray-400">john@example.com</p>
                        </div>
                        <span class="text-xs text-gray-400">2 mins ago</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-gray-800 font-medium">Order #1452 placed</p>
                            <p class="text-sm text-gray-400">$199 - Electronics</p>
                        </div>
                        <span class="text-xs text-gray-400">10 mins ago</span>
                    </li>
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-gray-800 font-medium">Product updated</p>
                            <p class="text-sm text-gray-400">Smartwatch Gen 5</p>
                        </div>
                        <span class="text-xs text-gray-400">30 mins ago</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</x-admin-layout>
