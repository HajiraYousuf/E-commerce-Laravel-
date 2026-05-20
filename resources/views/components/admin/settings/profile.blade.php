<div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

    {{-- HEADER --}}
    <div class="mb-8">

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Profile Settings
        </h2>

        <p class="text-gray-500 dark:text-slate-400 mt-1">
            Update your personal information
        </p>

    </div>


    @if(session('success'))

    <div class="mb-6 p-4 rounded-2xl bg-green-100 text-green-700 border border-green-200">

        {{ session('success') }}

    </div>

@endif
    {{-- FORM --}}
    <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">

        @csrf

        {{-- IMAGE --}}
        <div class="flex items-center gap-5 mb-8">

            <img
            src="{{ $user->image ? asset('storage/'.$user->image) : 'https://i.pravatar.cc/150' }}"                class="w-24 h-24 rounded-3xl object-cover border border-gray-200 dark:border-slate-700"
            >

            <div class="flex flex-col gap-3">

                <input
                    type="file"
                    name="image"
                    class="hidden"
                    id="profileImage"
                >

                <label
                    for="profileImage"
                    class="cursor-pointer w-fit px-5 h-11 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition text-white flex items-center justify-center font-medium">

                    Upload Image

                </label>

                <button
                    type="button"
                    class="px-5 h-11 rounded-2xl border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800 transition">

                    Remove Image

                </button>

            </div>

        </div>



        {{-- INPUTS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- FIRST NAME --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    First Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$user['name']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- USERNAME --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username',$user['username']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- EMAIL --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email',$user['email']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- PHONE --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Phone Number
                </label>

                <div class="flex gap-3">

                    <div class="w-20 h-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-700 dark:text-slate-300">

                        +1

                    </div>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone',$user['phone']) }}"
                        class="flex-1 h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

            </div>



            {{-- COUNTRY --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Country
                </label>

                <input
                    type="text"
                    name="country"
                    value="{{ old('country',$user['country']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- ADDRESS --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Address
                </label>

                <input
                    type="text"
                    name="address"
                    value="{{ old('address',$user['address']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- CITY --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    City
                </label>

                <input
                    type="text"
                    name="city"
                    value="{{ old('city',$user['city']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>



            {{-- POSTAL --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Postal Code
                </label>

                <input
                    type="text"
                    name="postal_code"
                    value="{{ old('postal_code',$user['postal_code']) }}"
                    class="w-full h-12 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>

        </div>



        {{-- BUTTON --}}
        <div class="flex justify-end mt-8">

            <button
                type="submit"
                class="px-8 h-12 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition text-white font-medium">

                Save Changes

            </button>

        </div>

    </form>

</div>