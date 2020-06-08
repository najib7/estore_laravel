const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").extract([
   "popper.js",
   "bootstrap",
   "axios",
   "vue",
   "sweetalert2",
   "lodash",
]);
mix.sass("resources/sass/app.scss", "public/css");
mix.js("resources/js/Chart.js/chart.js", "public/js");
mix.version()

if(!mix.inProduction()) {
   mix.webpackConfig({
      devtool: "source-map"
   });
}
