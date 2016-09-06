var monarchApp = angular.module('monarchApp', ['ngRoute', 'ngAnimate']);
(function () {
    'use strict';
    monarchApp
        .directive('datePicker', function() {
        var link = function(scope, element, attrs) {
            var modelName = attrs['datePicker'];
            $(element).datepicker(
                {
                    onSelect: function(dateText) {
                        scope[modelName] = dateText;
                        scope.$apply();
                    }
                });
        };
        return {
            require: 'ngModel',
            restrict: 'A',
            link: link
        }
    });

})();

// configure our routes
monarchApp.config(function($routeProvider) {
    $routeProvider

    //.when('/view-profile', {
    //    templateUrl : 'pages/view-profile.hbs',
    //    controller  : 'view-profileController'
    //})

});

monarchApp.controller('indexController', function($scope) {
    
});

monarchApp.controller('advanced-datatablesController', function($scope) {
    
});

monarchApp.controller('animationsController', function($scope) {
    
});

monarchApp.controller('bs-carouselController', function($scope) {
    
});

monarchApp.controller('buttonsController', function($scope) {
    
});

monarchApp.controller('calendarController', function($scope) {
    
});

monarchApp.controller('chart-boxesController', function($scope) {
    
});

monarchApp.controller('chart-jsController', function($scope) {
    
});

monarchApp.controller('chatController', function($scope) {
    
});

monarchApp.controller('checklistController', function($scope) {
    
});

monarchApp.controller('ckeditorController', function($scope) {
    
});

monarchApp.controller('collapsableController', function($scope) {
    
});

monarchApp.controller('content-boxesController', function($scope) {
    
});

monarchApp.controller('data-tablesController', function($scope) {
    
});

monarchApp.controller('dropzone-uploaderController', function($scope) {
    
});

monarchApp.controller('fixed-datatablesController', function($scope) {
    
});

monarchApp.controller('flot-chartsController', function($scope) {
    
});

monarchApp.controller('forms-elementsController', function($scope) {
    
});

monarchApp.controller('forms-masksController', function($scope) {
    
});

monarchApp.controller('forms-validationController', function($scope) {
    
});

monarchApp.controller('forms-wizardController', function($scope) {
    
});

monarchApp.controller('gmapsController', function($scope) {
    
});

monarchApp.controller('helper-classesController', function($scope) {
    
});

monarchApp.controller('iconsController', function($scope) {
    
});

monarchApp.controller('image-cropController', function($scope) {
    
});

monarchApp.controller('imagesController', function($scope) {
    
});

monarchApp.controller('indexController', function($scope) {
    
});

monarchApp.controller('index-altController', function($scope) {
    
});

monarchApp.controller('inline-editorController', function($scope) {
    
});

monarchApp.controller('input-knobsController', function($scope) {
    
});

monarchApp.controller('just-gageController', function($scope) {
    
});

monarchApp.controller('labels-badgesController', function($scope) {
    
});

monarchApp.controller('lazyloadController', function($scope) {
    
});

monarchApp.controller('loading-feedbackController', function($scope) {
    
});

monarchApp.controller('mailbox-composeController', function($scope) {
    
});

monarchApp.controller('mailbox-inboxController', function($scope) {
    
});

monarchApp.controller('mailbox-singleController', function($scope) {
    
});

monarchApp.controller('mapaelController', function($scope) {
    
});

monarchApp.controller('markdownController', function($scope) {
    
});

monarchApp.controller('modalsController', function($scope) {
    
});

monarchApp.controller('morris-chartsController', function($scope) {
    
});

monarchApp.controller('multi-uploaderController', function($scope) {
    
});

monarchApp.controller('nav-menusController', function($scope) {
    
});

monarchApp.controller('notificationsController', function($scope) {
    
});

monarchApp.controller('page-transitionsController', function($scope) {
    
});

monarchApp.controller('panel-boxesController', function($scope) {
    
});

monarchApp.controller('pickersController', function($scope) {
    
});

monarchApp.controller('pie-gagesController', function($scope) {
    
});

monarchApp.controller('popovers-tooltipsController', function($scope) {
    
});

monarchApp.controller('progress-barsController', function($scope) {
    
});

monarchApp.controller('response-messagesController', function($scope) {
    
});

monarchApp.controller('responsive-datatablesController', function($scope) {
    
});

monarchApp.controller('responsive-tablesController', function($scope) {
    
});

monarchApp.controller('scrollbarsController', function($scope) {
    
});

monarchApp.controller('slidersController', function($scope) {
    
});

monarchApp.controller('social-boxesController', function($scope) {
    
});

monarchApp.controller('sortable-elementsController', function($scope) {
    
});

monarchApp.controller('sparklinesController', function($scope) {
    
});

monarchApp.controller('summernoteController', function($scope) {
    
});

monarchApp.controller('tablesController', function($scope) {
    
});

monarchApp.controller('tabsController', function($scope) {
    
});

monarchApp.controller('tile-boxesController', function($scope) {
    
});

monarchApp.controller('timelineController', function($scope) {
    
});

monarchApp.controller('vector-mapsController', function($scope) {
    
});

monarchApp.controller('xchartsController', function($scope) {
    
});

monarchApp.controller('admin-blogController', function($scope){

});

monarchApp.controller('admin-pricingController', function($scope){

});

monarchApp.controller('auto-menuController', function($scope){

});

monarchApp.controller('faq-sectionController', function($scope){

});

monarchApp.controller('invoiceController', function($scope){

});

monarchApp.controller('portfolio-galleryController', function($scope){

});

monarchApp.controller('portfolio-masonryController', function($scope){

});

monarchApp.controller('slidebarsController', function($scope){

});

monarchApp.controller('view-profileController', function($scope){

});

