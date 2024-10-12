<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    title: String,
});

const sidebarOpen = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <!-- Sidebar -->
        <aside class="bg-purple-700 text-white w-64 flex flex-col h-screen">
            <div class="flex items-center justify-center h-16 bg-purple-900">
                <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-10 w-auto" />
                </Link>
            </div>

            <!-- Page title under the logo -->
            <div class="text-center text-white text-lg font-semibold py-4">
                {{ title }}
            </div>

            <nav class="mt-4 px-4 space-y-2 flex-grow">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white hover:bg-purple-800 rounded-md px-3 py-2">
                    Dashboard
                </NavLink>
                <!-- More navigation links -->
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white hover:bg-purple-800 rounded-md px-3 py-2">
                    Calendar
                </NavLink>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1">
            <Head :title="title" />

            <!-- Navbar -->
            <nav class="bg-white border-b border-gray-200 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-end h-16 items-center">
                    <!-- User Dropdown -->
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center text-sm">
                                <img v-if="$page.props.jetstream.managesProfilePhotos" class="h-8 w-8 rounded-full" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" />
                                <span v-else class="text-gray-600">{{ $page.props.auth.user.name }}</span>
                            </button>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">Log Out</DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-2 sm:p-4 lg:p-10 h-full">
                <slot />
            </main>
        </div>
    </div>
</template>
