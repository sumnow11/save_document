function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
  
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      location.replace(site_url+'login/logout');
    });
  }