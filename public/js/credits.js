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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/credits.js":
/***/ (function(module, exports) {

$(function () {

    jQuery('.js-select2').select2();
    $('#suppliers').select2({
        ajax: {
            delay: 300,
            url: '/credits/companies',
            dataType: 'json',
            data: function data(params) {
                var query = {
                    q: params.term

                    // Query parameters will be ?search=[term]&type=public
                };return query;
            },
            processResults: function processResults(data) {
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 1
    });

    jQuery('.suppliersSelectContainer').hide();

    jQuery('select[name=public]').change(function (e) {
        if (jQuery(this).val() == '1') {
            jQuery('.suppliersSelectContainer').hide();
        } else {
            jQuery('.suppliersSelectContainer').show();
        }
    });

    jQuery('.js-datepicker').datepicker({});

    $("#UploadPhoto").ajaxUpload({
        url: $("#UploadPhoto").data('url'),
        name: "photo",
        data: {},
        onSubmit: function onSubmit() {
            $('#infoBox').html('Uploading ... ');
        },
        onComplete: function onComplete(result) {

            if (result === 'error') {

                $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
                setTimeout(function () {
                    $('#infoBox').removeClass('alert-danger').hide();
                }, 3000);

                return;
            }

            $('#infoBox').addClass('alert-success').html('La foto se ha guardado con exito!!').show();
            setTimeout(function () {
                $('#infoBox').removeClass('alert-success').hide();
            }, 3000);
            d = new Date();

            $('#user-avatar').attr('src', '/storage/' + result + '?' + d.getTime());
        }
    });
});

/***/ }),

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/credits.js");


/***/ })

/******/ });