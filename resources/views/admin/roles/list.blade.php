<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header with Create Button and Search/Sort -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h3 class="text-lg font-medium text-gray-900">Roles List</h3>
                        
                        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('roles.index') }}" class="flex items-center w-full md:w-auto">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                           placeholder="Search roles...">
                                </div>
                                <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors flex items-center">
                                    <i class="fas fa-search mr-2"></i> Search
                                </button>
                            </form>
                            
                            <!-- Sort and Create Button -->
                            <div class="flex gap-2">
                                <form method="GET" action="{{ route('roles.index') }}">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    <select name="sort" onchange="this.form.submit()" 
                                            class="border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A-Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Z-A</option>
                                    </select>
                                </form>
                                
                                <a href="{{ route('roles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors flex items-center">
                                    <i class="fas fa-plus mr-2"></i>Create
                                </a>
                            </div>
                        </div>
                    </div>

                    <x-message></x-message>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($roles as $role)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $role->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach($role->permissions as $permission)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 mb-1 mr-1">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <div class="flex justify-center gap-4">
                                                <a href="{{ route('roles.edit', $role->id) }}" 
                                                class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 bg-indigo-50 rounded-full hover:bg-indigo-100 transition-colors"
                                                title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </a>
                                                <a href="javascript:void(0);" 
                                                onclick="deleteRole('{{ $role->id }}')" 
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition-colors"
                                                title="Delete">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No roles found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($roles->hasPages())
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 mt-4">
                        {{ $roles->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteRole(id) {
                if(confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
                    $.ajax({
                        url: '{{ route("roles.destroy") }}',
                        type: 'DELETE',
                        data: { id: id },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route("roles.index") }}';
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseJSON.message);
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>