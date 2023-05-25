import {IBaseConfig} from 'wlc-engine/modules/core';

export const $base: IBaseConfig = {
    app: {
        type: 'wlc',
    },
    site: {
        name: 'PlanetSpin Casino',
        url: '',
        removeCreds: true,
    },
    contacts: {
        email: 'support@planetspin.casino',
    },
    tournaments: {
        use: false,
    },
    profile: {
        socials: {
            use: false,
        },
        store: {
            use: true,
        },
    },
    useSeo: true,
    livechat: {
        type: 'livechatinc',
        code: '14980347',
        onlyProd: false,
        hidden: false,
        setUserDetails: true,
    },
    finances: {
        depositInIframe: true,
        piqCashier: {
            theme: {
                'input': {
                    'color': '#2b294f',
                },
            },
        },
    },
    registration: {
        regCurrenciesByCountries: {
            can: ['CAD'],
        },
        filterCurrencyByGeo: true,
        filterCurrencyByCountry: true,
        skipBonusStep: true,
    },

};
