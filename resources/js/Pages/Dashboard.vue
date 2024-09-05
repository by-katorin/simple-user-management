<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

	<Head title="Dashboard" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
						<ApplicationLogo class="block h-12 w-auto" />

						<h1 class="mt-8 text-2xl font-medium text-gray-900">
							Welcome to Simple User application!
						</h1>

						<p class="mt-6 text-gray-500 leading-relaxed">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
							labore
							et
							dolore
							magna aliqua.
							Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
							commodo
							consequat.
						</p>
					</div>

					<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
						<div>
							<div class="flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									class="w-6 h-6 stroke-gray-400">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
								</svg>
								<h2 class="ms-3 text-xl font-semibold text-gray-900">
									<a :href="route('users.index')">User Management</a>
								</h2>
							</div>

							<p class="mt-4 text-gray-500 text-sm leading-relaxed">
								Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
								laudantium, totam
								rem
								aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
								dicta sunt
								explicabo.
							</p>

							<p class="mt-4 text-sm">
								<a :href="route('users.index')" class="inline-flex items-center font-semibold text-indigo-700">
									Go to Users List page

									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
										<path fill-rule="evenodd"
											d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
											clip-rule="evenodd" />
									</svg>
								</a>
							</p>
						</div>

						<div>
							<div class="flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									class="w-6 h-6 stroke-gray-400">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
								</svg>
								<h2 class="ms-3 text-xl font-semibold text-gray-900">
									<a href="#">User Management (Soft-Deleted Users)</a>
								</h2>
							</div>

							<p class="mt-4 text-gray-500 text-sm leading-relaxed">
								Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
								velit,
								sed quia
								non
								numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem
							</p>

							<p class="mt-4 text-sm">
								<a href="#" class="inline-flex items-center font-semibold text-indigo-700">
									Go to Soft-deleted Users List page

									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
										<path fill-rule="evenodd"
											d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
											clip-rule="evenodd" />
									</svg>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
