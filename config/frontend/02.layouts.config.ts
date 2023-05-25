import {ILayoutsConfig} from 'wlc-engine/modules/core/system/interfaces';
import * as sectionsLib from 'wlc-engine/modules/core/system/config/layouts/sections';
import * as componentLib from 'wlc-engine/modules/core/system/config/layouts/components';

export const $layouts: ILayoutsConfig = {
    'app': {
        replaceConfig: false,
        sections: {
            header: sectionsLib.header.theme2,
        },
    },
    'app.home': {
        replaceConfig: true,
        extends: 'app',
        sections: {
            'banner-section': {
                container: true,
                components: [
                    {
                        name: 'promo.wlc-banners-slider',
                        params: {
                            class: 'wlc-slider',
                            theme: 'default-banner',
                            filter: {
                                position: ['home'],
                            },
                            sliderParams: {
                                theme: 'default-banner',
                                swiper: {
                                    slidesPerView: 1,
                                    pagination: {
                                        clickable: true,
                                    },
                                    autoplay: {
                                        delay: 11000,
                                    },
                                    lazy: true,
                                },
                            },
                        },
                    },
                ],
            },
            'categories': sectionsLib.categories.catalogWithIconsBig,
            'content-games-vertical': {
                container: true,
                components: [
                    {
                        name: 'games.wlc-games-grid',
                        params: {
                            gamesRows: 1,
                            title: gettext('New games'),
                            usePlaceholders: true,
                            filter: {
                                categories: ['vertical'],
                            },
                            thumbParams: {
                                theme: 'vertical',
                                type: 'vertical',
                                themeMod: 'vertical',
                            },
                            showAllLink: {
                                use: true,
                                sref: 'app.catalog',
                                params: {
                                    category: 'new',
                                },
                            },
                        },
                    },
                ],
            },
            'promo-categories': {
                container: true,
                components: [
                    componentLib.wlcRandomGame.def,
                    {
                        name: 'games.wlc-category-preview',
                        params: {
                            categories: ['new', 'popular', 'blackjacks'],
                        },
                    },
                    componentLib.wlcLastWinsSlider.withPromoCategories,
                ],
            },
            'content-games-1': sectionsLib.contentGames.homeTop,
            'total-jackpot': sectionsLib.totalJackpotSection.home,
            'content-games-2': {
                container: true,
                components: [
                    {
                        name: 'games.wlc-games-grid',
                        params: {
                            gamesRows: 2,
                            title: gettext('Jackpots games'),
                            usePlaceholders: true,
                            filter: {
                                categories: ['jackpots'],
                            },
                            showAllLink: {
                                use: true,
                                sref: 'app.catalog.child',
                                params: {
                                    category: 'casino',
                                    childCategory: 'jackpots',
                                },
                            },
                            moreBtn: {
                                hide: true,
                                lazy: false,
                            },
                            breakpoints: {
                                'mobile': {
                                    gamesRows: 3,
                                    moreBtn: {
                                        hide: false,
                                    },
                                },
                            },
                        },
                    },
                ],
            },
            'winners-section': {
                container: true,
                components: [
                    componentLib.wlcTitle.winnersSection,
                    {
                        name: 'core.wlc-wrapper',
                        params: {
                            class: 'winners-wrapper',
                            components: [
                                {
                                    name: 'promo.wlc-winners-slider',
                                    params: {
                                        type: 'latest',
                                        theme: '1',
                                        title: gettext('Recent wins'),
                                        wlcElement: 'section_last-winners',
                                        swiper: {
                                            breakpoints: {
                                                320: {
                                                    slidesPerView: 4,
                                                },
                                            },
                                        },
                                    },
                                },
                                {
                                    name: 'promo.wlc-winners-slider',
                                    params: {
                                        type: 'biggest',
                                        theme: '1',
                                        title: gettext('Recent wins'),
                                        wlcElement: 'section_last-winners',
                                        swiper: {
                                            breakpoints: {
                                                320: {
                                                    slidesPerView: 4,
                                                },
                                            },
                                        },
                                    },
                                },
                                {
                                    name: 'promo.wlc-jackpots-slider',
                                    params: {
                                        sliderParams: {
                                            swiper: {
                                                breakpoints: {
                                                    320: {
                                                        slidesPerView: 4,
                                                    },
                                                },
                                            },
                                        },
                                    },
                                },
                            ],
                        },
                    },
                ],
            },
            'content-games-3': {
                container: true,
                components: [
                    {
                        name: 'games.wlc-games-grid',
                        params: {
                            gamesRows: 2,
                            title: gettext('Slots'),
                            usePlaceholders: true,
                            filter: {
                                categories: ['slots'],
                            },
                            showAllLink: {
                                use: true,
                                sref: 'app.catalog.child',
                                params: {
                                    category: 'casino',
                                    childCategory: 'slots',
                                },
                            },
                            moreBtn: {
                                hide: true,
                                lazy: false,
                            },
                            breakpoints: {
                                'mobile': {
                                    gamesRows: 3,
                                    moreBtn: {
                                        hide: false,
                                    },
                                },
                            },
                        },
                    },
                ],
            },
            'loyalty-program': sectionsLib.loyaltyProgramSection.homeLoyalty,
            'providers': {
                container: true,
                components: [
                    {
                        name: 'games.wlc-provider-links',
                        params: {
                            iconsType: 'color',
                            colorIconBg: 'dark',
                            sliderParams: {
                                spaceBetween: 10,
                                slidesPerView: 2,
                                slidesPerGroup: 1,
                                loop: true,
                                navigation: {
                                    prevEl: '.wlc-provider-links .wlc-swiper-button-prev',
                                    nextEl: '.wlc-provider-links .wlc-swiper-button-next',
                                },
                                breakpoints: {
                                    320: {
                                        spaceBetween: 10,
                                        slidesPerView: 2,
                                        slidesPerGroup: 1,
                                    },
                                    560: {
                                        spaceBetween: 10,
                                        slidesPerView: 3,
                                        slidesPerGroup: 1,
                                    },
                                    720: {
                                        spaceBetween: 15,
                                        slidesPerView: 4,
                                        slidesPerGroup: 4,
                                    },
                                    1024: {
                                        spaceBetween: 15,
                                        slidesPerView: 5,
                                        slidesPerGroup: 5,
                                    },
                                    1366: {
                                        spaceBetween: 15,
                                        slidesPerView: 6,
                                        slidesPerGroup: 6,
                                    },
                                    1630: {
                                        spaceBetween: 15,
                                        slidesPerView: 7,
                                        slidesPerGroup: 7,
                                    },
                                },
                            },
                        },
                    },
                ],
            },
            // 'providers': {
            //     ...sectionsLib.providers.adaptiveProviders,
            // },
            'content-games-4': {
                container: true,
                components: [
                    {
                        name: 'games.wlc-games-grid',
                        params: {
                            gamesRows: 2,
                            title: gettext('Table games'),
                            usePlaceholders: true,
                            filter: {
                                categories: ['tablegames'],
                            },
                            showAllLink: {
                                use: true,
                                sref: 'app.catalog.child',
                                params: {
                                    category: 'casino',
                                    childCategory: 'tablegames',
                                },
                            },
                            moreBtn: {
                                hide: true,
                                lazy: false,
                            },
                            breakpoints: {
                                'mobile': {
                                    gamesRows: 3,
                                    moreBtn: {
                                        hide: false,
                                    },
                                },
                            },
                        },
                    },
                ],
            },
            'home-about': sectionsLib.promoAboutUs.def,
        },
    },
    'app.catalog': {
        replaceConfig: true,
        extends: 'app',
        sections: {
            'categories': sectionsLib.categories.catalogWithIconsBig,
            'content-games': sectionsLib.contentGames.catalog,
        },
    },
    'app.vip': {
        extends: 'app',
        sections: {
            content: {
                container: true,
                theme: 'vip',
                components: [
                    {
                        name: 'static.wlc-post',
                        params: {
                            showTitle: true,
                            slug: 'sitetext-vip',
                        },
                    },
                ],
            },
        },
    },
};
