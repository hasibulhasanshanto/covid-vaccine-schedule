<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const form = useForm({
    nid: "",
});

const checkVaccineStatusHandler = () => {
    console.log("Check Vaccine Status");
    // form.get(route("show.registration"), {
    //     onSuccess: () => console.log("User registration successfully"),
    // });
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
            </div>
        </div>
    </GuestLayout>
</template>
