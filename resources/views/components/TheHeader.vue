<template>
    <div class="container-fluid">
        <div class="row text-while " style="background-color: #0c713d; padding: 1rem;">
            <div class="col-1 d-flex align-items-center justify-content-center">
               <span @click="showDrawer()">X</span>
            </div>
            <div class="col-10 col-sm-9 d-flex align-items-center justify-content-center justify-content-sm-start ">
               <img src="../../img/download.jpeg" alt="Logo" height="32" width="34" class="ms-3 me-3">
                <span class="d-none d-sm-flex" style="color: white;">QUẢN TRỊ</span>
            </div>

            <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
                <span @click="showDrawerUser()">X</span>
            </div>

        </div>
    </div>
    <a-drawer
        v-model:open="open"
        class="custom-class"
        root-class-name="root-class-name"
        :root-style="{ color: 'blue' }"
        style="color: red"
        title="Danh mục"
        placement="left"
        @after-open-change="afterOpenChange"
    >
       <TheMenu />
    </a-drawer>

    <a-drawer
        v-model:open="open_user"
        class="custom-class"
        root-class-name="root-class-name"
        :root-style="{ color: 'blue' }"
        style="color: red"
        title="Admin"
        placement="right"
        @after-open-change="afterOpenChange"
    >
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>
</template>
<script setup>
import TheMenu from "../components/TheMenu.vue";
import { ref } from 'vue';
const open = ref(false);
const open_user = ref(false);
const afterOpenChange = bool => {
    console.log('open', bool);
};

const showDrawer = () => {
    open.value = true;
};
const showDrawerUser = () => {
    open_user.value = true;
};

</script>
