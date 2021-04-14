/* /var/www/html/FisheriesQA/public/admin/dist/js/custom.js */ 

const toggleOldPassword = document.querySelector('#toggleOldPassword');
const old_password = document.querySelector('#old_password');
if(toggleOldPassword && old_password ){
    toggleOldPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = old_password.getAttribute('type') === 'password' ? 'text' : 'password';
        old_password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
}

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
if(togglePassword && password ){
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
}

const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const confirm_password = document.querySelector('#confirm_password');
if(toggleConfirmPassword && confirm_password ){
    toggleConfirmPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
        confirm_password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
}
//  onkeypress="return restrictNumerics(event);"
function restrictNumerics(e){
    var x=e.which||e.keycode; 
    if((x>=65 && x<=90) || x==8 ||
    (x>=97 && x<=122)|| x==95 || x==32)
    return true;
    else
    return false;
  }


  // restrict Alphabets  
function restrictAlphabets(e){
  var x=e.which||e.keycode; 
  if((x>=48 && x<=57) )
  return true;
  else
  return false;
 }

 setTimeout(function(){
    $('.alert').remove();
}, 5000);



/*$(function () {
    $('#example1').dataTable({
    "ordering": false,
    //"bPaginate": true,
    "bLengthChange": true,
    "pageLength": 2,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false
    });

});*/

$('[data-toggle="tooltip"]').tooltip()



