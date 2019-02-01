// Import js routes

'use strict';

const routes = require('../../public/assets/js/fos_js_routes.json');
const Routing =  require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js');

Routing.setRoutingData(routes);

module.exports = Routing;
