app.factory('dataFactory', function($http) {
  var myService = {
    httpRequest: function(api_token, url,method,params,dataPost,upload) {
      var passParameters = {};
      passParameters.url = url;

      if (typeof method == 'undefined'){
        passParameters.method = 'GET';
      }else{
        passParameters.method = method;
      }

      if (typeof params != 'undefined'){
        passParameters.params = params;
      }

      if (typeof dataPost != 'undefined'){
        passParameters.data = dataPost;
      }      

      if (typeof upload != 'undefined'){
         passParameters.upload = upload;
      }

      passParameters.headers = {'Authorization':'Bearer ' + api_token};

      var promise = $http(passParameters).then(function (response) {

        return response.data;
      },function(response){

        if(response.data.long_url) {
          var eltStr = '.edit_url';
          var elt = $(eltStr).parent().find('.help-block');
          
          $(eltStr).parent().addClass('has-error');
          elt.addClass('error');
          elt.html(response.data.long_url);

          $(eltStr).focus(function(e){
            $(eltStr).parent().removeClass('has-error');
            elt.html('');
          });
        } else {
          return response.data;
        }
      });
      return promise;
    }
  };
  return myService;
});