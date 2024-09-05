<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { faPen, faTrash } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["roles"]);
const form = useForm({})

const showConfirmDeleteRoleModal = ref(false)

const confirmDeleteRole = () => {
  showConfirmDeleteRoleModal.value = true;
}

const closeModal = () => {
  showConfirmDeleteRoleModal.value = false;
}

const deleteRole = (id) => {
  form.delete(route('roles.destroy', id), {
    onSuccess: () => closeModal()
  });
}
</script>

<template>
  <AdminLayout title="Roles">
    <template #header>
      Role Management
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('roles.create')"
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
          Create Role
        </Link>
      </div>
      <div class="mt-6">
        <table class="w-full whitespace-nowrap border border-gray-200">
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">ID</th>
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6 text-center">Action</th>
          </tr>
          <tr v-for="role in roles" :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="route('roles.edit', role.id)">
                {{ role.id }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="route('roles.edit', role.id)">
                {{ role.name }}
              </Link>
            </td>
            <td class="border-t flex items-center justify-center">
              <Link class="flex items-center px-6 py-6 " :href="route('roles.edit', role.id)" tabindex="-1">
                <FontAwesomeIcon :icon="faPen" style="color: #183153;"  @mouseover="myIcon = ['far', 'check-square']" 
                @mouseout="myIcon = ['far', 'square']" />
              </Link>

              <Link class="flex items-center px-6 py-6" @click="confirmDeleteRole" tabindex="-1">
                <FontAwesomeIcon :icon="faTrash" style="color: #183153;" />
              </Link>
              
              <Modal :show="showConfirmDeleteRoleModal" @close="closeModal">
                <div class="p-6">
                  <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this Role?</h2>
                  <div class="mt-6 flex space-x-4">
                    <DangerButton @click="deleteRole(role.id)">Delete</DangerButton>
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                  </div>
                </div>
              </Modal>
            </td>
          </tr>
          <tr v-if="roles.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No roles found.</td>
          </tr>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>