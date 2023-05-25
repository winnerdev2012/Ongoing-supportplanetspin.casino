import {enableProdMode} from '@angular/core';

import {environment} from 'wlc-engine/environments/environment';

if (environment.production) {
    enableProdMode();
}

export {AppServerModule} from 'wlc-engine/modules/app.server.module';
export {renderModule, renderModuleFactory} from '@angular/platform-server';
