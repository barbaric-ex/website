const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const plumber = require("gulp-plumber");

// Uvozimo konfiguraciju iz wpgulp.config.js
const config = require("./wpgulp.config");

// Putanje za SCSS i JS
const paths = {
  styles: {
    src: config.styleSRC, // Putanja do glavne SCSS datoteke
    dest: config.styleDestination, // Odredišna mapa za CSS
  },
  scripts: {
    src: config.jsCustomSRC, // Putanja za custom JS datoteke
    dest: config.jsCustomDestination, // Odredišna mapa za minificirane JS datoteke
  },
  vendorScripts: {
    src: config.jsVendorSRC, // Putanja za vendor JS datoteke
    dest: config.jsVendorDestination, // Odredišna mapa za vendor JS
  },
};

// Compile SCSS -> CSS
function styles() {
  return gulp
    .src(paths.styles.src)
    .pipe(plumber()) // Za sprječavanje prekida taska u slučaju grešaka
    .pipe(sourcemaps.init()) // Inicijaliziraj sourcemaps
    .pipe(sass().on("error", sass.logError)) // Kompajliranje SCSS u CSS
    .pipe(postcss([autoprefixer(), cssnano()])) // Dodavanje autoprefixera i minifikacija
    .pipe(rename({ suffix: ".min" })) // Dodavanje sufiksa .min za minificirane datoteke
    .pipe(sourcemaps.write(".")) // Pisanje sourcemaps u trenutni direktorij
    .pipe(gulp.dest(paths.styles.dest)); // Spremanje rezultata u odredišnu mapu
}

// Minify & Concatenate JS
function scripts() {
  return gulp
    .src(paths.scripts.src)
    .pipe(plumber()) // Za sprječavanje prekida taska u slučaju grešaka
    .pipe(sourcemaps.init()) // Inicijaliziraj sourcemaps
    .pipe(concat(config.jsCustomFile + ".js")) // Spajanje svih JS datoteka u jedan
    .pipe(uglify()) // Minifikacija JS-a
    .pipe(rename({ suffix: ".min" })) // Dodavanje sufiksa .min za minificirane datoteke
    .pipe(sourcemaps.write(".")) // Pisanje sourcemaps u trenutni direktorij
    .pipe(gulp.dest(paths.scripts.dest)); // Spremanje rezultata u odredišnu mapu
}

// Minify & Concatenate Vendor JS
/*function vendorScripts() {
  return gulp
    .src(paths.vendorScripts.src)
    .pipe(plumber()) // Za sprječavanje prekida taska u slučaju grešaka
    .pipe(concat(config.jsVendorFile + ".js")) // Spajanje svih vendor JS datoteka u jedan
    .pipe(uglify()) // Minifikacija JS-a
    .pipe(rename({ suffix: ".min" })) // Dodavanje sufiksa .min za minificirane datoteke
    .pipe(gulp.dest(paths.vendorScripts.dest)); // Spremanje rezultata u odredišnu mapu
}*/

// Watch task
function watch() {
  gulp.watch(paths.styles.src, styles); // Praćenje promjena u SCSS datotekama
  gulp.watch(paths.scripts.src, scripts); // Praćenje promjena u custom JS datotekama
  //gulp.watch(paths.vendorScripts.src, vendorScripts); // Praćenje promjena u vendor JS datotekama
}

// Default task
exports.styles = styles;
exports.scripts = scripts;
//exports.vendorScripts = vendorScripts;
exports.watch = watch;
exports.default = gulp.series(gulp.parallel(styles, scripts), watch);
