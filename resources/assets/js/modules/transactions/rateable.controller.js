/**
 * Created by dfash on 9/22/16.
 */

/**
 * RateableController
 */
(function(){

    'use strict';

    angular
        .module('monarchApp')
        .controller('RateableController', ['$scope', function($scope) {
            var vm = $scope;
            $scope.profile_id = null;
            $scope.profiles = {};
            $scope.profiles.selected = {'id':null, 'recent_rateables':[]};
            $scope.basic_id = null;
            $scope.profileIndex = '';
            $scope.total = 0.00;
            $scope.paytype_id = '';
            $scope.payTypes = [];
            vm.taxable = '0';
            vm.hours = "";

            //    [
            //    {id:1, label:'SHIFT', name:'Day', value:.1},
            //    {id:2, label:'SHIFT', name:'Night', value:.15},
            //
            //    {id:3, label:'OVERTIME', name:'Normal Day', value:1.25},
            //    {id:4, label:'OVERTIME', name:'Saturday', value:1.5},
            //    {id:5, label:'OVERTIME', name:'Sunday/Public holiday', value:2}
            //];
            $scope.payTypes.selected = null;

            $scope.basics = [];
            //    [
            //    {id:1, name:'Basic', value:1},
            //    {id:2, name:'Education', value:2}
            //];
            $scope.basics.selected = null;

            $scope.profileChanged = function() {

                if(!angular.isObject($scope.profiles.selected)) {
                    $scope.payTypes.selected = null;
                    $scope.basics.selected = null;
                    $scope.profiles.selected = {'id':null, 'recent_rateables':[]};
                    $scope.total = 0.00;
                    console.log('cleared');
                    return;
                }
                $scope.reCalc();
            };

            $scope.reCalc = function() {
                if(angular.isObject($scope.payTypes.selected) /*&& $scope.basics.selected*/) {
                    var profile = $scope.profiles.selected;
                    //console.log($scope.payTypes.selected);
                    if(vm.hours > 0) {
                        if($scope.payTypes.selected.label == 'OVERTIME') {
                            $scope.total = (profile.account.base_amount / (parseInt(vm.hours)*8)) * $scope.payTypes.selected.value;
                        }
                        if($scope.payTypes.selected.label == 'SHIFT') {
                            $scope.total = (profile.account.base_amount / (parseInt(vm.hours))) * $scope.payTypes.selected.value;
                        }
                    }
                }
            };

            vm.hoursRange = function() {
                return new Array(23);
            };

            $scope.getPayType = function ($id) {
                for (var i=0; i<$scope.payTypes.length; i++) {
                    if($scope.payTypes[i].id == $id){
                        return $scope.payTypes[i];
                    }
                }
            };

            $scope.getBasis = function ($id) {
                for (var i=0; i<$scope.basics.length; i++) {
                    if($scope.basics[i].id == $id)
                        return $scope.basics[i];
                }
            };

            $scope.isSelected = function($id) {
                if($id) {
                    for (var i = 0; i<$scope.profiles.length; i++) {
                        if($scope.profiles[i].id == $id) {
                            $scope.profiles.selected = $scope.profiles[i];
                            $scope.profileChanged();
                        }
                    }
                }
            };

            $scope.$watch('taxable', function (newValue, oldValue) {
                vm.getTax();
            });

            vm.getTax = function () {
                $scope.reCalc();
                vm.taxCalc();
            };

            vm.taxCalc = function() {
                if(vm.taxable == 1){
                    $scope.total = $scope.total - ((5/100)*$scope.total);
                }
            }

        }]);
})();