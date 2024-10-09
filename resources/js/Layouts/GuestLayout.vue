<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Navbar from "@/Components/Navbar.vue";

onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <div class="min-h-screen sm:pt-0 bg-gray-100">
        <div class="container mx-auto">
            <Navbar />
            <main class="pt-[100px]">
                <slot />
            </main>
        </div>
    </div>
</template>
