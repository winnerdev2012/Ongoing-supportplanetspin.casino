import {IMenuConfig} from 'wlc-engine/modules/menu';

export const $menu: IMenuConfig = {
    fundist: {
        defaultMenuSettings: {
            use: false,
        },
    },
    mainMenu: {
        items: [
            'main-menu:home',
            'main-menu:promotions',
            {
                name: gettext('VIP'),
                type: 'sref',
                params: {
                    state: {
                        name: 'app.vip',
                    },
                    href: {
                        url: '/vip',
                        baseSiteUrl: false,
                    },
                },
                class: 'vip',
                icon: 'vip',
                wlcElement: 'link_main-nav-vip',
            },
        ],
    },
    mobileMenu: {
        items: [
            'mobile-menu:categories',
            'mobile-menu:promotions',
            {
                name: gettext('VIP'),
                type: 'sref',
                params: {
                    state: {
                        name: 'app.vip',
                    },
                    href: {
                        url: '/vip',
                        baseSiteUrl: false,
                    },
                },
                class: 'vip',
                icon: 'vip',
                wlcElement: 'link_main-nav-vip',
            },
            {
                type: 'group',
                parent: 'mobile-menu:info',
                items: [],
            },
        ],
    },
    categoryMenu: {
        icons: {
            folder: 'wlc/icons/categories',
            use: true,
            extension: 'png',
        },
    },
    burgerPanel: {
        left: {
            headerMenu: {
                enableByFundistMenuSettings: false,
            },
        },
    },
};
