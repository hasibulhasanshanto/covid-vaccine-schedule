<script setup>
import { reactive } from "vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    centers: {
        type: Array,
        required: true,
    }
});

const form = useForm({
    full_name: "",
    email: "",
    mobile: "",
    nid: "",
    vaccine_center_id: null,
    gender: null,
});

const vaccineRegistrationHandler = () => {
    form.post(route("store.registration"), {
        onSuccess: () => console.log("User registration successfully"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registration" />

        <div class="flex justify-center">
            <div
                class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8"
            >
                <form
                    class="space-y-3"
                    @submit.prevent="vaccineRegistrationHandler"
                >
                    <h5 class="text-2xl font-medium text-black mb-2">
                        Register yourself for COVID Vaccination
                    </h5>
                    <div>
                        <InputLabel for="full_name" value="Full Name" />
                        <TextInput
                            v-model="form.full_name"
                            type="text"
                            id="full_name"
                            class="mt-1 block w-full"
                            placeholder="Example 'John Doe'"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.full_name" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            v-model="form.email"
                            type="text"
                            id="email"
                            class="mt-1 block w-full"
                            placeholder="email@example.com"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="mobile" value="Mobile Number" />
                        <TextInput
                            v-model="form.mobile"
                            type="text"
                            id="mobile"
                            class="mt-1 block w-full"
                            placeholder="01XXX-XXXXXX"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.mobile" />
                    </div>

                    <div>
                        <InputLabel for="nid" value="Mobile Number" />
                        <TextInput
                            v-model="form.nid"
                            type="text"
                            id="nid"
                            class="mt-1 block w-full"
                            placeholder="Example: 989312547890"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.nid" />
                    </div>

                    <div>
                        <InputLabel for="vaccine_center_id" value="Vaccine Center" />
                        <select
                            v-model="form.vaccine_center_id"
                            id="vaccine_center_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                        >
                            <option :value="null">Choose a center</option>
                            <option
                                :value="center.id"
                                v-for="(center, index) in centers"
                                :key="index"
                            >
                                {{ center.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.vaccine_center_id" />
                    </div>

                    <div>
                        <InputLabel for="gender" value="Gender" />
                        <select
                            v-model="form.gender"
                            id="gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                        >
                            <option :value="null">Choose a gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>

                    <button
                        type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 uppercase"
                    >
                        Register Now
                    </button>
                    <div
                        class="text-sm font-medium text-gray-500 dark:text-gray-300"
                    >
                        Already registered?
                        <a
                            href="#"
                            class="text-blue-700 hover:underline dark:text-blue-500"
                            >Check Status</a
                        >
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
