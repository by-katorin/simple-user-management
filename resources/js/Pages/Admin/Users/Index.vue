<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { faPen, faTrash } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from 'vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
  trashed: false,
  users: {
    type: Array,
    default: () => [],
  },
});
const form = useForm({})

const showConfirmDeleteUserModal = ref(false);
const showConfirmRestoreUserModal = ref(false);

const confirmDeleteUser = () => {
  showConfirmDeleteUserModal.value = true;
};

const confirmRestoreUser = () => {
  showConfirmRestoreUserModal.value = true;
};

const deleteUser = (id) => {
  form.delete(route('users.destroy', id), {
    preserveScroll: true,
    onSuccess: () => closeDeleteModal(),
  });
};

const closeDeleteModal = () => {
  showConfirmDeleteUserModal.value = false;
};

const closeRestoreModal = () => {
  showConfirmRestoreUserModal.value = false;
};

const restoreUser = (id) => {
  form.patch(route('users.restore', id), {
    preserveScroll: true,
    onSuccess: () => closeRestoreModal(),
  });
};

</script>

<template>
  <AdminLayout title="Users">
    <template #header>
      <div v-if="usePage().props?.trashed">Deleted User Management</div>
      <div v-else>User Management</div>
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('users.create')" v-if="!usePage().props?.trashed"
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
          Create User
        </Link>
      </div>

      <div class="mt-6">
        <table class="w-full whitespace-nowrap border border-gray-200">
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6 text-center">Avatar</th>
            <th class="pb-4 pt-6 px-6">First Name</th>
            <th class="pb-4 pt-6 px-6">Last Name</th>
            <th class="pb-4 pt-6 px-6">Email</th>
            <th class="pb-4 pt-6 px-6 text-center">Action</th>
          </tr>
          <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center justify-center px-6 py-4 focus:text-indigo-500"
                :href="`/users/${user.id}/show`">
                <img v-if="user.photo" class="block -my-2 mr-2 w-8 h-8 rounded-full" 
                  :src="`/storage/${user.photo}`" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/users/${user.id}/show`">
                {{ user.firstname }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/users/${user.id}/show`" tabindex="-1">
                {{ user.lastname }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/users/${user.id}/show`" tabindex="-1">
                {{ user.email }}
              </Link>
            </td>
            <td class="border-t flex items-center justify-center">
              <Link v-if="usePage().props?.trashed" @click="confirmRestoreUser"
                class="inline-flex items-center my-4 mx-3 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                Restore
              </Link>

              <Link v-if="!usePage().props?.trashed" class="flex items-center px-6 py-6" :href="`/users/${user.id}/edit`" tabindex="-1">
                <FontAwesomeIcon :icon="faPen" style="color: #183153;" />
              </Link>

              <Link v-if="!usePage().props?.trashed" class="flex items-center px-6 py-6" @click="confirmDeleteUser" tabindex="-1">
                <FontAwesomeIcon :icon="faTrash" style="color: #183153;" />
              </Link>
              
              <Modal :show="showConfirmDeleteUserModal" @close="closeDeleteModal">
                <div class="p-6">
                <h2 class="text-lg font-semibold text-slate-800">
                  Are you sure to delete this user?
                </h2>
                <div class="mt-6 flex space-x-4">
                  <DangerButton @click="deleteUser(user.id)">Delete</DangerButton>
                  <SecondaryButton @click="closeDeleteModal">Cancel</SecondaryButton>
                </div>
                </div>
              </Modal>

              <Modal :show="showConfirmRestoreUserModal" @close="closeRestoreModal">
                <div class="p-6">
                <h2 class="text-lg font-semibold text-slate-800">
                  Are you sure to restore this user?
                </h2>
                <div class="mt-6 flex space-x-4">
                  <PrimaryButton @click="restoreUser(user.id)">Restore</PrimaryButton>
                  <SecondaryButton @click="closeRestoreModal">Cancel</SecondaryButton>
                </div>
                </div>
              </Modal>
            </td>
          </tr>
          <tr v-if="users.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
          </tr>
        </table>
      </div>

      <div class="flex py-8 justify-end">
        <Link :href="route('users.trashed')" v-if="!usePage().props?.trashed"
          class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
          Go to Deleted Users List
        </Link>
        <Link :href="route('users.index')" v-else
          class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
          Go to Active Users List
        </Link>
      </div>
     
    </div>
  </AdminLayout>
</template>
