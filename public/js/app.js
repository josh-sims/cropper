/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//require('./bootstrap');
//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.component('example-component', require('./components/ExampleComponent.vue'));
//const app = new Vue({
//    el: '#app'
//});
__webpack_require__(/*! ./cropper */ "./resources/js/cropper.js");

/***/ }),

/***/ "./resources/js/cropper.js":
/*!*********************************!*\
  !*** ./resources/js/cropper.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

//cropper stuff here
function modeCheck() {
  if ($('#mode').val() == 'crop') {
    $('.croptions').fadeIn();
    $('.croptions').fadeIn();
  } else {
    $('.croptions').hide();
    $('.croptions').hide();
  }

  if ($('#mode').val() == 'fit') {
    $('.fitions').fadeIn();
    $('.fitions').fadeIn();
  } else {
    $('.fitions').hide();
    $('.fitions').hide();
  }

  if ($('#mode').val() == 'resize') {
    $('.resizeHint').fadeIn();
    $('.resizeHint').fadeIn();
  } else {
    $('.resizeHint').fadeIn();
    $('.resizeHint').fadeIn();
  }
}

$("#mode").change(function () {
  modeCheck();
});
$("#savePreset").click(function () {
  if (document.getElementById("savePreset").checked) {
    $('.preset').fadeIn();
  } else {
    $('.preset').hide();
    $('#presetName').val("");
  }
});

updateList = function updateList(indiv, outdiv) {
  var input = document.getElementById(indiv);
  var output = document.getElementById(outdiv);
  output.innerHTML = '<ul>';

  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
  }

  output.innerHTML += "</ul>";
  $("#fileList").addClass("full");
};

$(document).ready(function () {
  var last_valid_selection = null;
  $('.pres').click(function (event) {
    event.preventDefault();
    $(this).attr('data-mode') ? $("#mode").val($(this).attr('data-mode')) : $("#mode").val("");
    $(this).attr('data-position') ? $("#position").val($(this).attr('data-position')) : $("#position").val("");
    $(this).attr('data-x') ? $("#xval").val($(this).attr('data-x')) : $("#xval").val("");
    $(this).attr('data-y') ? $("#yval").val($(this).attr('data-y')) : $("#yval").val("");
    $(this).attr('data-width') ? $("#width").val($(this).attr('data-width')) : $("#width").val("");
    $(this).attr('data-height') ? $("#height").val($(this).attr('data-height')) : $("#height").val("");
    $(this).attr('data-name') ? $("#presetName").val($(this).attr('data-name')) : $("#presetName").val("");
    modeCheck();
  });
  modeCheck();
});
$("#img").change(function () {
  var totalSize = 0;

  for (var i = 0; i < this.files.length; i++) {
    var imageSize = this.files[i].size;
    totalSize = totalSize + imageSize;
  }

  if (totalSize > 8000000) {
    alert('Please upload less than 8mb at a time.');
    $("#img").val("");
    $("#fileList").html("");
    $("#fileList").removeClass("full");
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/jsims/sites/cropper/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/jsims/sites/cropper/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });