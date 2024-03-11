import { defineStore } from 'pinia';
import { h } from 'vue';
import { useRouter } from 'vue-router';
import {
    UserOutlined,
    SettingOutlined,
    CloseOutlined,
    TagOutlined,
} from '@ant-design/icons-vue';

export const useStore = defineStore('menuStore', {
    state: () => ({
        selectedKeys: ['1'],
        openKeys: ['sub1'],
        preOpenKeys: ['sub1'],
    }),
    getters: {
        items: () => {
            const router = useRouter();
            return [
                {
                    key: '1',
                    icon: () => h(UserOutlined),
                    label: 'Tài khoản',
                    title: 'Tài khoản',
                    onClick: () => {
                        router.push({ name: 'admin-users' });
                    },
                },
                {
                    key: '2',
                    icon: () => h(TagOutlined),
                    label: 'Vai trò',
                    title: 'Vai trò',
                    onClick: () => {
                        router.push({ name: 'admin-roles' });
                    },
                },
                {
                    key: '3',
                    icon: () => h(SettingOutlined),
                    label: 'Cài đặt',
                    title: 'Cài đặt',
                    onClick: () => {
                        router.push({ name: 'admin-settings' });
                    },
                },
                {
                    key: '4',
                    icon: () => h(CloseOutlined),
                    label: 'Thoát',
                    title: 'Thoát',
                    onClick: () => {
                        router.push({ name: '' });
                    },
                },

            ];
        }
    }
});
