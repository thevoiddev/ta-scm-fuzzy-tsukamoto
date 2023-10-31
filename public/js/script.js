$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.toggle-password').each(function () {
    $(this).on('click', function () {
        $($(this).data('input')).attr('type', $($(this).data('input')).attr('type') == 'text' ? 'password' : 'text');
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
});

function BootstrapAlert(message, type){
    return `
    <div class="alert alert-${type} text-center" role="alert">
        ${message}
    </div>
    `;
}