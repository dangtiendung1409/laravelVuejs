<template>
    <form @submit.prevent="createUsers" enctype="multipart/form-data">
        <a-card title="Tạo mới tài khoản" style="width: 100%">
            <div class="row mb-3">
                <div class="col-12 col-sm-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <a-avatar shape="square" :size="200">
                                <template #icon>
                                    <img :src="avatarSrc" alt="Avatar">
                                </template>
                            </a-avatar>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <a-button type="primary" @click="selectImage">
                                <i class="fa-solid fa-plus me-2"></i>
                                <span>chọn ảnh</span>
                            </a-button>
                            <input type="file" ref="fileInput" @change="handleFileChange" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <!-- Các phần form khác -->
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.status_id }">
                                    Tình trạng:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Tình trạng"
                                style="width: 100%"
                                :options="data.users_status"
                                :filter-option="filterOption"
                                allow-clear
                                v-model:value="users.status_id"
                                :class="{'select-danger': errors.status_id }"
                            ></a-select>
                            <div class="w-100"></div>
                            <small v-if="errors.status_id" class="text-danger">{{errors.status_id[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.username }">
                                    Tên tài khoản:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                placeholder="Tên tài khoản"
                                allow-clear
                                v-model:value="users.username"
                                :class="{'input-danger': errors.username }"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.username" class="text-danger">{{errors.username[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.name }">
                                    Họ và tên:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                placeholder="Họ và tên"
                                allow-clear
                                v-model:value="users.name"
                                :class="{'input-danger': errors.name }"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.email }">
                                    Email:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                placeholder="Email"
                                allow-clear
                                v-model:value="users.email"
                                :class="{'input-danger': errors.email }"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.department_id }">
                                    Phòng ban:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Phòng ban"
                                style="width: 100%"
                                :options="data.departments"
                                :filter-option="filterOption"
                                allow-clear
                                v-model:value="users.department_id"
                                :class="{'select-danger': errors.department_id }"
                            ></a-select>
                            <div class="w-100"></div>
                            <small v-if="errors.department_id" class="text-danger">{{errors.department_id[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.password }">
                                    Mật khẩu:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                                placeholder="Mật khẩu"
                                allow-clear
                                v-model:value="users.password"
                                :class="{'input-danger': errors.password }"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.password" class="text-danger">{{errors.password[0]}}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.password_confirmation }">
                                    Xác nhận mật khẩu:
                                </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                                placeholder="Xác nhận mật khẩu"
                                allow-clear
                                v-model:value="users.password_confirmation"
                                :class="{'input-danger': errors.password_confirmation }"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.password_confirmation" class="text-danger">{{errors.password_confirmation[0]}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
                    <a-button class="me-0 me-sm-2 mb-3 mb-sm-0">
                        <router-link :to="{name: 'admin-users'}">
                            <span>Huỷ</span>
                        </router-link>
                    </a-button>
                    <a-button type="primary" html-type="submit">
                        <span>Lưu</span>
                    </a-button>
                </div>
            </div>
        </a-card>
    </form>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import { message } from 'ant-design-vue';
import { useRouter } from "vue-router";
import { useStore } from '../../../stores/use-menu.js';
import axios from 'axios';

const router = useRouter();
const $store = useStore();
const data = ref({ users_status: [], departments: [] });

const users = reactive({
    username: "",
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    department_id: null, // Single value
    status_id: null // Single value
});

const errors = ref({});

// Đường dẫn hình ảnh mặc định
const defaultAvatar = "../../../../img/user.jpeg";
const avatarSrc = ref(defaultAvatar);

const fileInput = ref(null);

const getUsersCreate = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/users/create');
        data.value.users_status = response.data.users_status;
        data.value.departments = response.data.departments;
        console.log('Combined Data:', data.value);
    } catch (error) {
        console.error(error);
        errors.value = error.response.data.errors;
    }
};

const filterOption = (input, option) => {
    return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const createUsers = async () => {
    try {
        const formData = new FormData();
        formData.append('avatar', fileInput.value.files[0]); // Gửi file ảnh

        // Gửi dữ liệu người dùng và file ảnh lên server
        const response = await axios.post('http://127.0.0.1:8000/api/users', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            params: users
        });
        errors.value = {};
        if (response.status == 200) {
            message.success('Tạo tài khoản thành công');
            router.push({name: "admin-users"});
        }
        // Xử lý kết quả
    } catch (error) {
        errors.value = error.response.data.errors;
    }
};


const selectImage = () => {
    fileInput.value.click();
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            avatarSrc.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        avatarSrc.value = defaultAvatar;
    }
};

onMounted(() => {
    avatarSrc.value = defaultAvatar;
    getUsersCreate();
});
</script>

<style>
.select-danger {
    border: 1px solid red;
}
.input-danger {
    border-color: red;
}
</style>
