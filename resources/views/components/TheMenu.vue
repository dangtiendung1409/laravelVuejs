<template>
    <a-menu
        v-model:openKeys="menuStore.openKeys"
        v-model:selectedKeys="menuStore.selectedKeys"
        mode="inline"
        :items="menuStore.items"
    ></a-menu>
</template>

<script setup>
import { useStore } from '../stores/use-menu.js';
const menuStore = useStore();
</script>

