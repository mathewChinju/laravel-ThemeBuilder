<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User') }} Edit
            </h2>
            <a href="{{ route('users.index')}}" class="bg-slate-600 text-sm text-white rounded-md px-3 py-2 "> Back</a>
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                            @php
                            $id = $user->id;  
                            $encrypted = encrypt($id);  
                            @endphp
                    <form action="{{ route('users.update',  $encrypted )}}" method="post">
                       <div >
                         @csrf 
                         <div class="flex gap-x-6 mb-6"> 
                            <div class="w-full relative">
                                <label for="" class=" text-md font-medium">User Name</label>
                                <div class="my-3">
                                    <input value="{{ old('name',  ucwords(strtolower(( trim ($user->name) ))) )}}" name="name" id="name" type="text" class="border-gray-300 shadow-sm w-full rounded-lg" placeholder="Enter user Name">
                                    @error('name')
                                    <p class="text-red-300 font-medium">{{ $message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full relative">
                                <label for="" class="text-md font-medium">Email</label>
                                <div class="my-3">
                                    <input value="{{ old('email', $user->email) }}" name="email" id="email" type="text" class="border-gray-300 shadow-sm w-full rounded-lg" placeholder="Enter email Id">
                                    @error('email')
                                       <p class="text-red-300 font-medium">{{ $message}}</p>
                                    @enderror
                                </div>
                                </div> 
                         </div>
                        
                          <div class="flex gap-x-6 mb-6"> 
                            <div class="w-full relative">
                                <label for="" class="text-md font-medium">Password</label>
                                <div class="my-3">
                                    <input
                                    type="password"
                                    value="*****"
                                    name="password"
                                    id="password"
                                    class="border-gray-300 shadow-sm w-full rounded-lg"
                                    placeholder="Enter password"
                                     autocomplete="new-password"
                                     onfocus="if(this.value==='*****'){this.value='';}"
                                    onblur="if(this.value===''){this.value='*****';}"  >

                                    {{-- <input value="{{ old('password', $user->password )}}" name="password" id="password" type="password" class="border-gray-300 shadow-sm w-full rounded-lg" placeholder="Enter password"> --}}
                                    @error('password')
                                    <p class="text-red-300 font-medium">{{ $message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full relative">
                                <label for="" class="text-md font-medium">Confirm password</label>
                                <div class="my-3">
                                    <input
                                    type="password"
                                    value="*****"
                                    name="confrmPassword"
                                    id="confrmPassword" 
                                    class="border-gray-300 shadow-sm w-full rounded-lg"
                                    placeholder="Enter password"
                                   
                                    autocomplete="new-password"
                                     onfocus="if(this.value==='*****'){this.value='';}"
                                        onblur="if(this.value===''){this.value='*****';}"  >
                                 
                                    {{-- <input value="{{ old('confrmPassword', $user->password) }}" name="confrmPassword" id="confrmPassword" type="password" class="border-gray-300 shadow-sm w-full rounded-lg" placeholder="Confirm password"> --}}
                                    @error('confrmPassword')
                                    <p class="text-red-300 font-medium">{{ $message}}</p>
                                    @enderror
                                </div> 
                            </div>
                        </div>  
  
                        
                          <button class="bg-slate-700 hover:bg-slate-500 text-sm text-white rounded-md px-4 py-3" >Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
</x-app-layout>
