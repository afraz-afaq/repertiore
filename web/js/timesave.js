$(function () {

    timer = setInterval(myTimer, 5000);
function myTimer() {
    if (!document.hidden) {
    $.ajax({
        url: home_url+'user/save-time',
        error: function (xhr, status, error) {

              console.log(xhr);
          }
    }).done(function (data) {

        console.log(data);
  
      });
    }
}
})