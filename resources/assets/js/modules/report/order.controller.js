/**
 * Created by dfash on 10/10/16.
 */
(function () {
    angular
        .module('monarchApp')
        .controller('OrderController', ['$scope', '$rootScope', function($scope, $rootScope) {

            $rootScope.closedSidebar = true;
            $rootScope.hideTopNav = true;
        }]);
})();