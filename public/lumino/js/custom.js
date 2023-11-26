$('#calendar').datepicker({});

! function($) {
    $(document).on("click", "ul.nav li.parent > a ", function() {
        $(this).find('em').toggleClass("fa-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
$(window).on('resize', function() {
    if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function() {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
    }
})


$(document).ready(function() {
    checkedAndProcess()
    $('.verified_link').each(function() {
        $(this).click(function() {

            areYouSure(this);
        });
    })
    $('.verified_submit').each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            areYouSureSubmit(this);
            return false;
        });
    })
});


function showMessageAndReload($message) {
    Swal.fire({
        title: $message,
        showCancelButton: false,
        confirmButtonText: 'Tamam',
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
            if (typeof errors !== 'undefined') {

                //showErrors(errors);
            }
        }
    });
}


function areYouSure($element) {
    Swal.fire({
        title: 'Emin Misiniz ?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            document.location.href = $($element).data('url');
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
        }
    })
}

function areYouSureSubmit($element) {
    Swal.fire({
        title: 'Emin Misiniz ?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var form = $($element).parents('form:first')
            form.submit();

        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
        }
    })
}

function checkUsersOnline($users, $checkProcess) {
    $.get(site + '/adminservice/getuseronlinestatus', {
        'users': $users
    }, function(d) {
        let $data = eval('(' + d + ')');
        if ($data['status']) {
            $Statuses = $data['result']['Statuses'];

            if ($checkProcess === 'list') {
                $.each($Statuses, function($k, $status) {
                    if ($status['status'] === 'online') {
                        $('#online_offline_dot_' + $status['user_id']).attr('class', 'indicator label-success')
                    } else {
                        $('#online_offline_dot_' + $status['user_id']).attr('class', 'indicator label-danger')
                    }
                    $('#last_seen_' + $status['user_id']).html('<br><small><b>Son Görülme: </b>' + $status['last_seen'] + '</small>')

                });


            }


        }
    });
}


/************************************************************************************/
function hasCheckedControl() {
    if (checkeds.length) {
        $('#selecteds_area').show();
    } else {
        $('#selecteds_area').hide();
    }

}

function checkAllSelectCheckboxes() {
    $('#selectallcheckbox').on('click', function() {
        if ($(this).is(':checked')) {
            checkeds = [];
            $.each($('.check_line_id'), function($k, $tCheck) {
                $($tCheck).prop('checked', true);
                checkeds.push($($tCheck).val())
            });
        } else {
            checkeds = [];
            $.each($('.check_line_id'), function($k, $tCheck) {
                $($tCheck).prop('checked', false);

            });
        }
        hasCheckedControl();
    })
}

function checkedAndProcess() {

    if ($('.check_line_id').length) {
        $('.check_line_id').on('click', function() {
            let selected = $(this).val();
            if ($(this).is(':checked')) {

                if (checkeds.indexOf(selected) !== -1) {
                    // Öğe zaten dizide mevcut
                } else {
                    // Öğeyi diziye ekleyebilirsiniz
                    checkeds.push(selected);
                }

            } else {
                let index = checkeds.indexOf(selected);
                if (index !== -1) {
                    checkeds.splice(index, 1); // remove selected from checkeds array
                }
            }
            hasCheckedControl();
        });
        checkAllSelectCheckboxes()

    }
}
/******************************************** */