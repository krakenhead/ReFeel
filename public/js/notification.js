$.ajax({
  url: '../controller/countNotifications.php',
  success: function (data) {
    $('.count').html(data);
  }
});

$(document).on("click", ".notifications", function () {
  $.ajax({
    url: "../controller/fetchNotifications.php",
    success: function (data) {
      $('.notif-area').html(data);
    }
  });
});