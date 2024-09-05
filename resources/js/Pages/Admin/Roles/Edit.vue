<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted, watch } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import VueMultiselect from "vue-multiselect";

const props = defineProps({
  role: {
    type: Object,
    required: true,
  },
  permissions: Array,
});
const form = useForm({
  name: props.role.name,
  permissions: [],
});

onMounted(() => {
  form.permissions = props.role?.permissions;
});

watch(
  () => props.role,
  () => (form.permissions = props.role?.permissions)
);
</script>

<template>
  <AdminLayout title="Edit Role">
    <template #header>
      Edit Role
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <form @submit.prevent="form.put(route('roles.update', role.id))">
        <div class="max-w-7xl mx-auto pt-3 pb-0 sm:px-6 lg:px-8">
          <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
              <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-8">
                  <InputLabel for="name" value="Name" />
                  <TextInput id="name" type="text" class="mt-1 block w-full to-lowercase" 
                    v-model="form.name" autofocus
                    autocomplete="name" />
                  <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="col-span-12 sm:col-span-8">
                  <InputLabel for="permissions" value="Permissions" class="pb-1" />
                  <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                    :close-on-select="true" placeholder="Select Permission" label="name" track-by="id" />
                  <InputError class="mt-2" :message="form.errors.permissions" />
                </div>
              </div>

              <div class="flex items-center justify-start pt-8 pl-1 pb-3 text-start">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Update
                </PrimaryButton>
                <Link :href="route('roles.index')"
                  class="inline-flex items-center ml-3 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                  Back
                </Link>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
      <!-- <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-indigo-700">Permissions</h1>
        <div class="bg-white">
          <Table>
            <template #header>
              <TableRow>
                <TableHeaderCell>ID</TableHeaderCell>
                <TableHeaderCell>Name</TableHeaderCell>
                <TableHeaderCell>Action</TableHeaderCell>
              </TableRow>
            </template>
            <template #default>
              <TableRow
                v-for="rolePermission in role.permissions"
                :key="rolePermission.id"
                class="border-b"
              >
                <TableDataCell>{{ rolePermission.id }}</TableDataCell>
                <TableDataCell>{{ rolePermission.name }}</TableDataCell>
                <TableDataCell class="space-x-4">
                  <Link
                    :href="
                      route('roles.permissions.destroy', [
                        role.id,
                        rolePermission.id,
                      ])
                    "
                    method="DELETE"
                    as="button"
                    class="text-red-400 hover:text-red-600"
                    >Revoke</Link
                  >
                </TableDataCell>
              </TableRow>
            </template>
          </Table>
        </div>
      </div> -->
  </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>