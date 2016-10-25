/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var myApp = angular.module("myApp",[]);

myApp.controller("FirstController",['$scope',function($scope){
        
        $scope.myName = "rajesh";
        $scope.notes = [];
        $scope.notes = [
            {id: 1, label: 'First Note', done: false},
            {id: 2, label: 'Second Note', done: false},
            {id: 3, label: 'Third Note', done: true},
            {id: 4, label: 'Forth Note', done: false}
        ];
        console.log($scope.notes);
}]);

myApp.directive('dragMe',function(){
   return{
       restrict:'A',
       replace:true,
       link: function(scope, element, attrs) {
           element.draggable({
               revert:true
           });
       }
   } 
});

myApp.directive('dropMe',function(){
   return{
       restrict:'A',
       replace:true,
       link: function(scope, element, attrs) {
           element.droppable({
               accept:'#a1',
                drop:function(event,ui) {
                   console.log(ui.draggable.css('background-color'));
                   (element).css('background-color',ui.draggable.css('background-color'));
                }
            })
       }
   } 
});


