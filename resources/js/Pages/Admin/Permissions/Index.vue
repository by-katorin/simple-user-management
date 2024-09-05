<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { faPen, faTrash } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["permissions"]);

const form = useForm({})

const showConfirmDeletePermissionModal = ref(false)

const confirmDeletePermission = () => {
  showConfirmDeletePermissionModal.value = true;
}

const closeModal = () => {
  showConfirmDeletePermissionModal.value = false;
}

const deletePermission = (id) => {
  form.delete(route('permissions.destroy', id), {
    onSuccess: () => closeModal()
  });
}
</script>

<template>
  <AdminLayout title="Permissions">
    <template #header>
      Permission Management
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('permissions.create')"
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
          Create Permission
        </Link>
      </div>
      <div class="mt-6">
        <table class="w-full whitespace-nowrap border border-gray-200">
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">ID</th>
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6 text-center">Action</th>
          </tr>
          <tr v-for="permission in permissions" :key="permission.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="route('permissions.edit', permission.id)">
                {{ permission.id }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="route('permissions.edit', permission.id)">
                {{ permission.name }}
              </Link>
            </td>
            <td class="border-t flex items-center justify-center">
              <Link class="flex items-center px-6 py-6 " :href="route('permissions.edit', permission.id)" tabindex="-1">
                <FontAwesomeIcon :icon="faPen" style="color: #183153;"  @mouseover="myIcon = ['far', 'check-square']" 
                @mouseout="myIcon = ['far', 'square']" />
              </Link>

              <Link class="flex items-center px-6 py-6" @click="confirmDeletePermission" tabindex="-1">
                <FontAwesomeIcon :icon="faTrash" style="color: #183153;" />
              </Link>
              
              <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                <div class="p-6">
                  <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this Permission?</h2>
                  <div class="mt-6 flex space-x-4">
                    <DangerButton @click="deletePermission(permission.id)">Delete</DangerButton>
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                  </div>
                </div>
              </Modal>
            </td>
          </tr>
          <tr v-if="permissions.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No permissions found.</td>
          </tr>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>