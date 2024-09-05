<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  roles: Array,
  permissions: Array
});

</script>

<template>
  <AdminLayout title="User Details">
    <template #header>
      User Details
    </template>

    <div class="max-w-5xl mx-auto pb-1 px-8">
      <div class="flex items-center justify-end">
        <Link :href="route('users.index')"
          class="cursor-pointer inline-flex items-center ml-3 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
          Back
        </Link>
      </div>
    </div>

    <div class="max-w-5xl mx-auto pt-3 pb-0 sm:px-6 lg:px-8">
      <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-0">
          <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6" v-if="user.photo">
            <img class="block -my-2 mr-2 w-20 h-20 object-cover object-center rounded-full"
              :src="`/storage/${user.photo}`" />
          </div>
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium">
                Full Name
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                <span v-if="user.prefixname">{{ user.prefixname }}&nbsp;</span>
                <span v-if="user.suffixname">
                  {{ user.fullname }}, {{ user.suffixname }}
                </span>
                <span v-else="user.suffixname">{{ user.fullname }}</span>
              </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium">
                Username
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                {{ user.username }}
              </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-md font-medium">
                Email address
              </dt>
              <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2">
                {{ user.email }}
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>

    <div class="max-w-5xl mx-auto pt-3 pb-0 sm:px-6 lg:px-8">
      <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-0 grid grid-cols-2">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
              <dt class="text-md font-bold">
                Roles
              </dt>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6" 
              v-for="role in user.roles" :key="role.id">
              <div class="text-md">
                {{ role.name }}
              </div>
            </div>
          </dl>
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
              <dt class="text-md font-bold">
                Permissions
              </dt>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6" 
              v-for="permission in user.permissions" :key="permission.id">
              <div class="text-md">
                {{ permission.name }}
              </div>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>