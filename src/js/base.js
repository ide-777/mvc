function DispatchPost() {
    this.target;
}


DispatchPost.prototype.post = function (data, f) {
    var obj = this;
    $.ajax({
        url: obj.target,
        type: 'post',
        dataType: "json",
        beforeSend: function () {
           //
        },
        success: f,
        data: data,
        complete: function (xhr, textStatus) {
          //
        },
        error: function (xhr) {
            //
        }
    });
};

