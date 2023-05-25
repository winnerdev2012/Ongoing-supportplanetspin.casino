<?php
/**
* Fundist configuration file
*/
switch ( $cfg['env'] )
{
    case 'test':
        $cfg['fundistApiBaseUrl'] = KEEPALIVE_PROXY . '/apitest2.fundist.org/';
        $cfg['fundistApiKey'] = '9bdb7514b03dfe16b967e9e092ffb764';
        $cfg['fundistApiPass'] = '4075046777021750';
        $cfg['loyaltyUrl'] = KEEPALIVE_PROXY . '/loyaltytest2.fundist.org';
        $cfg['prodFundistApiUrl'] = KEEPALIVE_PROXY . '/apitest2.fundist.org/' . $cfg['language'] . '/Api';
        $cfg['prodFundistApiKey'] = $cfg['fundistApiKey'];
        $cfg['prodFundistApiPass'] = $cfg['fundistApiPass'];

        $cfg['wlc_secret'] = 'xsPNmbl30EK32kV3MYVOIYpZMy9Jf3peN1AciV4KuI3BtZLIjIg63bjV2bDZWh9r';

        break;

    case 'qa':
    case 'dev':
        $cfg['fundistApiBaseUrl'] = 'https://apiqa.fundist.org/';
        $cfg['fundistApiKey'] = '4287c9636bd142597672f6f89b7ecfa7';
        $cfg['fundistApiPass'] = '1541597186723606';
        $cfg['loyaltyUrl'] = 'https://loyaltyqa.fundist.org';
        $cfg['prodFundistApiUrl'] = 'https://apiqa.fundist.org/' . $cfg['language'] . '/Api';
        $cfg['prodFundistApiKey'] = $cfg['fundistApiKey'];
        $cfg['prodFundistApiPass'] = $cfg['fundistApiPass'];

        $cfg['wlc_secret'] = 'xsPNmbl30EK32kV3MYVOIYpZMy9Jf3peN1AciV4KuI3BtZLIjIg63bjV2bDZWh9r';

        break;

    default :
        $cfg['fundistApiBaseUrl'] = KEEPALIVE_PROXY . '/apiprod2.fundist.org/';
        $cfg['fundistApiKey'] = '6647e393615204bd93555febdcb2ae3d';
        $cfg['fundistApiPass'] = '2204137687497860';
        $cfg['loyaltyUrl'] = KEEPALIVE_PROXY . '/loyalty2.fundist.org';
        $cfg['prodFundistApiUrl'] = KEEPALIVE_PROXY . '/apiprod2.fundist.org/' . $cfg['language'] . '/Api';
        $cfg['prodFundistApiKey'] = $cfg['fundistApiKey'];
        $cfg['prodFundistApiPass'] = $cfg['fundistApiPass'];

        $cfg['wlc_secret'] = 'quoo2Iep4iefalele8ohlu7rie5Wu6eish2uVeiguiweeL3raijeipho0Neet6Qu';

        break;
}
