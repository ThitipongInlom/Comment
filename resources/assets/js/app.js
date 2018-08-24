require('./adminlte');
require('./bootstrap');

window.Vue = require('vue');
window.jQuery = require('jquery');

// Fa Fa Icon
require('fontawesome-free/js/all.js');

// Vue/js
Vue.component('example-component', require('./components/ExampleComponent.vue'));

