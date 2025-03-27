<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <!-- Header Section -->
        <div class="px-6 py-8 max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Catégories</h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Gérez les catégories de dépenses pour une meilleure organisation</p>
                </div>
                
                <!-- Quick Stats -->
                <div class="flex gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Catégories</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $categories->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-6 pb-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm">
                <!-- Add Category Section -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <form method="post" action="{{ route('categories.store') }}" class="flex gap-4">
                        @csrf
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <input type="text" name="title" required
                                class="block w-full pl-10 pr-4 py-3 border-gray-200 dark:border-gray-700 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Ajouter une nouvelle catégorie...">
                        </div>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md">
                            Ajouter
                        </button>
                    </form>
                </div>

                <!-- Categories Grid -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($categories as $categorie)
                        <div class="group relative bg-gray-50 dark:bg-gray-700 rounded-2xl p-4 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <span class="text-2xl">🎯</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $categorie->title }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Créé le {{ $categorie->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <button class="edit-btn p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600"
                                            data-id="{{ $categorie->id }}"
                                            data-nom="{{ $categorie->title }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>
                                    <form method="post" action="{{ route('categories.destroy', $categorie->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden" id="modal-backdrop"></div>
    <div class="fixed inset-0 z-50 hidden" id="modal">
        <div class="min-h-screen px-4 text-center">
            <div class="fixed inset-0 z-10"></div>
            <div class="inline-block align-middle">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl max-w-lg w-full p-6 text-left shadow-xl transform transition-all">
                    <div class="absolute top-4 right-4">
                        <button type="button" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Fermer</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="mb-4">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900">
                            <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white text-center">Modifier la catégorie</h3>
                    </div>

                    <form method="post" action="{{ route('categories.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="categorie_id">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la catégorie</label>
                            <input type="text" name="title" 
                                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Entrez le nom de la catégorie">
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600">
                                Annuler
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("modal");
            const backdrop = document.getElementById("modal-backdrop");
            const closeButton = modal.querySelector("button");
            const cancelButton = modal.querySelector("button[type='button']");
            const editButtons = document.querySelectorAll(".edit-btn");
            const idInput = modal.querySelector("input[name='categorie_id']");
            const titleInput = modal.querySelector("input[name='title']");

            function openModal(category) {
                modal.classList.remove("hidden");
                backdrop.classList.remove("hidden");
                document.body.classList.add("overflow-hidden");
                
                idInput.value = category.id;
                titleInput.value = category.nom;
            }

            function closeModal() {
                modal.classList.add("hidden");
                backdrop.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const category = {
                        id: this.getAttribute("data-id"),
                        nom: this.getAttribute("data-nom"),
                    };
                    openModal(category);
                });
            });

            [closeButton, cancelButton, backdrop].forEach(element => {
                element.addEventListener("click", closeModal);
            });
        });
    </script>
</x-app-layout>
