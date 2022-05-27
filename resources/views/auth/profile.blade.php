<x-app-layout>
    <x-slot name="header">
        {{ __('My Profile') }}
    </x-slot>

    <section class="bg-gray-100  bg-opacity-50 h-screen">
        <div class="container shadow-md">
            <div class="bg-white my-6">
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                    <h2 class="max-w-sm">School Information</h2>
                    <div class="max-w-sm">
                        <label class="text-sm text-gray-400">{{ auth()->user()->hasRole('staff') ? 'Staff Number' : 'Matric Number' }}</label>
                        <div class="w-full inline-flex border bg-gray-100">
                            <div class="p-2 bg-opacity-50">

                                <svg
                                    fill="none"
                                    class="w-6 text-gray-400 mx-auto"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                </svg>
                            </div>
                            <div class="p-2">
                                {{ auth()->user()->identity_no }}
                            </div>
                        </div>
                        <label class="text-sm text-gray-400">Email</label>
                        <div class="w-full inline-flex border bg-gray-100">
                            <div class="p-2 bg-opacity-50">
                                <svg
                                    fill="none"
                                    class="w-6 text-gray-400 mx-auto"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>
                            <div class="p-2">
                                {{ get_user_email() }}
                            </div>
                        </div>

                        <label class="text-sm text-gray-400">Faculty</label>
                        <div class="w-full inline-flex border bg-gray-100">
                            <div class="p-2 bg-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                            </div>
                            <div class="p-2">
                                {{ user_faculty_name() }}
                            </div>
                        </div>


                        <label class="text-sm text-gray-400">Department</label>
                        <div class="w-full inline-flex border bg-gray-100">
                            <div class="p-2 bg-opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="p-2">
                                {{ user_department_name() }}
                            </div>
                        </div>


                    </div>
                </div>

                <hr />

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                    <h2 class="max-w-sm">Personal Information</h2>
                    <div>
                        <div class="max-w-sm">
                            <label class="text-sm text-gray-400">First Name</label>
                            <div class="w-full inline-flex border bg-gray-100">
                                <div class="p-2 bg-opacity-50">
                                    <svg
                                        fill="none"
                                        class="w-6 text-gray-400 mx-auto"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                </div>
                                <div class="p-2">
                                    {{ auth()->user()->first_name }}
                                </div>
                            </div>
                        </div>

                        <div class="max-w-sm">
                            <label class="text-sm text-gray-400">Last Name</label>
                            <div class="w-full inline-flex border bg-gray-100">
                                <div class="p-2 bg-opacity-50">
                                    <svg
                                        fill="none"
                                        class="w-6 text-gray-400 mx-auto"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                </div>
                                <div class="p-2">
                                    {{ auth()->user()->last_name }}
                                </div>
                            </div>
                        </div>

                        <div class="max-w-sm">
                            <label class="text-sm text-gray-400">Other Name</label>
                            <div class="w-full inline-flex border bg-gray-100">
                                <div class="p-2 bg-opacity-50">
                                    <svg
                                        fill="none"
                                        class="w-6 text-gray-400 mx-auto"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                </div>
                                <div class="p-2">
                                    {{ auth()->user()->other_name }}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <hr />

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2 my-4 md:my-0 w-full p-4 text-gray-500">
                    <h2 class="max-w-sm">Change Password</h2>
                    <div>
                        <form action="{{ route('profile.update.password') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="max-w-sm">
                                <label class="text-sm text-gray-400">Old Password</label>
                                <div class="w-full inline-flex border">
                                    <div class="p-2 bg-opacity-50 mt-2">
                                        <svg
                                            fill="none"
                                            class="w-6 text-gray-400 mx-auto"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="p-2 w-full border-none">
                                        <input
                                            style="border: none"
                                            type="password"
                                            name="old_password"
                                            class="p-2"
                                            placeholder="Old password"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-sm">
                                <label class="text-sm text-gray-400">New Password</label>
                                <div class="w-full inline-flex border">
                                    <div class="p-2 bg-opacity-50 mt-2">
                                        <svg
                                            fill="none"
                                            class="w-6 text-gray-400 mx-auto"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="p-2">
                                        <input
                                            style="border: none"
                                            type="password"
                                            name="password"
                                            class="focus:text-gray-600 p-2"
                                            placeholder="New password"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-sm">
                                <label class="text-sm text-gray-400">Confirm Password</label>
                                <div class="w-full inline-flex border">
                                    <div class="p-2 bg-opacity-50 mt-2">
                                        <svg
                                            fill="none"
                                            class="w-6 text-gray-400 mx-auto"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="p-2">
                                        <input style="border: none"
                                               type="password"
                                               name="password_confirmation"
                                               class="text-gray-600 p-2"
                                               placeholder="Confirm password"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-sm">
                                <div class="inline-flex">
                                    <div class="p-2">
                                        <button
                                            type="submit"
                                            class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-blue-500 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-app-layout>

<div >

</div>


