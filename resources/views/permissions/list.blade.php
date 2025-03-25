<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{ route('permissions.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">
                Create permission
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <div class="overflow-hidden rounded-lg shadow">
                <table class="w-full rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left" width="60">#</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left" width="120">Created</th>
                            <th class="px-6 py-3 text-center" width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission)
                                <tr class="border-b">
                                    <td class="px-6 py-3 text-left">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $permission->name }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $permission->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('permissions.edit',$permission->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600 transition-colors uppercase">
                                                Edit
                                            </a>
                                            <a href="javascript:void(0);" onclick="deletePermission({{ $permission->id }})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500 transition-colors uppercase">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="my-3">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
                function deletePermission(id) {
                if(confirm('Are you sure want to delete?')){
                    $.ajax({
                        url:'{{ route("permissions.destroy") }}',
                        type:'delete',
                        data:{id:id},
                        dataType:'json',
                        headers:{
                            'x-csrf-token':'{{ csrf_token() }}'
                        },
                        success:function(response){
                            window.location.href = '{{ route("permissions.index") }}';
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>


