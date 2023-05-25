import {IBonusesModule} from 'wlc-engine/modules/bonuses/system/interfaces/bonuses/bonuses.interface';
import {ITournamentsModule} from 'wlc-engine/modules/tournaments/system//interfaces/tournaments.interface';
import {FormElements} from 'wlc-engine/modules/core/system/config/form-elements';
import {
    IInputCParams,
    ISelectCParams,
    IValidatorSettings,
} from 'wlc-engine/modules/core';
import {ProhibitedPatterns} from 'wlc-engine/modules/core/constants';

const cityMinLengthValidator: IValidatorSettings = {
    name: 'minLength',
    text: gettext('Field length must be more than 2 characters'),
    options: 2,
};

export const $modules = {
    core: {
        components: {
            'wlc-logo': {
                image: {
                    url: 'logo.png',
                },
            },
            'wlc-error-page': {
                image: '/404-error.jpg',
            },
            'wlc-license': {
                curacao: {
                    url: 'https://licensing.gaming-curacao.com/validator/?lh=548e30c50a5d91785762df944decdff1&template=tseal',
                },
            },
        },
    },
    'icon-list': {
        components: {
            'wlc-icon-payments-list': {
                exclude: [
                    'mifinity ewallet',
                ],
                items: [
                    {
                        showAs: 'img',
                        iconUrl: '/gstatic/paysystems/V2/svg/color/dark/mifinity-ewallet.svg',
                        alt: 'Mifinity ewallet',
                    },
                ],
            },
        },
    },
    games: {
        components: {
            'wlc-provider-links': {
                iconsType: 'color',
                colorIconBg: 'dark',
            },
            'wlc-provider-games': {
                iconType: 'color',
                colorIconBg: 'dark',
            },
        },
    },
    loyalty: {
        components: {
            'wlc-loyalty-program': {
                imagePath: '/static/images/loyalty/',
                decorLeftPath: null,
                decorRightPath: null,
            },
            'wlc-loyalty-info': {
                imagePath: '/static/images/loyalty/loyalty-info-bg.jpg',
            },
        },
    },
    user: {
        components: {
            'wlc-sign-up-form': {
                class: 'wlc-sign-up-form',
                formConfig: {
                    class: 'wlc-form-wrapper',
                    components: [
                        FormElements.email,
                        FormElements.firstName,
                        FormElements.lastName,
                        {
                            name: 'core.wlc-select',
                            params: <ISelectCParams>{
                                labelText: gettext('Sex'),
                                wlcElement: 'block_gender',
                                common: {
                                    placeholder: gettext('Sex'),
                                },
                                locked: true,
                                name: 'gender',
                                validators: ['required'],
                                options: 'genders',
                            },
                        },
                        FormElements.birthDate,
                        FormElements.mobilePhoneWithCode,
                        {
                            name: 'core.wlc-select',
                            params: {
                                labelText: gettext('Country'),
                                common: {
                                    placeholder: gettext('Country'),
                                    customModifiers: 'country',
                                },
                                locked: true,
                                name: 'countryCode',
                                validators: ['required'],
                                options: 'countries',
                                autoSelect: true,
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                theme: 'vertical',
                                common: {
                                    placeholder: gettext('City'),
                                },
                                name: 'city',
                                validators: [cityMinLengthValidator, 'required'],
                                prohibitedPattern: ProhibitedPatterns.notNamesSymbols,
                                wlcElement: 'block_city',
                                customMod: ['city'],
                            },
                        },
                        FormElements.address,
                        FormElements.postalCode,
                        FormElements.registrationPasswordNew,
                        FormElements.currency,
                        FormElements.promocode,
                        FormElements.terms,
                        FormElements.age,
                        {
                            name: 'core.wlc-checkbox',
                            params: {
                                name: 'agreeWithSelfExcluded',
                                text: gettext('I have not self-excluded from any gambling website in the past 12 months'),
                                wlcElement: 'block_self_excluded',
                                common: {
                                    customModifiers: 'self-exclude',
                                },
                                validators: [''],
                            },
                        },
                        FormElements.signUp,
                        {
                            name: 'core.wlc-link-block',
                            params: {
                                common: {
                                    subtitle: gettext('Already have an account?'),
                                    link: gettext('Sign in now'),
                                    actionParams: {
                                        modal: {
                                            name: 'login',
                                        },
                                    },
                                },
                            },
                        },
                    ],
                },
            },

            'wlc-profile-form': {
                config: {
                    components: [
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('E-mail'),
                                },
                                wlcElement: 'block_email',
                                locked: true,
                                name: 'email',
                                validators: ['required', 'email'],
                                exampleValue: 'example@mail.com',
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('First name'),
                                },
                                wlcElement: 'block_Name',
                                name: 'firstName',
                                locked: true,
                                prohibitedPattern: ProhibitedPatterns.notNamesSymbols,
                                validators: ['required'],
                                exampleValue: gettext('Enter your name'),
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('Last name'),
                                },
                                wlcElement: 'block_last-name',
                                name: 'lastName',
                                locked: true,
                                prohibitedPattern: ProhibitedPatterns.notNamesSymbols,
                                validators: ['required'],
                                exampleValue: gettext('Enter your last name'),
                            },
                        },
                        {
                            name: 'core.wlc-select',
                            params: <ISelectCParams>{
                                labelText: gettext('Sex'),
                                wlcElement: 'block_gender',
                                common: {
                                    placeholder: gettext('Sex'),
                                },
                                locked: true,
                                name: 'gender',
                                validators: ['required'],
                                options: 'genders',
                            },
                        },
                        {
                            name: 'core.wlc-birth-field',
                            params: {
                                name: ['birthDay', 'birthMonth', 'birthYear'],
                                validators: ['required'],
                                locked: true,
                            },
                        },
                        {
                            name: 'core.wlc-country-and-state',
                            params: {
                                name: ['countryCode', 'stateCode'],
                                locked: ['countryCode'],
                                validatorsField: [{
                                    name: 'countryCode',
                                    validators: 'required',
                                }],
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('City'),
                                },
                                wlcElement: 'block_city',
                                name: 'city',
                                validators: [],
                                prohibitedPattern: ProhibitedPatterns.notNamesSymbols,
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('Address'),
                                },
                                wlcElement: 'block_address',
                                name: 'address',
                                validators: [],
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('Postal code'),
                                },
                                wlcElement: 'block_postalcode',
                                name: 'postalCode',
                                validators: ['required'],
                            },
                        },
                        {
                            name: 'user.wlc-phone-field',
                            params: {
                                name: ['phoneCode', 'phoneNumber'],
                                locked: true,
                                showVerification: true,
                                phoneCode: {
                                    common: {
                                        tooltipIcon: 'verified-icon',
                                        tooltipMod: 'resolve',
                                        tooltipText: gettext('The phone has been successfully verified'),
                                    },
                                },
                            },
                        },
                        {
                            name: 'core.wlc-input',
                            params: <IInputCParams>{
                                common: {
                                    placeholder: gettext('Password'),
                                    wlcElement: 'block_password',
                                    type: 'password',
                                    customModifiers: 'right-shift',
                                    usePasswordVisibilityBtn: true,
                                },
                                name: 'currentPassword',
                                validators: ['required'],
                            },
                        },
                        {
                            name: 'core.wlc-button',
                            params: {
                                name: 'submit',
                                wlcElement: 'button_submit',
                                common: {
                                    text: gettext('Save changes'),
                                },
                            },
                        },
                    ],
                },
            },
        },
    },
};

export const $bonuses: IBonusesModule = {
    defaultIconPath: '/static/images/bonuses/icons/',
    defaultImages: {
        image: '/static/images/bonuses/bg-default.jpg',
        imageReg: '/static/images/bonuses/bonus-bg-reg.jpg',
        imagePromo: '/static/images/bonuses/bonus-promo-bg-2.jpg',
        imagePromoHome: '/static/images/bonuses/no-bonus-block-background.jpg',
        imageBlank: '/static/images/bonuses/blank-bonus-1.jpg',
        imageDummy: '/static/images/bonuses/blank-bonus.jpg',
        imageOther: '/static/images/bonuses/modal-bonus-default.jpg',
    },
};

export const $tournaments: ITournamentsModule = {
    defaultImages: {
        image: '/static/images/tournaments/bg.jpg',
        imagePromo: '/static/images/tournaments/bg-promo.jpg',
        imageDescription: '/static/images/tournaments/details.jpg',
        imageDashboard: '/static/images/tournaments/dashboard.jpg',
    },
};
