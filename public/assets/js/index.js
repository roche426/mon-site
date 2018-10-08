if (window.matchMedia("(max-width: 767px)").matches) {
    $( "*" ).removeClass( "border-right" );
}

$(".alert-delete").click(function(e) {
    e.preventDefault();

    let $this = $(this);
    let $message = $this.attr('data-confirm-message') || 'Voulez-vous continuer votre action ?';

    bootbox.confirm({
        message: $message,
        buttons: {
            confirm: {
                label: 'Oui',
                className: 'btn-success'
            },
            cancel: {
                label: 'Non',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                //redirection
                window.location = $this.attr('href');
            }}
    });
});


