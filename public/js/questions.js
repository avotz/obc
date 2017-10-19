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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/questions.js":
/***/ (function(module, exports) {

$(function () {

    var modalForm = $('#modal-questions');

    modalForm.on('shown.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal
        var subject = button.attr('data-transaction');
        var partner = button.attr('data-partner');
        var user = button.attr('data-user');
        $('.fa-spin').hide();

        var modal = $(this);

        modal.find('#modal-questions-subject').val(subject);
        modal.find('#modal-questions-partner').val(partner);
        modal.find('#modal-questions-user').val(user);
    });

    modalForm.find('.modal-question-btn-send').on('click', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = modalForm.find('#modal-questions-form');
        var formData = form.serializeArray();

        formData.push({ name: '_token', value: $('meta[name="csrf-token"]').attr('content') });

        $('.fa-spin').show();

        button.attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '/questions',
            data: formData,
            success: function success(resp) {

                $('.fa-spin').hide();
                button.attr('disabled', false);

                if (resp == 'ok') {
                    modalForm.find('#modal-questions-msg').val('');

                    alert('Message sent');
                }
            },
            error: function error(resp) {

                $('.fa-spin').hide();
                button.attr('disabled', false);

                var errors = resp.responseJSON.errors;
                var fields = '';

                if (errors.modal_questions_subject) fields += errors.modal_questions_subject[0] + ' | ';

                if (errors.modal_questions_msg) fields += errors.modal_questions_msg[0];

                alert('Errors: ' + fields);
            }
        });
    });
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/questions.js");


/***/ })

/******/ });