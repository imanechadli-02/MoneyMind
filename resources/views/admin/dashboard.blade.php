<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6">
        <!-- Main Container -->
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                        Dashboard Admin
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Vue d'ensemble et gestion des utilisateurs
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                        <span class="w-2 h-2 mr-2 rounded-full bg-purple-600"></span>
                        Dernière mise à jour: {{ now()->format('H:i') }}
                    </span>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Users Card -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-200"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-xl transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center">
                                <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/50 px-2.5 py-1 rounded-full">
                                +{{ $users_last_mois }} ce mois
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $users->count() }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Utilisateurs Totaux</p>
                    </div>
                </div>

                <!-- Average Income Card -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-200"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-xl transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $revenuMensuelMoyen }} €</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Revenu Mensuel Moyen</p>
                    </div>
                </div>

                <!-- Inactive Users Card -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-pink-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-200"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-xl transition-all duration-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center">
                                <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <button onclick="openInactiveUsersModal()" 
                                class="text-xs font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                                Gérer →
                            </button>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $usersInactifs->count() }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Utilisateurs Inactifs</p>
                    </div>
                </div>
            </div>

            <!-- Users Table Section -->
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl blur opacity-30"></div>
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des Utilisateurs</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Revenu</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dernière Connexion</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($users as $user)
                                <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <img class="h-10 w-10 rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-700" 
                                                     src="{{ asset('storage/' . $user->photo) }}" 
                                                     alt="{{ $user->name }}">
                                                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white dark:border-gray-800 bg-green-400"></span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->salaire }} €</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->last_login->diffForHumans() }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Users Modal -->
    <div id="inactiveUsersModal" class="hidden fixed inset-0 z-50">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl">
                <div class="absolute top-4 right-4">
                    <button onclick="closeInactiveUsersModal()" class="p-2 text-gray-400 hover:text-gray-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Utilisateurs Inactifs</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les comptes inactifs depuis plus de 3 mois</p>
                    </div>

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @foreach ($usersInactifs as $inactif)
                        <div class="group relative bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <img class="h-12 w-12 rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-600" 
                                         src="{{ asset('storage/' . $inactif->photo) }}" 
                                         alt="{{ $inactif->name }}">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $inactif->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Inactif depuis {{ $inactif->last_login->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('utilisateurs.destroy', $inactif->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal Functions
        function openInactiveUsersModal() {
            document.getElementById('inactiveUsersModal').classList.remove('hidden');
        }

        function closeInactiveUsersModal() {
            document.getElementById('inactiveUsersModal').classList.add('hidden');
        }

        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')) {
                // Handle user deletion
                console.log('Deleting user:', userId);
            }
        }

        // Charts
        // const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        // new Chart(userGrowthCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
        //         datasets: [{
        //             label: 'Nouveaux Utilisateurs',
        //             data: [65, 78, 90, 85, 95, 110],
        //             borderColor: '#059669',
        //             tension: 0.3
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // const incomeDistributionCtx = document.getElementById('incomeDistributionChart').getContext('2d');
        // new Chart(incomeDistributionCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['0-1000€', '1000-2000€', '2000-3000€', '3000-4000€', '4000€+'],
        //         datasets: [{
        //             label: 'Nombre d\'utilisateurs',
        //             data: [30, 45, 60, 35, 20],
        //             backgroundColor: '#0EA5E9'
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
    </script>

</x-app-layout>
