function User() {
    this.form = $('form[name=auth]');
    this.init();
}

User.prototype = new DispatchPost();

User.prototype.init = function () {
    var obj = this;
    obj.target = '/user';

    $(obj.form).submit(function (e) {
        e.preventDefault();

        obj.post($(this).serialize(), function (answ) {
            if(answ['ok'] == 1) {
                console.log('success');
            } else {
                console.log('error');
            }
        });
    })
};

$(document).ready(function () {
    new User();
});