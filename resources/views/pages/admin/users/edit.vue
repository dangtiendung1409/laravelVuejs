<template>
    <form @submit.prevent="updateUsers()" enctype="multipart/form-data">
        <a-card title="Cập nhật tài khoản" style="width: 100%">
            <div class="row mb-3">
                <div class="col-12 col-sm-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <a-avatar shape="square" :size="200">
                                <template #icon>
                                    <img :src="avatarUrl" alt="Avatar">
                                </template>
                            </a-avatar>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <a-button type="primary" @click="triggerFileInput">
                                <i class="fa-solid fa-plus me-2"></i>
                                <span>Chọn ảnh</span>
                            </a-button>
                            <input type="file" ref="fileInput" @change="handleFileChange" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <!-- Các trường khác -->
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.status_id }">Tình trạng:</span>
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
                    <!-- Các trường khác -->
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.username }">Tên tài khoản:</span>
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
                    <!-- Các trường khác -->
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end"></div>
                        <div class="col-12 col-sm-5">
                            <a-checkbox v-model:checked="users.change_password">
                                Đổi mật khẩu
                            </a-checkbox>
                        </div>
                    </div>
                    <div class="row mb-3" v-if="users.change_password">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.password }">Mật khẩu:</span>
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
                    <div class="row mb-3" v-if="users.change_password">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{'text-danger': errors.password_confirmation }">Xác nhận mật khẩu:</span>
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
                    <div class="row mb-3" >
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span>đăng nhập gần đây: </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                           <span>
                              {{ users.login_at }}
                           </span>
                        </div>
                    </div>
                    <div class="row mb-3" >
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span>đổi mật khẩu gần đây: </span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                           <span>
                              {{ users.change_password_at }}
                           </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <a-button type="primary" @click="updateUsers">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        <span>Cập nhật</span>
                    </a-button>
                </div>
            </div>
        </a-card>
    </form>
</template>

<script setup>
import { ref, reactive } from "vue";
import { message } from 'ant-design-vue';
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import dayjs from "dayjs";
import { useStore } from '../../../stores/use-menu.js';
import axios from 'axios';

const router = useRouter();
const route = useRoute();
const $store = useStore();
const data = ref({ users_status: [], departments: [] });

const users = reactive({
    username: "",
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    department_id: null,
    status_id: null,
    avatar: null,
    change_password: false,
    login_at: "",
    change_password_at: ""
});

const errors = ref({});
const avatarUrl = ref("../../../../img/user.jpeg");
const fileInput = ref(null);

const getUsersEdit = async () => {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/users/${route.params.id}/edit`);
        users.status_id = response.data.users.status_id;
        users.username = response.data.users.username;
        users.name = response.data.users.name;
        users.email = response.data.users.email;
        users.department_id = response.data.users.department_id;
        users.avatar = response.data.users.avatar;

        if (response.data.users.avatar) {
            avatarUrl.value = `/${response.data.users.avatar}`;
        }

        users.login_at = response.data.users.login_at
            ? dayjs(response.data.users.login_at).format('DD/MM/YYYY - HH:mm')
            : "Chưa có lượt đăng nhập gần đây";

        users.change_password_at = response.data.users.change_password_at
            ? dayjs(response.data.users.change_password_at).format('DD/MM/YYYY - HH:mm')
            : "Chưa có lượt đổi mật khẩu gần đây";

        data.value.users_status = response.data.users_status;
        data.value.departments = response.data.departments;

    } catch (error) {
        console.error(error);
    }
};

const triggerFileInput = () => {
    fileInput.value.click();
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        users.avatar = file;
        avatarUrl.value = URL.createObjectURL(file);
    }
};

const filterOption = (input, option) => {
    return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const updateUsers = async () => {
    const formData = new FormData();
    formData.append('username', users.username);
    formData.append('name', users.name);
    formData.append('email', users.email);
    formData.append('department_id', users.department_id);
    formData.append('status_id', users.status_id);
    if (users.avatar) {
        formData.append('avatar', users.avatar);
    }
    try {
        const response = await axios.post(`http://127.0.0.1:8000/api/users/${route.params.id}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PUT'
            }
        });
        errors.value = {};
        if (response.status === 200) {
            message.success('Cập nhật tài khoản thành công');
            router.push({ name: "admin-users" });
        }
    } catch (error) {
        console.log(error.response.data);
        errors.value = error.response.data.errors;
    }
};

getUsersEdit();

</script>

<style>
.select-danger {
    border: 1px solid red;
}
.input-danger {
    border-color: red;
}
</style>
