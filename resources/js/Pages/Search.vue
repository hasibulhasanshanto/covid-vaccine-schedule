<script setup lang="ts">
import { reactive } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    user: Object,
    paramsObj: Object,
});

const searchParams = reactive({
    nid: props?.paramsObj?.nid ?? "",
});

const form = useForm({
    nid: props?.paramsObj?.nid ?? "",
});

const checkVaccineStatusHandler = () => {
    console.log("Check Vaccine Status");
    form.get(route("home.search", searchParams), {
        onSuccess: () => {
            console.log("Searching....");
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Search" />

        <div class="flex justify-center">
            <div
                class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8"
            >
                <form
                    class="space-y-3"
                    @submit.prevent="checkVaccineStatusHandler"
                >
                    <h5 class="text-2xl font-medium text-black mb-2">
                        Check you vaccination status
                    </h5>

                    <div>
                        <InputLabel for="nid" value="NID Number" />
                        <TextInput
                            v-model="form.nid"
                            type="text"
                            id="nid"
                            class="mt-1 block w-full"
                            placeholder="Example: 989312547890"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.nid" />
                    </div>

                    <PrimaryButton
                        type="submit"
                        class="w-full text-center justify-center"
                    >
                        Search
                    </PrimaryButton>
                </form>

                <div
                    v-if="!props.user && props?.paramsObj?.nid"
                    id="alert-additional-content-2"
                    class="p-4 text-red-800 border border-red-300 rounded-lg bg-red-50 mt-5"
                    role="alert"
                >
                    <div class="flex items-center">
                        <svg
                            class="flex-shrink-0 w-4 h-4 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                            />
                        </svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">
                            You are "Not registered"
                        </h3>
                    </div>
                    <div class="mt-2 mb-4 text-sm">
                        It seems that you're not registered yet. Please first
                        register yourself with the following ling.
                        <Link :href="route('show.registration')">
                            Register now
                        </Link>
                    </div>
                    <div class="flex">
                        <Link
                            :href="route('show.registration')"
                            type="button"
                            class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center"
                        >
                            Register now
                        </Link>
                    </div>
                </div>

                <!-- Not scheduled  -->
                <div
                    v-if="
                        props?.user?.registration?.status === 'Not scheduled' ||
                        props?.user?.registration?.status === 'Scheduled'
                    "
                    id="alert-additional-content-1"
                    class="p-4 mt-5 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert"
                >
                    <div class="flex items-center">
                        <svg
                            class="flex-shrink-0 w-4 h-4 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                            />
                        </svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">
                            Your vaccination is
                            {{ props?.user?.registration?.status }}
                        </h3>
                    </div>
                    <div
                        v-if="
                            props?.user?.registration?.status ===
                            'Not scheduled'
                        "
                        class="mt-2 mb-4 text-sm"
                    >
                        When your vaccination date is scheduled, you will send
                        you a notification with date. Thanks for your patience.
                    </div>
                    <div
                        v-if="props?.user?.registration?.status === 'Scheduled'"
                        class="mt-2 mb-4 text-sm"
                    >
                        Your vaccination date is {{ props?.user?.registration?.scheduled_date }}. Please come to the
                        center on time and get your COVID vaccination for you
                        and your family safety. Thanks
                    </div>
                    <div class="flex">
                        <button
                            type="button"
                            class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                            data-dismiss-target="#alert-additional-content-1"
                            aria-label="Close"
                        >
                            Dismiss
                        </button>
                    </div>
                </div>

                <!-- Vaccinated  -->
                <div
                    v-if="props?.user?.registration?.status === 'Vaccinated'"
                    id="alert-additional-content-3"
                    class="p-4 mt-5 text-green-800 border border-green-300 rounded-lg bg-green-50"
                    role="alert"
                >
                    <div class="flex items-center">
                        <svg
                            class="flex-shrink-0 w-4 h-4 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                            />
                        </svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">Vaccinated</h3>
                    </div>
                    <div class="mt-2 mb-4 text-sm">
                        Congratulations! You're successfully Vaccinated. Check
                        your email for more information.
                    </div>
                    <div class="flex">
                        <button
                            type="button"
                            class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                            data-dismiss-target="#alert-additional-content-3"
                            aria-label="Close"
                        >
                            Dismiss
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
