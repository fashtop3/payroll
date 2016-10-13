/**
 * Created by dfash on 9/22/16.
 */
/**
 * EmployeeProfileController
 */

(function () {

    'use strict';

    angular
        .module('monarchApp')
        .controller('EmployeeProfileController', ['$scope', function($scope) {
            $scope.profile = {};
            this.numb = 0;
            var vm = this;

            //$('#lastname').click(function(e) {
            //    this.placeholder = 'last changed';
            //});

            $scope.initProfile = function ($profile) {
                if(angular.isObject($profile))
                    $scope.profile = $profile;

                console.log($scope.profile);
            }
        }]);
})();