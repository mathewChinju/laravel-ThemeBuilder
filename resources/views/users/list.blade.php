<x-app-layout>
    <x-slot name="header">
        <style>
            .data-table {
                border-collapse: separate;
                border-spacing: 0;
                width: 100%;
                border-radius: 0.5rem;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
            .data-table th {
                background-color: #F9FAFB;
                font-weight: 500;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em; 
                color: #6B7280;
                padding: 0.75rem 1rem; 
                text-align: left;
                border-bottom: 1px solid #E5E7EB;
            }
            .data-table td {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #F3F4F6;
                color: #374151;
                font-size: 0.875rem;
            }
            .data-table tbody tr:last-child td {
                border-bottom: none;
            }
            .data-table tbody tr:hover {
                background-color: #F9FAFB;
            }
            .action-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
                font-weight: 500;
                transition: all 0.15s ease;
            }
            .action-btn svg {
                width: 1rem;
                height: 1rem;
                margin-right: 0.375rem;
            }
            .role-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
                background-color: #E0E7FF;
                color: #4F46E5;
            }
            .team-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
                background-color: #F0FDF4;
                color: #16A34A;
            }
            .search-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        </style>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
                <span class="text-sm text-gray-500 font-normal ml-2">Manage system users</span>
            </h2>
            
            
            <a href="{{ route('users.create')}}" class="action-btn bg-slate-700 text-white hover:bg-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Create
            </a>
            
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <x-message></x-message>  --}}

                  <!-- Search Form -->
           <div class="search-container">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="md:w-1/3">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search by Users..."
                            value="{{ request()->get('search') }}" 
                            class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                        />
                    </div>
                    
                    
                    
                    <div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
          <!-- Search Form -->

            <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Name</th>
                             <th width="20%">Email</th> 
                             <th width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isNotEmpty()) 
                            @foreach ($users as $list)
                            @php
                            $id = $list->id;  
                            $encrypted = encrypt($id);  
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td>{{ $loop->iteration}}</td>
                                <td class="font-medium text-gray-900">
                                    @php echo  ucwords(strtolower(( trim ( $list->name ) ))) @endphp
                                    </td>
                                 
                                <td>
                                    <a href="mailto:{{ $list->email}}" class="text-blue-600 hover:text-blue-800">{{ $list->email}}</a>
                                </td>
                                
                                <td>
                                    <div class="flex space-x-2"> 
                                              <a href="{{ route('users.edit', $encrypted  )}}" class="action-btn bg-slate-50 text-slate-600 hover:bg-slate-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                             <form action="{{ route('users.destroy', $encrypted ) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn bg-red-50 text-red-600 hover:bg-red-100" onclick="return confirm('Are you sure you want to delete this User?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                         
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="mt-2 font-medium">No users found</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-container mt-4">
                <div class="bg-white shadow rounded-lg">
                {{ $users->links()}}
                 </div>
            </div>
        </div>
    </div>
 
    <x-slot name="script">
        
            <script>
                window.addEventListener('load', function () {
                    // If there are query parameters, reset input fields
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('search') || urlParams.has('status')  ) {
                        document.querySelector('input[name="search"]').value = ''; 
                    }
                }); 
    
            </script>
        
          
    </x-slot>

</x-app-layout>
