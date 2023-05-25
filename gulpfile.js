const gulpTask = require('./node_modules/@egamings/wlc-engine/gulpfile/gulpfile');

class gulpFile extends gulpTask {
    constructor(rootDir) {
        super(rootDir);
    }
}

new gulpFile(__dirname);
