<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, watch } from "vue";
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SectionTitle from '@/Components/SectionTitle.vue';
import TextInput from '@/Components/TextInput.vue';
import VueMultiselect from "vue-multiselect";

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  roles: Array,
  permissions: Array
});

const form = useForm({
  prefixname: props.user?.prefixname,
  firstname: props.user?.firstname,
  middlename: props.user?.middlename,
  lastname: props.user?.lastname,
  suffixname: props.user?.suffixname,
  username: props.user?.username,
  email: props.user?.email,
  password: '',
  password_confirmation: '',
  photo: props.user?.photo,
  roles: props.user?.roles ?? [],
  permissions: props.user?.permissions ?? [],
});

onMounted(() => {
  form.permissions = props.user?.permissions;
  form.roles = props.user?.roles;
});

watch(
  () => props.user,
  () => {
    form.permissions = props.user?.permissions,
    form.roles = props.user?.roles
  }
);

const photoPreview =  ref('../../storage/' + props.user?.photo);
const photoInput = ref(null);

const updateUser = () => {
  if (photoInput.value) {
    form.photo = photoInput.value.files[0];
  }

  form.post(route("users.update", props.user?.id), {
    _method: 'put',
    preserveScroll: true,
    onSuccess: () => clearPhotoFileInput(),
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};

const selectNewPhoto = () => {
  photoInput.value.click();
};

const updatePhotoPreview = () => {
  const photo = photoInput.value.files[0];

  if (!photo) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    photoPreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
  if (photoInput.value?.value) {
    photoInput.value.value = null;
  }
};
</script>

<template>
  <AdminLayout title="Edit User">
    <template #header>
      Edit User
    </template>

    <form @submit.prevent="updateUser">
      <div class="max-w-7xl mx-auto pt-3 pb-0 sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 sm:rounded-lg">
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-3 pr-10">
              <SectionTitle>
                <template #title>
                  Basic  Information
                </template>
                <template #description>
                  Edit basic information such as name, username, email of user
                </template>
              </SectionTitle>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
                <div class="grid grid-cols-6 gap-6">
                  <!-- User Photo -->
                  <div class="col-span-6 sm:col-span-4">
                    <!-- User Photo File Input -->
                    <input id="photo" ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview">

                    <InputLabel for="photo" value="Photo" />

                    <!-- New Profile Photo Preview -->
                    <div v-show="photoPreview" class="mt-2">
                      <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'" />
                    </div>
                    
                    <SecondaryButton class="mt-2 me-2" type="button" @click.prevent="selectNewPhoto">
                      Select A New Photo
                    </SecondaryButton>

                    <InputError :message="form.errors.photo" class="mt-2" />
                  </div>

                  <!-- Prefix Name -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="prefixname" value="Prefix Name" />
                    <TextInput id="prefixname" v-model="form.prefixname" type="text" class="mt-1 block w-full"
                      autocomplete="prefixname" />
                    <InputError :message="form.errors.prefixname" class="mt-2" />
                  </div>

                  <!-- First Name -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="firstname" value="First Name" />
                    <TextInput id="firstname" v-model="form.firstname" type="text" class="mt-1 block w-full" required
                      autocomplete="firstname" />
                    <InputError :message="form.errors.firstname" class="mt-2" />
                  </div>

                  <!-- Middle Name -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="middlename" value="Middle Name" />
                    <TextInput id="middlename" v-model="form.middlename" type="text" class="mt-1 block w-full"
                      autocomplete="middlename" />
                    <InputError :message="form.errors.middlename" class="mt-2" />
                  </div>

                  <!-- Last Name -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="lastname" value="Last Name" />
                    <TextInput id="lastname" v-model="form.lastname" type="text" class="mt-1 block w-full" required
                      autocomplete="lastname" />
                    <InputError :message="form.errors.lastname" class="mt-2" />
                  </div>

                  <!-- Suffix Name -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="suffixname" value="Suffix Name" />
                    <TextInput id="suffixname" v-model="form.suffixname" type="text" class="mt-1 block w-full"
                      autocomplete="suffixname" />
                    <InputError :message="form.errors.suffixname" class="mt-2" />
                  </div>

                  <!-- Username -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="username" value="Username" />
                    <TextInput id="username" v-model="form.username" type="text" class="mt-1 block w-full" required
                      autocomplete="username" />
                    <InputError :message="form.errors.username" class="mt-2" />
                  </div>

                  <!-- Email -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                      autocomplete="email" />
                    <InputError :message="form.errors.email" class="mt-2" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto pb-0 sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 sm:rounded-lg">
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-3">
              <SectionTitle>
                <template #title>
                  Password
                </template>
                <template #description>
                  Input strong password
                </template>
              </SectionTitle>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 py-5 bg-gray-100 sm:p-6 shadow sm:rounded-lg">
                <div class="grid grid-cols-6 gap-6">
                  <!-- Password -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                      autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                  </div>

                  <!-- Password Confirmation -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                      class="mt-1 block w-full" required autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto py-0 sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 sm:rounded-lg">
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-3">
              <SectionTitle>
                <template #title>
                  Roles and Permissions
                </template>
                <template #description>
                  Assign roles and permissions to user
                </template>
              </SectionTitle>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 pt-5 bg-gray-100 sm:pt-6 shadow sm:rounded-lg">
                <div class="grid grid-cols-6 gap-6">
                  <!-- Role -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="roles" value="Roles" class="pb-1" />
                    <VueMultiselect
                      v-model="form.roles"
                      :options="roles" 
                      :multiple="true" 
                      :close-on-select="true"
                      placeholder="Select User Roles" 
                      label="name" 
                      track-by="id"
                    >
                      <span slot="noResult">
                        Role not found. Consider changing the search query.
                      </span>
                    </VueMultiselect>
                    <InputError class="mt-2" :message="form.errors.roles" />
                  </div>
                </div>
              </div>

              <div class="px-4 py-5 bg-gray-100 sm:py-6 shadow sm:rounded-lg">
                <div class="grid grid-cols-6 gap-6">
                  <!-- Permission -->
                  <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="permissions" value="Permissions" class="pb-1" />
                    <VueMultiselect
                      v-model="form.permissions"
                      :options="permissions" 
                      :multiple="true" 
                      :close-on-select="true"
                      placeholder="Select User Permissions" 
                      label="name" 
                      track-by="id"
                    >
                      <span slot="noResult">
                        Permission not found. Consider changing the search query.
                      </span>
                    </VueMultiselect>
                    <InputError class="mt-2" :message="form.errors.permissions" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto pb-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-end px-4 py-3 text-end sm:px-6">
          <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Submit
          </PrimaryButton>
          <Link :href="route('users.index')"
            class="inline-flex items-center ml-3 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            Back
          </Link>
        </div>
      </div>

    </form>
  </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>