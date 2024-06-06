<template>
    <a-card title="Tạo mới tài khoản" style="width: 100%">
    <div class="row">
        <div class="col-12 col-sm-4">
           <div class="row">
               <div class="col-12 d-flex justify-content-center mb-3">
                   <a-avatar shape="square" :size="200">
                       <template #icon>
                           <img src="../../../../img/user.jpeg" alt="Avatar">
                       </template>
                   </a-avatar>
               </div>
               <div class="col-12 d-flex justify-content-center">
                   <a-button type="primary">
                       <i class="fa-solid fa-plus me-2"></i>
                       <span>chọn ảnh</span>
                   </a-button>
               </div>
           </div>
        </div>
        <div class="col-12 col-sm-8">2</div>
    </div>
    </a-card>
</template>
<script setup>
import { ref} from "vue";
import { useStore } from '../../../stores/use-menu.js';
import axios from 'axios';
const $store = useStore;

const users = ref([]);
</script>
