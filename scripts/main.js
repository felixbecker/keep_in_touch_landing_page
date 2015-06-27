(function(){

    var form = document.getElementById('signUpform');
    var flash_err = document.getElementById('flash_err');
    var flash_ok = document.getElementById('flash_ok');

    var showFlash = function(flash){
      flash.className = flash.className.replace('hide','');
    };

    var hideFlash = function(flash){
      flash.className += ' hide';
    };

    hideFlash(flash_err);
    hideFlash(flash_ok);

    var clb = function(evt){

      var email = form["sign_up_email"].value;
      var name = form["sign_up_name"].value;

      if (checkIfValid(email,name)) {
        showFlash(flash_ok);
      }else {
        evt.preventDefault();
        showFlash(flash_err);
      }
    };

    if (form.addEventListener) {
      form.addEventListener("submit",clb,false);
    }else if(form.attachEvent){
      form.attachEvent('onsubmit',clb);
    }

    var isEmpty = function(str){
      return !str.replace(/^\s+/g, '').length > 0;
    };

    var isValidEmail = function(email){
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      return !re.test(email);
    };

    var checkIfValid = function(email,name){
        if (isEmpty(name)) {
          return false;
        }
        if (isEmpty(email)) {
          return false;
        }
        if(isValidEmail(email)){
          return false;
        }
        return true;
    };

  })();
