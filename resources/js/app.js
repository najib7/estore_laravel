require("./bootstrap");

import BootstrapVue from "bootstrap-vue";
import vSelect from "vue-select";
import Vue from "vue";
import miix from "./mix";

window.Vue = require("vue");
window.eventBus = new Vue();
window.Swal = require("sweetalert2");

Vue.mixin(miix);
Vue.use(BootstrapVue);
Vue.component("v-select", vSelect);
Vue.prototype.$config = window._config;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i);

files.keys().map(key =>
   Vue.component(
      key
         .split("/")
         .pop()
         .split(".")[0],
      files(key).default
   )
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
   el: "#app"
});

(function($) {
   "use strict";

   // Add active state to sidbar nav links
   var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
   $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
      if (this.href === path) {
         $(this).addClass("active");
         $(this)
            .parent()
            .parent()
            .collapse("show");
      }
   });

   // Toggle the side navigation
   $("#sidebarToggle").on("click", function(e) {
      e.preventDefault();
      $("body").toggleClass("sb-sidenav-toggled");
   });
})(jQuery);
