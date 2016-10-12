app.controller('ItemController', function(dataFactory,$scope,$http){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsTemp = {};

  $scope.totalItems = 0;

  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);

  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(api_token, server_url+'/api/items?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            if(data) {
              $scope.data = data.resource.data;
              $scope.totalItems = data.resource.total;
              $scope.appUrl = data.app_url;
            }
          });
      }else{
          dataFactory.httpRequest(api_token, server_url+'/api/items?page='+pageNumber).then(function(data) {

          if(data) {
            $scope.data = data.resource.data;
            $scope.totalItems = data.resource.total;
            $scope.appUrl = data.app_url;
          }
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsTemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsTemp;
              $scope.libraryTemp = {};
          }
      }
  }

  $scope.saveAdd = function(){
    dataFactory.httpRequest(api_token, server_url+'api/items','POST',{},$scope.form).then(function(data) {
      if(data) {
        $scope.data.push(data);
        $(".modal").modal("hide");
        getResultsPage(1);      
      }
    });
  }

  $scope.edit = function(id){
    dataFactory.httpRequest(api_token, server_url+'api/items/'+id+'/edit').then(function(data) {
      	$scope.form = data;
    });
  }

  $scope.saveEdit = function(){
    dataFactory.httpRequest(api_token, server_url+'api/items/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
        if(data) {
      	  $(".modal").modal("hide");
          $scope.data = apiModifyTable($scope.data,data.id,data);
        }
    });
  }

  $scope.remove = function(item,index){
    var result = confirm("Are you sure delete this item?");
   	if (result) {
      dataFactory.httpRequest(api_token, server_url+'api/items/'+item.id,'DELETE',{}).then(function(data) {
          getResultsPage(1);
      });
    }
  }
   
});