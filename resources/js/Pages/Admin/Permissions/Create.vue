<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
  name: ""
})
</script>

<template>
  <AdminLayout title="Create Permission">
    <template #header>
      Create Permission
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <form @submit.prevent="form.post(route('permissions.store'))">
        <div class="max-w-7xl mx-auto pt-3 pb-0 sm:px-6 lg:px-8">
          <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
              <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-8">
                  <InputLabel for="name" value="Name" />
                  <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                    autocomplete="name" />
                  <InputError class="mt-2" :message="form.errors.name" />
                </div>
              </div>

              <div class="flex items-center justify-start pt-8 pb-3 text-start">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Create
                </PrimaryButton>
                <Link :href="route('permissions.index')"
                  class="inline-flex items-center ml-3 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                  Back
                </Link>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>