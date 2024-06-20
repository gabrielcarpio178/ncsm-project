$(document).ready(function() {

    $(".txt, #filter, .checkbox").each(function() {
        $(this).change(function(){
            var studentId = $(this).val();
            $.ajax({
                url: '/students/' + studentId,
                type: 'GET',
                success: function(response) {
                    // var student = response.student;
                    console.log(response)
                },

            });
        });
      });
});
