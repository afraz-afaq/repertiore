function readURL(input) {
  if (input.files && input.files[0]) {
    $(".cover-image-required").attr("style", "display:none; color: #a94442");
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#uploaded_cover_img").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

// $('#songs-form').on('beforeValidate', function () {
//     $(".btn-submit").attr('disabled', 'disabled');
// })
//     .on('afterValidate', function () {
//         $(".btn-submit").attr('disabled', false);

//     })
//     .on('beforeSubmit', function (e) {

//         if ($("form").find(".has-error").length > 0) {
//             $(".btn-submit").attr('disabled', false);
//         } else
//             $(".btn-submit").attr('disabled', 'disabled');

//     })
//     .on('submit', function (event) {
//         var file = $('#uploaded_cover_image');
//         var image = file[0].files[0];
//         if(image == null){
//             $(".cover-image-required").attr('style', 'display:block; color: #ff8889 !important; margin-top: -10px;');
//             $(".btn-submit").attr('disabled', 'false');
//             event.preventDefault();
//         }

//     })

$(".reset-btn").on("click", (event) => {
  $("#uploaded_cover_img").attr("src", "");
});

$("#song-upload-option").change(function () {
  if (this.checked) {
    $("#upload-song-option").attr("style", "display:block");
    $("#song-embed-option").attr("style", "display:none");
  } else {
    $("#upload-song-option").attr("style", "display:none");
    $("#song-embed-option").attr("style", "display:block");
  }
});
