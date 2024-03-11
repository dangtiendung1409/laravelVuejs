import { defineStore } from 'pinia';
import { h } from 'vue';
import { useRouter } from 'vue-router';
import {
    PieChartOutlined,
    MailOutlined,
    DesktopOutlined,
    InboxOutlined,
    AppstoreOutlined,
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
                    icon: () => h(PieChartOutlined),
                    label: 'Tài khoản',
                    title: 'Tài khoản',
                    onClick: () => {
                        router.push({ name: 'admin-users' });
                    },
                },
                {
                    key: '2',
                    icon: () => h(DesktopOutlined),
                    label: 'Vai trò',
                    title: 'Vai trò',
                    onClick: () => {
                        router.push({ name: 'admin-roles' });
                    },
                },
                {
                    key: '3',
                    icon: () => h(InboxOutlined),
                    label: 'Cài đặt',
                    title: 'Cài đặt',
                    onClick: () => {
                        router.push({ name: 'admin-settings' });
                    },
                },
                {
                    key: 'sub1',
                    icon: () => h(MailOutlined),
                    label: 'Navigation One',
                    title: 'Navigation One',
                    children: [
                        {
                            key: '5',
                            label: 'Option 5',
                            title: 'Option 5',
                        },
                        {
                            key: '6',
                            label: 'Option 6',
                            title: 'Option 6',
                        },
                        {
                            key: '7',
                            label: 'Option 7',
                            title: 'Option 7',
                        },
                        {
                            key: '8',
                            label: 'Option 8',
                            title: 'Option 8',
                        },
                    ],
                },
                {
                    key: 'sub2',
                    icon: () => h(AppstoreOutlined),
                    label: 'Navigation Two',
                    title: 'Navigation Two',
                    children: [
                        {
                            key: '9',
                            label: 'Option 9',
                            title: 'Option 9',
                        },
                        {
                            key: '10',
                            label: 'Option 10',
                            title: 'Option 10',
                        },
                        {
                            key: 'sub3',
                            label: 'Submenu',
                            title: 'Submenu',
                            children: [
                                {
                                    key: '11',
                                    label: 'Option 11',
                                    title: 'Option 11',
                                },
                                {
                                    key: '12',
                                    label: 'Option 12',
                                    title: 'Option 12',
                                },
                            ],
                        },
                    ],
                },
            ];
        }
    }
});
