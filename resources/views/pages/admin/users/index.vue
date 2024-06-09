<template>
    <a-card title="Tài khoản" style="width: 100%">
       <div class="row mb-3">
        <div class="col 12 d-flex justify-content-end">
            <a-button type="primary">
                <router-link :to="{name: 'admin-users-create'}">
                <i class="fa-solid fa-plus"></i>
                </router-link>
            </a-button>
        </div>
       </div>

        <div class="row">
            <div class="col-12">
                <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
                    <template #bodyCell="{ column, index, record }">
                        <template v-if="column.key === 'id'">
                            <span>{{ record.id }}</span>
                        </template>

                        <template v-if="column.key === 'status'">
                            <span v-if="record.status_id == 1" class="text-primary">{{ record.status }}</span>
                            <span v-else-if="record.status_id == 2" class="text-danger">{{ record.status }}</span>
                        </template>
                        <template v-if="column.key === 'action'">
                                <router-link :to="{name: 'admin-users-edit', params: { id: record.id }}">
                                    <a-button type="primary" class="me-sm-2 mb-2 ">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a-button>
                                </router-link>
                                <a-button type="primary" danger @click="deleteUsers(record.id)">
                                    <i class="fa-solid fa-trash"></i>
                                </a-button>
                        </template>
                    </template>
                </a-table>
            </div>
        </div>

    </a-card>
</template>
<script setup>

import { createVNode,ref} from "vue";
import { useStore } from '../../../stores/use-menu.js';
import axios from 'axios';
import {message} from "ant-design-vue";
import { Modal } from 'ant-design-vue';

import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
const $store = useStore;

const users = ref([]);

const columns = [
    {
        title: "ID",
        dataIndex: "id",
        key: "id",
    },
    {
        title: "Avatar",
        dataIndex: "avatar",
        key: "avatar",
    },
    {
        title: "Tài khoản",
        dataIndex: "username",
        key: "username",
    },
    {
        title: "Họ Tên",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Email",
        dataIndex: "email",
        key: "email",
    },
    {
        title: "Phòng ban",
        dataIndex: "departments",
        key: "departments",
        // responsive: ['md'], // ẩn cột khi ở thiết bị moblie
    },
    {
        title: "Vai trò",
        key: "roles",
    },
    {
        title: "Tình trạng",
        dataIndex: "status",
        key: "status",
    },
    {
        title: "Công cụ",
        key: "action",
        fixed: "right",
    },
];

const getUsers = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/users');
        users.value = response.data; // Cập nhật dữ liệu vào biến users

    } catch (error) {
        console.error(error);
    }
}

const deleteUsers = async (id) => {
    Modal.confirm({
        content: 'Bạn có chắc chắn?',
        icon: createVNode(ExclamationCircleOutlined),
        onOk: async () => {
            try {
                const response = await axios.delete(`http://127.0.0.1:8000/api/users/${id}`);
                if (response.status == 200) {
                    await getUsers();
                    message.success('Xoá tài khoản thành công');

                }
            } catch (error) {
                console.log(error);
            }
        },
        cancelText: 'Huỷ',
        onCancel() {
            Modal.destroyAll();
        },
    });
};

getUsers();

</script>


